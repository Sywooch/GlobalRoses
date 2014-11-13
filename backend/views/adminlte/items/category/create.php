<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\items\Category */
?>
<div class="category-create">
    <?= $this->render('_form', [
        'model' => $model,
        'form_id' => 'create-category-form',
    ]) ?>

</div>
