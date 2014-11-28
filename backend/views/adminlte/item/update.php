<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Item */
/* @var $previousButton string */
/* @var $nextButton string */

$this->title = Yii::t('item', 'Items');
$this->params['breadcrumbs'][] = ['label' => $this->title, 'url' => ['index']];
$this->params['breadcrumbs'][] = $model->name;

?>
<div class="box">
    <div class="box-header">
        <i class="fa fa-ellipsis-v"></i>

        <h3 class="box-title"><?= Yii::t('item',
                'Edit item {item}',
                ['item' => $model->name]) ?></h3>
    </div>
    <!-- /.box-header -->
    <div class="box-body">
        <?= $this->render('_form', [
            'model' => $model,
            'form_id' => 'update-item-form',
            'previousButton' => $previousButton,
            'nextButton' => $nextButton,
        ]) ?>
    </div>
</div><!-- /.box -->

