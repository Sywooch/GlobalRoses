<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Item */

$this->title = Yii::t('item', 'Items');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="box">
    <div class="box-header">
        <i class="fa fa-ellipsis-v"></i>

        <h3 class="box-title"><?= Yii::t('item',
                'View item {item}',
                ['item' => $model->name]) ?></h3>
    </div>
    <!-- /.box-header -->
    <div class="box-body">
        <?= DetailView::widget([
            'model' => $model,
            'attributes' => [
                'name',
                'name',
                'reference',
                'image:ntext',
                'description:ntext',
                'description_short',
                'id_category',
                'quantity',
                'height',
                'weight',
                'id_color',
                'available',
                'status',
                'unit_price',
                [
                    'attribute' => 'created_at',
                    'format' => [
                        'Datetime',
                        'type' => 'dd/MM/YYYY HH:mm'
                    ]
                    ,
                ],
                [
                    'attribute' => 'updated_at',
                    'format' => [
                        'Datetime',
                        'type' => 'dd/MM/YYYY HH:mm'
                    ]
                    ,
                ]
            ],
        ]) ?>
    </div>
    <div class="box-footer">
        <?= Html::a('<i class="fa fa-backward"></i>',
            ['view', 'id' => $model->getPrevious()],
            [
                'class' => 'btn btn-default',
                'title' => Yii::t('common/application', 'previous')
            ]) ?>
        <?= Html::a(Yii::t('common/application', 'Edit'),
            ['update', 'id' => $model->id],
            ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('common/application', 'Delete'),
            ['delete', 'id' => $model->id],
            [
                'class' => 'btn btn-danger',
                'data' => [
                    'confirm' => Yii::t('item', 'Are you sure you want to delete this item?'),
                    'method' => 'post',
                ],
            ]) ?>
        <?= Html::a('<i class="fa fa-forward"></i>',
            ['view', 'id' => $model->getNext()],
            [
                'class' => 'btn btn-default',
                'title' => Yii::t('common/application', 'next')
            ]) ?>
    </div>
</div><!-- /.box -->
