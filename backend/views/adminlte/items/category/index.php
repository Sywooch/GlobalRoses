<?php

use yii\helpers\Html;
use yii\helpers\Url;
use \common\models\items\Category;
use kartik\grid\GridView;
use \kartik\grid\ActionColumn;

/* @var $this yii\web\View */
/* @var $searchModel common\models\items\CategorySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('items/category', 'Categories');
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="index">
    <?php
    $gridColumns = [
        ['class' => 'kartik\grid\SerialColumn'],
            [
                'attribute' => 'name',
                'format' => 'raw',
                'value' => function ($model, $key, $index, $widget) {
                    return Html::a($model->name, ['view', 'id' => $model->id], [
                        'data-pjax' => 0,
                    ]);
                },
                'vAlign' => 'middle',
            ],
            [
                'attribute' => 'id_parent',
                'vAlign' => 'middle',
                'hAlign' => 'center',
                'value' => function ($model, $key, $index, $widget) {
                    return $model->parentName;
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
        'showPageSummary' => false,
        'pjax' => true,
        'toolbar' => [
            ['content' =>
                Html::a('<i class="glyphicon glyphicon-plus"></i>',
                    Url::to('item/create'),
                    [
                        'title' => Yii::t('items/category', 'Add new'),
                        'class' => 'btn btn-success',
                        'data-pjax' => 0,
                    ]) . ' ' .
                Html::a('<i class="glyphicon glyphicon-repeat"></i>',
                    Url::to(['item/']),
                    [
                        'data-pjax' => 0,
                        'class' => 'btn btn-default',
                        'title' => Yii::t('common/application', 'Reset')
                    ])
            ]
        ],
        'panel' => [
            'type' => GridView::TYPE_DEFAULT,
            'heading' => false,
        ]
    ]);
    ?>
</div>