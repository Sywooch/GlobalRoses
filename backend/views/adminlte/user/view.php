<?php

use yii\helpers\Html;
use common\components\DetailView;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model common\models\User */

$this->title = Yii::t('user', 'Users');
$this->params['breadcrumbs'][] = $this->title;
$this->params['breadcrumbs'][] = $model->email;
?>
<div class="row">
    <div class="col-sm-12">
        <?= DetailView::widget([
            'model' => $model,
            'updateOptions' => [
                'class' => 'btn btn-info btn-xs',
                'url' => Url::to(['update', 'id' => $model->id])
            ],
            'mode' => DetailView::MODE_VIEW,
            'panel' => [
                'heading' => '<i class="fa fa-ellipsis-v"></i>&nbsp;<span>' .
                    Yii::t('user', 'View user {username}', ['item' => $model->email]) . '</span>',
                'type' => DetailView::TYPE_DEFAULT,
            ],
            'attributes' => [
                [
                    'attribute' => 'email',
                    'format' => 'raw',
                    'value' => '<kbd>' . $model->email . '</kbd>',
                    'displayOnly' => true
                ],
                [
                    'attribute' => 'role',
                ],
            ]
        ]) ?>
    </div>
</div>