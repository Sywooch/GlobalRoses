<?php

/* @var $this yii\web\View */
/* @var $model common\models\items\Category */


$this->title = Yii::t('items/category', 'Categories');
$this->params['breadcrumbs'][] = ['label' => $this->title, 'url' => ['index']];
$this->params['breadcrumbs'][] = Yii::t('items/category', 'new item');
?>
<div class="box">
    <div class="box-header">
        <i class="fa fa-ellipsis-v"></i>

        <h3 class="box-title"><?= Yii::t('items/category', 'Create new category') ?></h3>
    </div>
    <!-- /.box-header -->
    <div class="box-body">
        <?= $this->render('_form', [
            'model' => $model,
            'form_id' => 'create-category-form',
        ]) ?>
    </div>
</div><!-- /.box -->
