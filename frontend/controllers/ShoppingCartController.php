<?php
namespace frontend\controllers;

use Yii;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\items\Suggested;
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
                'only' => ['add-item'],
                'rules' => [
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
                    'add-item' => ['post'],
                ],
            ],
        ];
    }

    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionAddItem($id)
    {
        $model = $this->findModel($id);
        $data = Yii::$app->request->post();

        Yii::$app->response->format = 'json';
        return [
            'html' => $this->renderAjax('add-item', [
                'model' => $model,
            ])
        ];
    }

    /**
     * Finds the Item model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return Suggested the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Suggested::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested item does not exist.');
        }
    }

}
