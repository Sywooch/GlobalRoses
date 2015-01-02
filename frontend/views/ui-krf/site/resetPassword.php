<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\ResetPasswordForm */
?>
<div class="well well-sm well-title">
    <strong><?= Yii::t('application', 'Reset password') ?></strong>
</div>
<div class="well well-sm">
    <div class="panel-group">
        <p class="lead"><?= Yii::t('application', 'Please choose your new password') ?></p>
    </div>
    <div class="row">
        <div class="col-lg-5">
            <?php $form = ActiveForm::begin(['id' => 'request-password-reset-form']); ?>
            <?= $form->field($model, 'email') ?>
            <div class="form-group">
                <?= Html::submitButton('Send', ['class' => 'btn btn-primary']) ?>
            </div>
            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>
