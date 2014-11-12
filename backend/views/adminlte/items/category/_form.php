<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\items\Category */
/* @var $model_relation common\models\items\categories\Relation */
/* @var $form yii\widgets\ActiveForm */
/* @var $form_id string */
?>

<div class="category-form">

    <?php $form = ActiveForm::begin([
        'id' => $form_id,
    ]); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => 255]) ?>

    <?= $form->field($model_relation, 'id_parent')->dropDownList([]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('items/category', 'Create') : Yii::t('items/category', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
