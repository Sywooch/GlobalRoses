<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use \kartik\select2\Select2;
use \common\models\items\Category;

/* @var $this yii\web\View */
/* @var $model common\models\items\Category */
/* @var $form yii\widgets\ActiveForm */
/* @var $form_id string */
?>

<div class="">

    <?php $form = ActiveForm::begin([
        'id' => $form_id,
    ]); ?>

    <div class="box-body">
        <?php
        echo $form->field($model, 'name')->textInput(['maxlength' => 255]);

        echo $form->field($model, 'id_parent')->widget(Select2::classname(), [
            'data' => array_merge(["" => ""], Category::getCategoryGrouped()),
            'language' => Yii::$app->language,
            'options' => [
                'id' => 'category-parent-id',
                'placeholder' => Yii::t('items/category', 'Select Category')
            ],
            'pluginOptions' => [
                'allowClear' => true
            ]
        ]); ?>
    </div>

    <div class="modal-footer">
        <?= Html::submitButton(
            $model->isNewRecord ? Yii::t('items/category', 'Create') : Yii::t('items/category', 'Update'),
            ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>
    <?php ActiveForm::end(); ?>
</div>
