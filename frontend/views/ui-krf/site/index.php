<?php

use common\components\GridView;
use \frontend\controllers\SiteController;

/* @var $this yii\web\View */
/* @var $searchModel common\models\items\SuggestedSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('application', 'TITLE');
?>
<?php

$gridColumns = SiteController::getGridColumn();

echo GridView::widget([
    'id' => 'item-suggested-list',
    'dataProvider' => $dataProvider,
    'filterModel' => $searchModel,
    'columns' => $gridColumns,
    'showHeader' => false,
    'layout' => '{items}{pager}',
]);

echo Yii::$app->controller->loadItemModel();

?>
