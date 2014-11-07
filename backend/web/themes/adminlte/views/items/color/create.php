<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\items\Color */

$this->title = Yii::t('items/color', 'Create {modelClass}', [
    'modelClass' => 'Color',
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('items/color', 'Colors'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="color-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
