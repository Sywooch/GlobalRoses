<?php

use common\components\GridView;
use \frontend\controllers\SiteController;

/* @var $this yii\web\View */
/* @var $searchModel common\models\items\SuggestedSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('application', 'TITLE');
?>
<?php

$gridColumns = SiteController::getGridColumn(); ?>
<div class="well well-sm well-title">
    <strong><?= Yii::t('application', 'Search Results') ?></strong>
</div>
<div class="well well-sm">
    <?php echo GridView::widget([
        'id' => 'item-suggested-list',
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => $gridColumns,
        'showHeader' => false,
        'layout' => '{items}<div class="text-center">{pager}</div>',
    ]);

    echo Yii::$app->controller->loadItemModal();
?>
</div>