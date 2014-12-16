<?php
namespace frontend\controllers;

use Yii;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use frontend\models\cart\Item;
use common\models\items\Available;
use yii\web\NotFoundHttpException;
use yz\shoppingcart\ShoppingCart;

/**
 * ShoppingCart controller
 */
class ShoppingCartController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['load-item', 'add-item'],
                'rules' => [
                    [
                        'actions' => ['load-item'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                    [
                        'actions' => ['add-item'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'load-item' => ['post'],
                    'add-item' => ['post'],
                ],
            ],
        ];
    }

    public function actionIndex()
    {
        return $this->render('index');
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
}
