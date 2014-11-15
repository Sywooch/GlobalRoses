<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\items\ColorSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('items/color', 'Colors');
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="index">
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
    <p><?= Html::a(
            Yii::t('common/application', 'Create new'),
            Url::to('color/create'),
            [
                'class' => 'btn btn-primary btn-sm'
            ]) ?></p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'name',
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>