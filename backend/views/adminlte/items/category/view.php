<?php

use \kartik\helpers\Html;
use common\components\DetailView;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model common\models\items\Category */

$this->title = Yii::t('items/category', 'Categories');
$this->params['breadcrumbs'][] = ['label' => $this->title, 'url' => ['index']];
$this->params['breadcrumbs'][] = $model->name;

$prev = $model->getPrevious();
$next = $model->getNext();
?>

<div class="row">
    <div class="col-sm-12">
        <?= DetailView::widget([
            'model' => $model,
            'deleteOptions' => [
                'class' => 'btn btn-danger btn-xs',
                'data' => [
                    'confirm' => Yii::t('items/category', 'Are you sure you want to delete this item?'),
                    'method' => 'post',
                ],
                'url' => Url::to(['delete', 'id' => $model->id])
            ],
            'previousOptions' => (!is_null($prev))
                ? [
                    'class' => 'btn btn-default btn-xs',
                    'url' => Url::to(['view', 'id' => $prev])
                ] : [
                    'class' => 'btn btn-default btn-xs',
                    'disabled' => 'disabled'
                ],
            'nextOptions' => (!is_null($next))
                ? [
                    'class' => 'btn btn-default btn-xs',
                    'url' => Url::to(['view', 'id' => $next])
                ] : [
                    'class' => 'btn btn-default btn-xs',
                    'disabled' => 'disabled'
                ],
            'updateOptions' => [
                'class' => 'btn btn-info btn-xs',
                'url' => Url::to(['update', 'id' => $model->id])
            ],
            'mode' => DetailView::MODE_VIEW,
            'panel' => [
                'heading' => '<i class="fa fa-ellipsis-v"></i>&nbsp;<span>' .
                    Yii::t('items/category', 'View category {category}', ['category' => $model->name]) . '</span>',
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
                    'attribute' => 'id_parent',
                    'format' => 'raw',
                    'value' => $model->getParentName(),
                    'inputWidth' => '40%', // control your input size
                ],
            ]
        ]) ?>
    </div>
</div>
