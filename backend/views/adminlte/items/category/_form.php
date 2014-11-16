<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
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
        'id' => $form_id,
    ]); ?>

    <div class="box-body">
        <div class="row">
            <div class="col-md-6">
                <?= $form->field($model, 'name')->textInput(['maxlength' => 255]); ?>
            </div>
            <div class="col-md-6">
                <?= $form->field($model, 'id_parent')->widget(Select2::classname(), [
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
