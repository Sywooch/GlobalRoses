<?php
use \kartik\helpers\Html;
use \yii\bootstrap\Modal;
use \yii\helpers\Url;

/* @var $this yii\web\View */

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
$this->registerJsFile(Url::to('@web/js/chart/item.js'), ['depends' => [\frontend\assets\AppAsset::className()]]);
