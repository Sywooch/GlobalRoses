<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\LoginForm */

$this->title = 'Login';
?>
<div class="well well-sm well-title">
    <strong>Sign in</strong>
</div>
<div class="well well-sm">
    <div class="row">
        <div class="col-md-6 col-md-offset-2">
            <?php $form = ActiveForm::begin(['id' => 'login-form']); ?>
            <?= $form->field($model, 'username') ?>
            <?= $form->field($model, 'password')->passwordInput() ?>
            <?= $form->field($model, 'rememberMe')->checkbox() ?>

            <div style="color:#999;margin:1em 0">
                <?= Html::a('Forgot password?', ['site/request-password-reset']) ?>
            </div>
            <?= Html::submitButton('Login', ['class' => 'btn btn-primary', 'name' => 'login-button']) ?>
            <?= Html::button('Create account', ['class' => 'btn btn-success', 'name' => 'create-account-button']) ?>
        </div>
    </div>
</div>
