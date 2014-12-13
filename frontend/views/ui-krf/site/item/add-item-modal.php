<?php
use \kartik\helpers\Html;
use \yii\helpers\Url;
use \yii\bootstrap\Modal;

/* @var $this yii\web\View */
/* @var $model common\models\items\Suggested */

$footer = Html::a(sprintf('<i class="glyphicon glyphicon-chevron-left"></i> %s', Yii::t('application', 'Continue shopping')), '#', [
    'data-dismiss' => "modal",
    'class' => "btn btn-warning pull-left"
]);
$footer .= Html::a(sprintf('%s <i class="glyphicon glyphicon-play"></i>', Yii::t('application', 'Pay')), 'cart.html', [
    'data-dismiss' => "modal",
    'class' => "btn btn-success pull-right"
]);
Modal::begin([
    'header' => '&nbsp;',
    'options' => [
        'class' => 'modal modal-product',
        'id' => 'productModal',
        'data-modal-type' => 'ajax-modal',
        'data-modal-options' => \yii\helpers\Json::encode([

        ])
    ],
    'footer' => $footer
]);
Modal::end();
