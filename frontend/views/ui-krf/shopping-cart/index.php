<?php

use kartik\grid\GridView;
use \frontend\controllers\SiteController;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ArrayDataProvider */


$this->title = Yii::t('application', 'TITLE');
$gridColumns = [
    [
        'label' => Yii::t('application', 'Product'),
        'attribute' => 'product',
    ],
    [
        'label' => Yii::t('application', 'Price'),
        'attribute' => 'price',
    ],
    [
        'label' => Yii::t('application', 'Quantity'),
        'attribute' => 'quantity',
        'format' => ['decimal', 0],
        'pageSummary' => true
    ],
    [
        'label' => Yii::t('application', 'Quantity new'),
        'attribute' => 'quantity_new',
    ],
    [
        'label' => Yii::t('application', 'Cost'),
        'attribute' => 'cost',
        'format' => ['decimal', 2],
        'pageSummary' => true
    ],
    [
        'label' => Yii::t('application', 'actions'),
    ],
];
?>
    <div class="well well-sm well-title">
        <strong><?= Yii::t('application', 'Cart') ?></strong>
    </div>

<?php echo GridView::widget([
    'id' => 'item-cart-list',
    'dataProvider' => $dataProvider,
    'filterModel' => null,
    'columns' => $gridColumns,
    'bordered' => true,
    'striped' => true,
    'condensed' => false,
    'responsive' => true,
    'hover' => false,
    'showPageSummary' => true,
    'layout' => '{items}{pager}',
]);