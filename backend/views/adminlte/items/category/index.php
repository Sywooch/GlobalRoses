<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\items\CategorySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('items/category', 'Categories');
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="index">
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
    <p><?= Html::a(
            Yii::t('common/application', 'Create new'),
            Url::to('category/create'),
            [
                'class' => 'btn btn-primary btn-sm'
            ]) ?></p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'name',
            [
                'label' => 'parent',
                'value' => function ($data) {
                    $a = $data->getParentName();
                    if (is_null($a)) {
                        return '-';
                    }
                    return $a;
                }
            ],
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>