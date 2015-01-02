<?php

use kartik\grid\GridView;
use \yii\helpers\Url;
use \yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ArrayDataProvider */

$this->registerJsFile(Url::to('@web/js/chart/index.js'), ['depends' => [\frontend\assets\AppAsset::className()]]);
$this->title = Yii::t('application', 'TITLE');
$gridColumns = [
    [
        'label' => Yii::t('application', 'Product'),
        'attribute' => 'product',
        'format' => 'raw',
        'vAlign' => 'middle',
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
        'label' => Yii::t('application', 'Price {currency}', ['currency' => html_entity_decode('&euro;')]),
        'attribute' => 'price',
        'vAlign' => 'middle',
        'hAlign' => 'center',
        'format' => ['decimal', 2],
    ],
    [
        'label' => Yii::t('application', 'Quantity'),
        'attribute' => 'requested_quantity',
        'format' => ['decimal', 0],
        'vAlign' => 'middle',
        'hAlign' => 'center',
    ],
    [
        'label' => Yii::t('application', 'Total price {currency}', ['currency' => html_entity_decode('&euro;')]),
        'attribute' => 'cost',
        'vAlign' => 'middle',
        'hAlign' => 'center',
        'format' => 'raw',
        'value' => function ($model, $key, $index, $widget) {
            return sprintf('<span data-price="sub-total">%s</span>',
                Yii::$app->formatter->asDecimal($model['cost'], 2));
        }
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
        'showPageSummary' => false,
        'showFooter' => true,
        'footerRowOptions' => [],
        'afterFooter' => [
            [
                'columns' => [
                    [
                        'content' => sprintf('<a href="%s" class="btn btn-warning"><i class="glyphicon glyphicon-shopping-cart"></i> %s</a>',
                            Url::to(['site/search']),
                            Yii::t('application', 'Continue Shopping')),
                        'tag' => 'td',
                        'options' => ['colspan' => 2],
                    ],
                    [
                        'content' => sprintf('<strong>%s&nbsp;%s</strong>',
                            Yii::$app->formatter->asDecimal(Yii::$app->cart->getCost(), 2), '&euro;'),
                        'tag' => 'td',
                        'options' => ['class' => 'hidden-xs text-center', 'data-price' => 'total'],
                    ],
                    [
                        'content' => sprintf('<a href="%s" class="btn btn-success btn-block" data-button="checkout">%s <i class="glyphicon glyphicon-chevron-right"></i></a>',
                            Url::to(['shopping-cart/checkout']),
                            Yii::t('application', 'Finish')),
                        'tag' => 'td',
                        'options' => [],
                    ],
                ],
                'options' => []
            ]
        ],
        'tableOptions' => [
            'id' => 'cart',
            'class' => 'table table-hover table-condensed',
        ],
        'rowOptions' => [
            'data-row' => 'product'
        ],
        'options' => [
            'data-type' => 'cart',
            'class' => 'grid-view',
        ],
        'layout' => '{items}<div class="text-center">{pager}</div>',
    ]); ?>
</div>
