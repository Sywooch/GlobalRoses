<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\items\Color */
/* @var $form yii\widgets\ActiveForm */
/* @var $form_id string */
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
        </div>
    </div>
    <div class="box-footer">
        <?php
        if ($model->isNewRecord) {
            echo Html::submitButton(
                Yii::t('common/application', 'Create'),
                ['class' => 'btn btn-success']);
        } else {
            echo Html::a('<i class="fa fa-backward"></i>',
                ['update', 'id' => $model->getPrevious()],
                [
                    'class' => 'btn btn-default',
                    'title' => Yii::t('common/application', 'next')
                ]);
            echo Html::submitButton(
                Yii::t('common/application', 'Update'),
                ['class' => 'btn btn-primary']);

            echo Html::a('<i class="fa fa-forward"></i>',
                ['update', 'id' => $model->getNext()],
                [
                    'class' => 'btn btn-default',
                    'title' => Yii::t('common/application', 'next')
                ]);
        }
        ?>
    </div>
    <?php ActiveForm::end(); ?>
</div>
