<?php

use yii\helpers\Html;
use kartik\detail\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Item */
/* @var $previousButton string */
/* @var $nextButton string */

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
            'condensed' => true,
            'hover' => true,
            'mode' => DetailView::MODE_VIEW,
            'panel' => [
                'heading' => 'Book # ' . $model->id,
                'type' => DetailView::TYPE_INFO,
            ],
            'attributes' => [
                'name',
                'quantity',
                'stock',
                'height',
                'weight',
                'color',
                'available',
                'status',
                'unit_price',
            ]
        ]) ?>
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
    </div>
</div><!-- /.box -->
