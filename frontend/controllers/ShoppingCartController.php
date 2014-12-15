<?php
namespace frontend\controllers;

use Yii;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use frontend\models\cart\Item;
use yii\web\NotFoundHttpException;

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

    public function actionLoadItem($id)
    {
        $model = $this->findModel($id);
        $data = Yii::$app->request->post();

        Yii::$app->response->format = 'json';
        return [
            'html' => $this->renderAjax('load-item', [
                'model' => $model,
            ])
        ];
    }

    public function actionAddItem()
    {
        $data = Yii::$app->request->post();
        Yii::$app->response->format = 'json';
        return [
            'html' => ''
        ];
    }

    /**
     * Finds the Item model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return Item the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Item::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested item does not exist.');
        }
    }

}
