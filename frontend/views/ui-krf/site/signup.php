<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\SignupForm */

$this->title = Yii::t('application', 'Signup');
?>
<div class="well well-sm well-title">
    <strong>Open an account</strong>
</div>
<div class="well well-md">
    <?php $form = ActiveForm::begin([
        'id' => 'form-signup',
        'enableAjaxValidation' => true,
        'options' => [
            'autocomplete' => 'off'
        ]
    ]); ?>
    <fieldset>
        <legend>Account</legend>
        <div class="col-sm-12">
            <?= $form->field($model, 'email') ?>
        </div>
        <div class="col-sm-6">
            <?= $form->field($model, 'password')->passwordInput() ?>
        </div>
        <div class="col-sm-6">
            <?= $form->field($model, 'password_check')->passwordInput() ?>
        </div>
    </fieldset>
    <!--<fieldset>
        <legend>Company</legend>
        <div class="col-sm-12">
            <? /*= $form->field($model, 'company') */ ?>
        </div>
        <div class="col-sm-6">
            <? /*= $form->field($model, 'vat_id') */ ?>
        </div>
        <div class="col-sm-6">
            <? /*= $form->field($model, 'vat_authority') */ ?>
        </div>
        <div class="col-sm-12">
            <? /*= $form->field($model, 'address') */ ?>
        </div>
        <div class="col-sm-6">
            <? /*= $form->field($model, 'postal') */ ?>
        </div>
        <div class="col-sm-6">
            <? /*= $form->field($model, 'city') */ ?>
        </div>
        <div class="col-sm-6">
            <? /*= $form->field($model, 'phone') */ ?>
        </div>
        <div class="col-sm-6">
            <? /*= $form->field($model, 'mobile') */ ?>
        </div>
    </fieldset>-->
    <div class="form-group">
        <?= Html::submitButton('Signup', ['class' => 'btn btn-primary', 'name' => 'signup-button']) ?>
    </div>
    <?php ActiveForm::end(); ?>
</div>