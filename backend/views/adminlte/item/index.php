<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\ItemSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('item', 'Items');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="index">
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
    <p><?= Html::a(
            Yii::t('common/application', 'Create new'),
            Url::to('item/create'),
            [
                'class' => 'btn btn-primary btn-sm'
            ]) ?></p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'name',
            'file_name_original:ntext',
            'description:ntext',
            'description_short',
            'id_category',
            'quantity',
            'height',
            'weight',
            'color',
            'available',
            'status',
            'unit_price',
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
