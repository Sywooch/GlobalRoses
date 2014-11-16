<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use \kartik\select2\Select2;
use \common\models\items\Category;
use \common\models\items\Color;

/* @var $this yii\web\View */
/* @var $model common\models\Item */
/* @var $form yii\widgets\ActiveForm */
/* @var $form_id string */
/* @var $previousButton string */
/* @var $nextButton string */
?>

<div class="form">
    <?php $form = ActiveForm::begin([
        'id' => $form_id,
    ]); ?>

    <div class="box-body">
        <div class="row">
            <div class="col-md-6">
                <?= $form->field($model, 'name')->textInput(['maxlength' => 255]); ?>
            </div>
            <div class="col-md-6">
                <?= $form->field($model, 'image')->textInput(['maxlength' => 255]); ?>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>
            </div>
            <div class="col-md-6">
                <?= $form->field($model, 'description_short')->textarea(['rows' => 6]) ?>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
                <?= $form->field($model, 'id_category')->widget(Select2::classname(), [
                    'data' => Category::getCategoryGrouped(),
                    'language' => Yii::$app->language,
                    'options' => [
                        'id' => 'id_category',
                        'placeholder' => Yii::t('item', 'Select Category')
                    ]
                ]); ?>
            </div>
            <div class="col-md-4">
                <?= $form->field($model, 'id_color')->widget(Select2::classname(), [
                    'data' => Color::getAllAsArray(),
                    'language' => Yii::$app->language,
                    'options' => [
                        'id' => 'id_color',
                        'placeholder' => Yii::t('item', 'Select Color')
                    ],
                    'pluginOptions' => [
                        'allowClear' => true
                    ]
                ]); ?>
            </div>
            <div class="col-md-4">
                <?= $form->field($model, 'status')->dropDownList(['active' => 'Active', 'disable' => 'Disable',], ['prompt' => '']) ?>
            </div>
        </div>
        <div class="row">
            <div class="col-md-3">
                <?= $form->field($model, 'quantity')->textInput() ?>
            </div>
            <div class="col-md-3">
                <?= $form->field($model, 'height')->textInput(['maxlength' => 5]) ?>
            </div>
            <div class="col-md-3">
                <?= $form->field($model, 'weight')->textInput(['maxlength' => 5]) ?>
            </div>
            <div class="col-md-3">
                <?= $form->field($model, 'unit_price')->textInput(['maxlength' => 10]) ?>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
                <?= $form->field($model, 'available')->textInput() ?>
            </div>


        </div>
    </div>
    <div class="box-footer">
        <?php
        if ($model->isNewRecord) {
            echo Html::submitButton(
                Yii::t('common/application', 'Create'),
                ['class' => 'btn btn-success']);
        } else {
            if (isset($previousButton)) {
                echo $previousButton;
            }
            echo Html::submitButton(
                Yii::t('common/application', 'Update'),
                ['class' => 'btn btn-primary']);

            if (isset($nextButton)) {
                echo $nextButton;
            }
        }
        ?>
    </div>
    <?php ActiveForm::end(); ?>
</div>
