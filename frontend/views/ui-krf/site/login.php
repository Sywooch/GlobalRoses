<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\LoginForm */

$this->title = Yii::t('application', 'Sign in');
?>
<div class="well well-sm well-title">
    <strong><?= Yii::t('application', 'Sign in') ?></strong>
</div>
<div class="well well-md">
    <div class="row">
        <div class="col-md-5 col-md-offset-3 login-wp">
            <?php $form = ActiveForm::begin(['id' => 'login-form']); ?>
            <?= $form->field($model, 'email') ?>
            <?= $form->field($model, 'password')->passwordInput() ?>
            <div class="clearfix">
                <?= $form->field($model, 'rememberMe')->checkbox() ?>
                <?= Html::a('Forgot password?', ['site/request-password-reset']) ?>
            </div>
            <div class="row-fluid">
                <?= Html::submitButton('Login', ['class' => 'btn btn-primary col-md-6', 'name' => 'login-button']) ?>
                <?= Html::button('Create account', ['class' => 'btn btn-success col-md-6', 'name' => 'create-account-button']) ?>
            </div>
        </div>
    </div>
</div>
