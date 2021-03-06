<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Item */

$this->title = Yii::t('item', 'Items');
$this->params['breadcrumbs'][] = ['label' => $this->title, 'url' => ['index']];
$this->params['breadcrumbs'][] = Yii::t('item', 'new item');
?>
<div class="box">
    <div class="box-header">
        <i class="fa fa-ellipsis-v"></i>

        <h3 class="box-title"><?= Yii::t('item', 'Create new item') ?></h3>
    </div>
    <!-- /.box-header -->
    <div class="box-body">
        <?= $this->render('_form', [
            'model' => $model,
            'form_id' => 'create-item-form',
        ]) ?>
    </div>
</div><!-- /.box -->

