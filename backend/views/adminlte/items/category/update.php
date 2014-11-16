<?php

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
                'Edit category {category}',
                ['category' => $model->name]) ?></h3>
    </div>
    <!-- /.box-header -->
    <div class="box-body">
        <?= $this->render('_form', [
            'model' => $model,
            'form_id' => 'update-category-form',
            'previousButton' => $previousButton,
            'nextButton' => $nextButton,
        ]) ?>
    </div>
</div><!-- /.box -->
