<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\items\Category */
/* @var $previousButton string */
/* @var $nextButton string */

$this->title = Yii::t('items/category', 'Categories');
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="box">
    <div class="box-header">
        <i class="fa fa-ellipsis-v"></i>

        <h3 class="box-title"><?= Yii::t('items/category',
                'View category {category}',
                ['category' => $model->name]) ?></h3>
    </div>
    <!-- /.box-header -->
    <div class="box-body">
        <?= DetailView::widget([
            'model' => $model,
            'attributes' => [
                'name',
                [
                    'attribute' => 'parent',
                    'value' => (!is_null($model->getParentName()) ? $model->getParentName() : Yii::t('commons/application', '(not set)'))
                ],
                [
                    'attribute' => 'created_at',
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
                    'confirm' => Yii::t('items/category', 'Are you sure you want to delete this item?'),
                    'method' => 'post',
                ],
            ]);
        echo $nextButton;
        ?>
    </div>
</div><!-- /.box -->
