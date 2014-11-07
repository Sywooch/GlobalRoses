<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Order */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="order-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'id')->textInput() ?>

    <?= $form->field($model, 'reference')->textInput(['maxlength' => 50]) ?>

    <?= $form->field($model, 'id_customer')->textInput(['maxlength' => 11]) ?>

    <?= $form->field($model, 'price_total')->textInput(['maxlength' => 10]) ?>

    <?= $form->field($model, 'delivery_info')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'modifed')->textInput() ?>

    <?= $form->field($model, 'deleted')->textInput() ?>

    <?= $form->field($model, 'delivery_at')->textInput(['maxlength' => 11]) ?>

    <?= $form->field($model, 'updated_at')->textInput(['maxlength' => 11]) ?>

    <?= $form->field($model, 'created_at')->textInput(['maxlength' => 11]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('order', 'Create') : Yii::t('order', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
