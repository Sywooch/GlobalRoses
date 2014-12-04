<?php

use yii\helpers\Html;
use \kartik\form\ActiveForm;
use \kartik\select2\Select2;
use \common\models\items\Category;

/* @var $this yii\web\View */
/* @var $model common\models\items\Category */
/* @var $form yii\widgets\ActiveForm */
/* @var $form_id string */
/* @var $previousButton string */
/* @var $nextButton string */
?>

<div class="form">
    <?php $form = ActiveForm::begin([
        'type' => ActiveForm::TYPE_VERTICAL,
        'id' => $form_id,
    ]); ?>

    <div class="box-body">
        <div class="row">
            <div class="col-md-6">
                <?= $form->field($model, 'name')->textInput(['maxlength' => 255]); ?>
            </div>
            <div class="col-md-6">
                <?= $form->field($model, 'id_parent')->widget(Select2::classname(), [
                    'data' => Category::getCategoryGrouped(),
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
        </div>
    </div>
    <div class="box-footer">
        <div class="btn-group" role="group">
            <?php
            if ($model->isNewRecord) {
                echo Html::submitButton(
                    Yii::t('common/application', 'Create'),
                    ['class' => 'btn btn-success']);
            } else {
                if (isset($previousButton)) {
                    echo $previousButton;
                }
                echo Html::a(
                    '<i class="glyphicon glyphicon-eye-open"></i>',
                    ['view', 'id' => $model->id],
                    [
                        'class' => 'btn btn-success  btn-sm',
                        'title' => Yii::t('common/application', 'View')
                    ]);
                echo Html::submitButton(
                    '<i class="glyphicon glyphicon-floppy-disk"></i>',
                    [
                        'class' => 'btn btn-primary  btn-sm',
                        'title' => Yii::t('common/application', 'Update')
                    ]);

                if (isset($nextButton)) {
                    echo $nextButton;
                }
            }
            ?>
        </div>
    </div>
    <?php ActiveForm::end(); ?>
</div>
