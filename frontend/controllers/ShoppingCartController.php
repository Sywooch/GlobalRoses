<?php
namespace frontend\controllers;

use Yii;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use frontend\models\cart\Item;
use common\models\items\Available;
use yii\web\NotFoundHttpException;
use frontend\models\cart\ItemPosition;
use yz\shoppingcart\CartPositionInterface;

/**
 * ShoppingCart controller
 */
class ShoppingCartController extends Frontend
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['checkout'],
                'rules' => [
                    [
                        'actions' => ['checkout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ]
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'index' => ['get'],
                    'load-item' => ['post'],
                    'add-item' => ['post'],
                    'checkout' => ['get'],
                    'delete' => ['post'],
                    'update' => ['post'],
                ],
            ],
        ];
    }

    public function actionIndex()
    {
        $cart_items = Yii::$app->cart->getPositions();
        $models = [];

        /* @var $ci ItemPosition */
        foreach ($cart_items as $ci) {
            $item = $ci->getItem();
            $row = [];
            $row['id'] = $ci->getId();
            $row['requested_quantity'] = $ci->getQuantity();
            $row['cost'] = $ci->getCost();
            $row['item'] = $item;
            $row['name'] = $item->name;
            $row['price'] = $item->unit_price;
            $models[$ci->getId()] = $row;
        }
        $dataProvider = new \yii\data\ArrayDataProvider([
            'allModels' => $models,
            'sort' => [
                'attributes' => ['name', 'quantity'],
            ],
            'pagination' => [
                'pageSize' => 10,
            ],
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider
        ]);
    }

    /**
     * ShoppingCartController::actionLoadItem()
     *
     * @author: Andreas Kondylis
     * @version: 0.1
     * @param $id
     * @return array
     * @throws NotFoundHttpException
     */
    public function actionLoadItem($id)
    {
        if (($item_model = Available::findOne($id)) == null) {
            throw new NotFoundHttpException('The requested item does not exist.');
        }
        Yii::$app->response->format = 'json';
        return [
            'html' => $this->renderAjax('load-item', [
                'model' => new Item(),
                'item_model' => $item_model,
            ])
        ];
    }

    public function actionAddItem()
    {
        $status = false;
        $data = Yii::$app->request->post();
        $item_model = new Available();
        $model = new Item();
        $data[$model->formName()]['id'] = $data[$item_model->formName()]['id'];
        if ($model->load($data)) {
            Yii::$app->cart->put($model->getCartPosition(), $model->quantity);
            $status = true;
        }
        Yii::$app->response->format = 'json';
        $cart_item_count = Yii::$app->cart->getCount();
        $cart_item_cost = Yii::$app->formatter->asDecimal(($cart_item_count > 0)
            ? Yii::$app->cart->getCost()
            : 0, 2);

        $cart_text = Yii::t('application',
            '{items} items - {price}',
            ['items' => $cart_item_count, 'price' => $cart_item_cost]);

        return [
            'status' => $status,
            'data' => [
                'cart' => [
                    'count' => $cart_item_count,
                    'text' => $cart_text,
                ]
            ]
        ];
    }

    public function actionUpdate()
    {
        $status = false;
        $data = Yii::$app->request->post();
        $model = new Item();
        $data[$model->formName()]['id'] = $data['id'];
        $data[$model->formName()]['quantity'] = $data['quantity'];

        $item_cost = 0;
        if ($model->load($data)) {
            $c_model = $model->getCartPosition();
            Yii::$app->cart->update($c_model, $model->quantity);
            $c_model = Yii::$app->cart->getPositionById($c_model->id);
            /** @var CartPositionInterface|null $c_model */
            $item_cost = $c_model->getCost();
            $status = true;

        }
        Yii::$app->response->format = 'json';
        $cart_item_count = Yii::$app->cart->getCount();
        $cart_item_cost = Yii::$app->formatter->asDecimal(($cart_item_count > 0)
            ? Yii::$app->cart->getCost()
            : 0, 2);

        $cart_text = Yii::t('application',
            '{items} items - {price}',
            ['items' => $cart_item_count, 'price' => $cart_item_cost]);

        return [
            'status' => $status,
            'data' => [
                'cart' => [
                    'count' => $cart_item_count,
                    'text' => $cart_text,
                    'price' => $cart_item_cost . "&nbsp;&euro;",
                    'item_price' => $item_cost,
                ]
            ]
        ];
    }

    /**
     * Deletes an existing Item from shopping cart.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $model = Item::findOne($id);
        if ($model === null) {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
        $c_model = Yii::$app->cart->getPositionById($id);
        if ($c_model === null) {
            return $this->redirect(['index']);
        }
        if (Yii::$app->cart->hasPosition($id)) {
            Yii::$app->cart->remove($c_model);
        }
        return $this->redirect(['index']);
    }

    public function actionCheckout()
    {
        $cart_items = Yii::$app->cart->getPositions();
        $models = [];

        /* @var $ci ItemPosition */
        foreach ($cart_items as $ci) {
            $item = $ci->getItem();
            $row = [];
            $row['id'] = $ci->getId();
            $row['requested_quantity'] = $ci->getQuantity();
            $row['cost'] = $ci->getCost();
            $row['item'] = $item;
            $row['name'] = $item->name;
            $row['price'] = $item->unit_price;
            $models[$ci->getId()] = $row;
        }
        $dataProvider = new \yii\data\ArrayDataProvider([
            'allModels' => $models,
            'sort' => [
                'attributes' => ['name', 'quantity'],
            ],
            'pagination' => [
                'pageSize' => 10,
            ],
        ]);

        return $this->render('checkout', [
            'dataProvider' => $dataProvider
        ]);
    }
}
