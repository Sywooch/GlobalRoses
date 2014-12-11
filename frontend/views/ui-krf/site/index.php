<?php

use common\components\GridView;
use \kartik\helpers\Html;
use \common\models\items\Suggested;
use \yii\helpers\Url;
use \yii\helpers\Json;

/* @var $this yii\web\View */
/* @var $model common\models\items\Suggested */
/* @var $searchModel common\models\items\SuggestedSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'My Yii Application';
?>
<?php

$gridColumns = [
    [
        'class' => \common\components\Column::className(),
        'attribute' => 'file_name_original',
        'label' => Yii::t('item', 'Image'),
        'format' => 'raw',
        'value' => function ($model, $key, $index, $widget) {
            /* @var $model Suggested */
            $image_url = ($model->fileExists())
                ? $model->getFileUrl()
                : 'http://placehold.it/150x150';
            $img = Html::img($image_url);
            $a = Html::a($img, '#', [
                'data-id' => 'product-popover',
                'data-content' => $img,
                'data-trigger' => 'hover'
            ]);
            return $a;
        },
        'contentOptions' => [
            'class' => 'image'
        ]
    ],
    [
        'class' => \common\components\Column::className(),
        'attribute' => 'name',
        'contentOptions' => [
            'class' => 'name'
        ]
    ],
    [
        'class' => \common\components\Column::className(),
        'attribute' => 'id_category',
        'value' => function ($model, $key, $index, $widget) {
            /* @var $model Suggested */
            return sprintf('<strong>%s</strong>%s',
                Yii::t('application', 'category'), $model->idCategory->name);
        },
        'format' => 'raw',
        'contentOptions' => [
            'class' => 'category'
        ]

    ],
    [
        'class' => \common\components\Column::className(),
        'attribute' => 'stock',
        'value' => function ($model, $key, $index, $widget) {
            /* @var $model Suggested */
            return sprintf('<strong>%s</strong>%s',
                Yii::t('application', 'stock'), $model->stock);
        },
        'format' => 'raw',
        'contentOptions' => [
            'class' => 'stock'
        ]
    ],
    [
        'class' => \common\components\Column::className(),
        'attribute' => 'height',
        'value' => function ($model, $key, $index, $widget) {
            /* @var $model Suggested */
            return sprintf('<strong>%s</strong>%s',
                Yii::t('application', 'height'), $model->height);
        },
        'format' => 'raw',
        'contentOptions' => [
            'class' => 'height'
        ]
    ],
    [
        'class' => \common\components\Column::className(),
        'attribute' => 'color',
        'value' => function ($model, $key, $index, $widget) {
            /* @var $model Suggested */
            if ($model->color == '' || empty($model->color)) {
                $col = Yii::t('common/application', '(not set)');
            } else {
                $col = "<span class='badge' style='background-color: {$model->color}'>&nbsp;</span>";
            }
            return sprintf('<strong>%s</strong>%s',
                Yii::t('application', 'color'), $col);
        },
        'format' => 'raw',
        'contentOptions' => [
            'class' => 'color'
        ]
    ],
    [
        'class' => \common\components\Column::className(),
        'attribute' => 'quantity',
        'value' => function ($model, $key, $index, $widget) {
            /* @var $model Suggested */
            return sprintf('<strong>%s</strong>%s (%s)',
                Yii::t('application', 'contains'), $model->quantity,
                ($model->quantity > 1)
                    ? Yii::t('application', 'pieces')
                    : Yii::t('application', 'piece'));
        },
        'format' => 'raw',
        'contentOptions' => [
            'class' => 'quantity'
        ]
    ],
    [
        'class' => \common\components\Column::className(),
        'attribute' => 'unit_price',
        'value' => function ($model, $key, $index, $widget) {
            /* @var $model Suggested */
            return sprintf('<strong>%s</strong>%s',
                Yii::t('application', 'unit_price'), $model->unit_price);
        },
        'format' => 'raw',
        'contentOptions' => [
            'class' => 'price'
        ]
    ],
    [
        'class' => \common\components\Column::className(),
        'value' => function ($model, $key, $index, $widget) {
            /* @var $model Suggested */
            return Html::button('<span class="icon glyphicon glyphicon-shopping-cart"></span>' . Yii::t('application', 'unit_price'),
                [
                    'class' => 'btn btn-primary btn-md btn-cart',
                    'data-target' => '#productModal',
                    'data-toggle' => 'modal',
                    'data-modal-options' => Json::encode([
                        'request' => Url::to(['shopping-cart/add-item', 'id' => $model->id])
                    ])
                ]);
        },
        'format' => 'raw',
        'contentOptions' => [
            'class' => 'btn-cart-wp'
        ]
    ],
];
echo GridView::widget([
    'id' => 'item-suggested-list',
    'dataProvider' => $dataProvider,
    'filterModel' => $searchModel,
    'columns' => $gridColumns,
    'showHeader' => false,
    'layout' => '{items}{pager}',
]);

include('item/add-item-modal.php');
?>
