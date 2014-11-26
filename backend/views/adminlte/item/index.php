<?php

use yii\helpers\Url;
use kartik\grid\GridView;
use \common\models\Item;
use \common\models\items\Category;
use \kartik\grid\DataColumn;
use \kartik\grid\BooleanColumn;
use \kartik\grid\ActionColumn;
use \kartik\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Item */
/* @var $searchModel common\models\ItemSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('item', 'Items');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="index">
<?php // echo $this->render('_search', ['model' => $searchModel]); ?>
<?php

$colors = Item::getUsedColor(5);
$gridColumns = [
    ['class' => 'kartik\grid\SerialColumn'],
    [
        'attribute' => 'file_name_original',
        'label' => Yii::t('item', 'Image'),
        'format' => 'raw',
        'vAlign' => 'middle',
        'width' => '70px',
        'value' => function ($model, $key, $index, $widget) {
            $image_url = ($model->fileExists())
                ? $model->getFileUrl()
                : 'http://placehold.it/64x64';
            return Html::media(
                '', '', '#',
                $image_url, [], ['width' => '64px', 'height' => '64px'], [
                    'class' => 'img-responsive img-rounded'
                ]
            );
        },
    ],
    [
        'attribute' => 'name',
        'pageSummary' => Yii::t('common/application', 'Total'),
        'vAlign' => 'middle',
        'headerOptions' => ['class' => 'kv-sticky-column'],
        'contentOptions' => ['class' => 'kv-sticky-column'],
    ],
    [
        'attribute' => 'id_category',
        'vAlign' => 'middle',
        'hAlign' => 'center',
        'value' => function ($model, $key, $index, $widget) {
            return $model->idCategory->name;
        },
        'filterType' => GridView::FILTER_SELECT2,
        'filter' => Category::getCategoryGrouped(),
        'filterWidgetOptions' => [
            'pluginOptions' => ['allowClear' => true],
        ],
        'filterInputOptions' => ['placeholder' => Yii::t('item', 'Any Category')],
        'format' => 'raw'
    ],
    [
        'attribute' => 'quantity',
        'vAlign' => 'middle',
        'hAlign' => 'center',
        'width' => '100px',
        'format' => ['decimal', 0],
        'pageSummary' => true
    ],
    [
        'attribute' => 'stock',
        'vAlign' => 'middle',
        'hAlign' => 'center',
        'width' => '100px',
        'format' => ['decimal', 0],
        'pageSummary' => true
    ],
    [
        'attribute' => 'height',
        'vAlign' => 'middle',
        'hAlign' => 'center',
        'width' => '100px',
        'format' => ['decimal', 2],
    ],
    [
        'class' => DataColumn::className(),
        'attribute' => 'weight',
        'vAlign' => 'middle',
        'hAlign' => 'center',
        'width' => '100px',
        'format' => ['decimal', 2],
    ],
    [
        'attribute' => 'color',
        'value' => function ($model, $key, $index, $widget) {
            if ($model->color == '' || empty($model->color)) {
                return '(not set)';
            }
            return "<span class='badge' style='background-color: {$model->color}'> </span>  <code>" .
            $model->color . '</code>';
        },
        'filterType' => GridView::FILTER_COLOR,
        'filterWidgetOptions' => [
            'showDefaultPalette' => false,
            'pluginOptions' => [
                'showPalette' => true,
                'showPaletteOnly' => true,
                'showSelectionPalette' => true,
                'showAlpha' => false,
                'allowEmpty' => true,
                'preferredFormat' => 'name',
                'palette' => $colors
            ],
        ],
        'vAlign' => 'middle',
        'hAlign' => 'center',
        'format' => 'raw',
        'width' => '150px',
        'noWrap' => true
    ],
    [
        'class' => BooleanColumn::className(),
        'attribute' => 'status',
        'vAlign' => 'middle',
        'hAlign' => 'center',
        'filterType' => GridView::FILTER_SELECT2,
        'trueLabel' => Yii::t('common/application', 'Active'),
        'falseLabel' => Yii::t('common/application', 'Inactive'),
        'filterWidgetOptions' => [
            'pluginOptions' => ['allowClear' => true],
        ],
        'filterInputOptions' => ['placeholder' => Yii::t('common/application', 'All')],
    ],
    [
        'class' => BooleanColumn::className(),
        'attribute' => 'available',
        'vAlign' => 'middle',
        'hAlign' => 'center',
        'filterType' => GridView::FILTER_SELECT2,
        'trueLabel' => Yii::t('common/application', 'Active'),
        'falseLabel' => Yii::t('common/application', 'Inactive'),
        'filterWidgetOptions' => [
            'pluginOptions' => ['allowClear' => true],
        ],
        'filterInputOptions' => ['placeholder' => Yii::t('common/application', 'All')],
    ],
    [
        'attribute' => 'unit_price',
        'vAlign' => 'middle',
        'hAlign' => 'center',
        'width' => '100px',
        'format' => ['decimal', 2],
        'pageSummary' => function ($average, $data, $widget) {
            return Yii::t('item', 'average price {price}', ['price' => Yii::$app->formatter->asCurrency($average, 'EUR')]);
        },
        'pageSummaryFunc' => GridView::F_AVG
    ],
    [
        'class' => ActionColumn::className(),
        'dropdown' => true,
        'vAlign' => 'middle',
        'viewOptions' => ['title' => Yii::t('common/application', 'View'), 'data-toggle' => 'tooltip'],
        'updateOptions' => ['title' => Yii::t('common/application', 'Edit'), 'data-toggle' => 'tooltip'],
        'deleteOptions' => ['title' => Yii::t('common/application', 'Delete'), 'data-toggle' => 'tooltip'],
    ]
];
echo GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
    'columns' => $gridColumns,
    'bordered' => true,
    'striped' => true,
    'condensed' => false,
    'responsive' => true,
    'hover' => false,
    'showPageSummary' => true,
    'pjax' => true, // pjax is set to always true for this demo
    // set your toolbar
    'toolbar' => [
        ['content' =>
            Html::a('<i class="glyphicon glyphicon-plus"></i>',
                Url::to('item/create'),
                [
                    'title' => Yii::t('kvgrid', 'Add Book'),
                    'class' => 'btn btn-success',
                    'data-pjax' => 0,
                ]) . ' ' .
            Html::a('<i class="glyphicon glyphicon-repeat"></i>',
                Url::to(['item/']),
                [
                    'data-pjax' => 0,
                    'class' => 'btn btn-default',
                    'title' => Yii::t('kvgrid', 'Reset Grid')
                ])
        ],
        '{export}',
    ],
    'panel' => [
        'type' => GridView::TYPE_DEFAULT,
        'heading' => false,
    ],
    // set export properties
    'export' => [
        'fontAwesome' => true
    ],
    'exportConfig' => [
        GridView::CSV => [
            'label' => Yii::t('kvgrid', 'CSV'),
        ],
        GridView::EXCEL => [
            'label' => Yii::t('kvgrid', 'Excel'),
        ],
        GridView::PDF => [
            'label' => Yii::t('kvgrid', 'PDF'),
        ],
    ]
]);
?>

</div>
