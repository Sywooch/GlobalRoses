<?php
namespace frontend\controllers;

use Yii;
use yii\filters\AccessControl;

/**
 * User controller
 */
class UserController extends Frontend
{

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['index', 'address'],
                'rules' => [
                    [
                        'actions' => ['index'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                    [
                        'actions' => ['address'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ]
        ];
    }

    public function actionIndex()
    {
        $this->layout = $this->_layout_wide;
        $model = Yii::$app->getUser();
        return $this->render('index', [
            'model' => $model
        ]);
    }

    public function actionAddress()
    {
        $this->layout = $this->_layout_wide;
        $model = Yii::$app->getUser();
        return $this->render('address', [
            'model' => $model
        ]);
    }

}
