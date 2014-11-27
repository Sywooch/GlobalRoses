<?php

use \kartik\helpers\Html;
use common\components\DetailView;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model common\models\Item */
/* @var $previousButton string */
/* @var $nextButton string */

$this->title = Yii::t('item', 'Items');
$this->params['breadcrumbs'][] = $this->title;
$image_url = ($model->fileExists())
    ? $model->getFileUrl()
    : 'http://placehold.it/212x212';
?>
    <div class="row">
        <div class="col-sm-2">
            <?= Html::img($image_url, [
                'class' => 'img-thumbnail'
            ]); ?>
        </div>
        <div class="col-sm-10">
            <?= DetailView::widget([
                'model' => $model,
                'condensed' => true,
                'hover' => true,
                'deleteOptions' => [
                    'data' => [
                        'confirm' => Yii::t('item', 'Are you sure you want to delete this item?'),
                        'method' => 'post',
                    ],
                    'url' => Url::to(['delete', 'id' => $model->id])
                ],
                'previousOptions' => [
                    'url' => Url::to(['view', 'id' => $model->id - 1])
                ],
                'nextOptions' => [
                    'url' => Url::to(['view', 'id' => $model->id + 1])
                ],
                'updateOptions' => [
                    'url' => Url::to(['update', 'id' => $model->id])
                ],
//                'enableEditMode' => false,
                'mode' => DetailView::MODE_VIEW,
                'panel' => [
                    'heading' => '<i class="fa fa-ellipsis-v"></i>&nbsp;<span>' .
                        Yii::t('item', 'View item {item}', ['item' => $model->name]) . '</span>',
                    'type' => DetailView::TYPE_DEFAULT,
                ],
                'attributes' => [
                    [
                        'attribute' => 'reference',
                        'format' => 'raw',
                        'value' => '<kbd>' . $model->reference . '</kbd>',
                        'displayOnly' => true
                    ],
                    'attribute' => 'name',
                    [
                        'attribute' => 'color',
                        'format' => 'raw',
                        'value' => "<span class='badge' style='background-color:{$model->color}'>&nbsp;</span> <code>{$model->color}</code>",
                        'type' => DetailView::INPUT_COLOR,
                        'inputWidth' => '40%', // control your input size
                    ],
                    [
                        'attribute' => 'status',
                        'format' => 'raw',
                        'value' => $model->status ?
                            '<span class="label label-success">Yes</span>' :
                            '<span class="label label-danger">No</span>',
                        'type' => DetailView::INPUT_SWITCH
                    ],
                    [
                        'attribute' => 'available',
                        'format' => 'raw',
                        'value' => $model->status ?
                            '<span class="label label-success">Yes</span>' :
                            '<span class="label label-danger">No</span>',
                        'type' => DetailView::INPUT_SWITCH
                    ],
                    [
                        'attribute' => 'quantity',
                        'format' => 'integer',
                        'inputWidth' => '20%'
                    ],
                    [
                        'attribute' => 'stock',
                        'format' => 'integer',
                        'inputWidth' => '20%'
                    ],
                    [
                        'attribute' => 'height',
                        'format' => ['decimal', 2],
                        'inputWidth' => '20%'
                    ],
                    [
                        'attribute' => 'weight',
                        'format' => ['decimal', 2],
                        'inputWidth' => '20%'
                    ],
                    [
                        'attribute' => 'unit_price',
                        'format' => ['decimal', 2],
                        'inputWidth' => '20%'
                    ],
                ]
            ]) ?>
        </div>
    </div>
    <div class="box-footer">
        <?php
        echo $previousButton;
        echo Html::a(Yii::t('common/application', 'Edit'),
            ['update', 'id' => $model->id],
            ['class' => 'btn btn-primary']);
        echo Html::a(Yii::t('common/application', 'Delete'),
            ['delete', 'id' => $model->id],
            [
                'class' => 'btn btn-danger',
                'data' => [
                    'confirm' => Yii::t('item', 'Are you sure you want to delete this item?'),
                    'method' => 'post',
                ],
            ]);
        echo $nextButton;
        ?>
    </div><!-- /.box -->
