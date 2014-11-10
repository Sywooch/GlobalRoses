<?php
use yii\helpers\Html;
use yii\widgets\Breadcrumbs;

/* @var $this \yii\web\View */
/* @var $content string */
?>
    <h1>
        <?= Html::encode($this->title) ?>
        <small><?= Yii::t('dashboard', 'title') ?></small>
    </h1>
<?= Breadcrumbs::widget([
    'tag' => 'ol',
//    'itemTemplate' => "<li><a href='#'><i class='fa fa-dashboard'></i>{link}</a></li>\n",
    'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
]) ?>