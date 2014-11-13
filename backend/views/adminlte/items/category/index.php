<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\helpers\Json;
use yii\bootstrap\Modal;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\items\CategorySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('items/category', 'Categories');
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="category-index">
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
    <p><?= Html::button(
            Yii::t('items/category', 'Create new'),
            [
                'class' => 'btn btn-primary btn-sm',
                'data-toggle' => 'modal',
                'data-target' => '#category-create-modal',

            ]) ?></p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'id',
            'name',
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>

<?php
Modal::begin([
    'id' => 'category-create-modal',
    'closeButton' => ['tag' => 'button', 'label' => '&times;'],
    'header' => Yii::t('items/category', 'create_title'),
    'options' => [
        'data-modal-type' => 'app-modal',
        'data-modal-options' => Json::encode([
            'request' => Url::to('category/create'),
        ]),
    ]
]);
Modal::end();

Modal::begin([
    'id' => 'category-update-modal',
    'closeButton' => ['tag' => 'button', 'label' => '&times;'],
    'header' => Yii::t('items/category', 'update_title'),
    'options' => [
        'data-modal-type' => 'app-modal',
        'data-modal-options' => Json::encode([
            'request' => Url::to('category/update'),
        ]),
    ]
]);
Modal::end();
?>
