<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\ItemSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'name') ?>

    <?= $form->field($model, 'description') ?>

    <?php echo $form->field($model, 'description_short') ?>

    <?php echo $form->field($model, 'id_category') ?>

    <?php echo $form->field($model, 'quantity') ?>

    <?php echo $form->field($model, 'height') ?>

    <?php echo $form->field($model, 'weight') ?>

    <?php echo $form->field($model, 'color') ?>

    <?php echo $form->field($model, 'available') ?>

    <?php echo $form->field($model, 'status') ?>

    <?php echo $form->field($model, 'unit_price') ?>

    <div class="box-footer">
        <?= Html::submitButton(Yii::t('common/application', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('common/application', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
