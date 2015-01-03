<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\PasswordResetRequestForm */
?>
<div class="well well-sm well-title">
    <strong><?= Yii::t('application', 'Request password reset') ?></strong>
</div>
<div class="well well-md">
    <div class="panel-group">
        <p class="lead text-center"><?= Yii::t('application', 'Please fill out your email. A link to reset password will be sent there') ?></p>
    </div>
    <div class="row">
        <div class="col-md-5 col-md-offset-3">
            <?php $form = ActiveForm::begin(['id' => 'request-password-reset-form']); ?>
            <?= $form->field($model, 'email') ?>
            <div class="form-group">
                <?= Html::submitButton('Send', ['class' => 'btn btn-primary']) ?>
            </div>
            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>
