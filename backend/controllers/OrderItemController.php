<?php

namespace backend\controllers;

class OrderItemController extends \yii\web\Controller
{
    public function actionIndex()
    {
        return $this->render('/order/item/index');
    }

}
