<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\items\Category */

$this->title = Yii::t('items/category', 'Update {modelClass}: ', [
    'modelClass' => 'Category',
]) . ' ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('items/category', 'Categories'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('items/category', 'Update');
?>
<div class="category-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'form_id' => 'update-category-form',
    ]) ?>

</div>
