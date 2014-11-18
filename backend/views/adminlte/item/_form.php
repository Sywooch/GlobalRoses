<?php

use \yii\helpers\Html;
use \kartik\form\ActiveForm;
use kartik\widgets\FileInput;
use \kartik\widgets\ColorInput;
use \kartik\widgets\Select2;
use \kartik\widgets\SwitchInput;
use \kartik\widgets\TouchSpin;
use \common\models\items\Category;

/* @var $this \yii\web\View */
/* @var $model \common\models\Item */
/* @var $form \kartik\form\ActiveForm */
/* @var $form_id string */
/* @var $previousButton string */
/* @var $nextButton string */
?>

<div class="form">
    <?php $form = ActiveForm::begin([
        'options' => ['enctype' => 'multipart/form-data'],
        'type' => ActiveForm::TYPE_VERTICAL,
        'id' => $form_id,
    ]); ?>

    <div class="box-body">
        <div class="row">
            <div class="col-md-6">
                <?= $form->field($model, 'name')->textInput([
                    'maxlength' => 255,
                    'placeholder' => Yii::t('item', 'Placeholder: Item name ...')
                ]); ?>
            </div>
            <div class="col-md-6">
                <?php
                echo $form->field($model, 'upload_file')->widget(FileInput::classname(), [
                    'options' => [
                        'accept' => 'image/*',
                        'placeholder' => Yii::t('item', 'Placeholder: Select image ...')
                    ],
                    'pluginOptions' => [
                        'allowedFileExtensions' => ['jpg', 'gif', 'png'],
                        'showUpload' => false,
                        'browseIcon' => '<i class="glyphicon glyphicon-camera"></i> ',
                        'browseLabel' => Yii::t('commons/application', 'Select ...'),
                    ]
                ]);
                ?>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <?= $form->field($model, 'description')->textarea([
                    'rows' => 6,
                    'placeholder' => Yii::t('item', 'Placeholder: Description ...')
                ]) ?>
            </div>
            <div class="col-md-6">
                <?= $form->field($model, 'description_short')->textarea([
                    'rows' => 6,
                    'placeholder' => Yii::t('item', 'Placeholder: Short description ...')
                ]) ?>
            </div>
        </div>
        <div class="row">
            <div class="col-md-3">
                <?= $form->field($model, 'id_category')->widget(Select2::classname(), [
                    'data' => Category::getCategoryGrouped(),
                    'language' => Yii::$app->language,
                    'options' => [
                        'id' => 'id_category',
                        'placeholder' => Yii::t('item', 'Placeholder: Select category ...')
                    ]
                ]); ?>
            </div>
            <div class="col-md-3">
                <?= $form->field($model, 'color')->widget(ColorInput::classname(), [
                    'options' => [
                        'placeholder' => Yii::t('item', 'Placeholder: Select color ...'),
                    ],
                    'pluginOptions' => [
                        'showAlpha' => false,
                    ]
                ]) ?>
            </div>
            <div class="col-md-3">
                <?= $form->field($model, 'status')->widget(SwitchInput::classname(), [
                    'inlineLabel' => false,
                    'pluginOptions' => [
                        'onColor' => 'success',
                        'offColor' => 'danger',
                        'onText' => '<i class="glyphicon glyphicon-ok"></i>',
                        'offText' => '<i class="glyphicon glyphicon-remove"></i>',
                    ]
                ]) ?>
            </div>
            <div class="col-md-3">
                <?= $form->field($model, 'available')->widget(SwitchInput::classname(), [
                    'inlineLabel' => false,
                    'pluginOptions' => [
                        'onColor' => 'success',
                        'offColor' => 'danger',
                        'onText' => '<i class="glyphicon glyphicon-ok"></i>',
                        'offText' => '<i class="glyphicon glyphicon-remove"></i>',
                    ]
                ]) ?>
            </div>
        </div>
        <div class="row">
            <div class="col-md-3">
                <?= $form->field($model, 'quantity')->widget(TouchSpin::classname(), [
                    'options' => [
                        'placeholder' => Yii::t('item', 'Placeholder: Set quality ...'),
                    ],
                    'pluginOptions' => [
                        'verticalbuttons' => true,
                        'initval' => 1,
                        'min' => 0,
                        'max' => 2000,
                    ]
                ]) ?>
            </div>
            <div class="col-md-3">
                <?= $form->field($model, 'height')->widget(TouchSpin::classname(), [
                    'options' => [
                        'placeholder' => Yii::t('item', 'Placeholder: Set height ...'),
                    ],
                    'pluginOptions' => [
                        'verticalbuttons' => true,
                        'initval' => 1,
                        'min' => 0,
                        'max' => 200,
                        'postfix' => 'cm',
                    ]
                ]) ?>
            </div>
            <div class="col-md-3">
                <?= $form->field($model, 'weight')->widget(TouchSpin::classname(), [
                    'options' => [
                        'placeholder' => Yii::t('item', 'Placeholder: Set weight ...'),
                    ],
                    'pluginOptions' => [
                        'verticalbuttons' => true,
                        'initval' => 1.00,
                        'min' => 0,
                        'max' => 1000,
                        'step' => 0.1,
                        'decimals' => 2,
                        'boostat' => 5,
                        'maxboostedstep' => 10,
                        'postfix' => 'gr',
                    ]
                ]) ?>
            </div>
            <div class="col-md-3">
                <?= $form->field($model, 'unit_price')->widget(TouchSpin::classname(), [
                    'options' => [
                        'placeholder' => Yii::t('item', 'Placeholder: Set Unit Price ...'),
                    ],
                    'pluginOptions' => [
                        'verticalbuttons' => true,
                        'initval' => 0.00,
                        'min' => 0.00,
                        'max' => 100000.00,
                        'step' => 0.1,
                        'decimals' => 2,
                        'boostat' => 5,
                        'maxboostedstep' => 10,
                        'postfix' => '&euro;',
                    ]
                ]) ?>
            </div>
        </div>
        <div class="row">


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
