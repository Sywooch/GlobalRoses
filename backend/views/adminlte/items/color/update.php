<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\items\Color */

$this->title = Yii::t('items/color', 'Update {modelClass}: ', [
    'modelClass' => 'Color',
]) . ' ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('items/color', 'Colors'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('items/color', 'Update');
?>
<div class="color-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
