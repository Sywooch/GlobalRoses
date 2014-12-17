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
        'format' => 'raw',
        'value' => function ($model, $key, $index, $widget) {
            /* @var $model array */
            /* @var $item common\models\items\Available */
            $item = $model['item'];
            $image_url = $item->getImageUrlSmall();
            $image = sprintf('<img src="%s" alt="" class="img-responsive" height="80">', $image_url);
            return sprintf('<div class="row"><div class="col-sm-4">%s</div><div class="col-sm-8">%s</div></div>',
                $image, $model['name']);
        },
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
<div class="well well-sm">
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
    'tableOptions' => [
        'id' => 'cart',
        'class' => 'table table-hover table-condensed',
    ],
    'layout' => '{items}{pager}',
]); ?>
</div>
