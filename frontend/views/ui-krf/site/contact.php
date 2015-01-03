<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\captcha\Captcha;

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\ContactForm */

$this->title = Yii::t('application', 'Contact');
$flash = null;
if (Yii::$app->session->hasFlash('success')) {
    $flash = Yii::$app->session->getFlash('success');
} elseif (Yii::$app->session->hasFlash('error')) {
    $flash = Yii::$app->session->getFlash('error');
}

?>
<div class="well well-sm well-title">
    <strong><?= Yii::t('application', 'Contact Form') ?></strong>
</div>
<div class="well well-md">
    <div class="panel-group">
        <p class="lead"><?= Yii::t('application', 'contact_form_paragraph') ?></p>

        <p class="lead"><?= $flash ?></p>
    </div>
    <div class="row">
        <div class="col-md-5 col-md-offset-3">
            <?php $form = ActiveForm::begin(['id' => 'contact-form']); ?>
            <?= $form->field($model, 'name') ?>
            <?= $form->field($model, 'email') ?>
            <?= $form->field($model, 'subject') ?>
            <?= $form->field($model, 'body')->textArea(['rows' => 6]) ?>
            <?= $form->field($model, 'verifyCode')->widget(Captcha::className(), [
                'template' => '<div class="row"><div class="col-lg-5">{image}</div><div class="col-lg-7">{input}</div></div>',
            ]) ?>
            <div class="form-group">
                <?= Html::submitButton('Submit', ['class' => 'btn btn-primary', 'name' => 'contact-button']) ?>
            </div>
            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>
