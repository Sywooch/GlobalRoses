<?php
use backend\assets\AppAsset;
use backend\assets\IE9Asset;
use yii\helpers\Html;

/* @var $this \yii\web\View */
/* @var $content string */

AppAsset::register($this);
IE9Asset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>"/>
    <meta
        content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no'
        name='viewport'>
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->registerCssFile('//code.ionicframework.com/ionicons/1.5.2/css/ionicons.min.css'); ?>
    <?php $this->head() ?>
</head>
<?php $this->beginBody() ?>
<body class="skin-black">
<header class="header">
    <?php include('header/navbar.php') ?>
</header>
<div class="wrapper row-offcanvas row-offcanvas-left">
    <!-- Left side column. contains the logo and sidebar -->
    <aside class="left-side sidebar-offcanvas">
        <?php include('sidebar/left.php') ?>
    </aside>
    <!-- /.left-side -->
    <!-- Right side column. Contains the navbar and content of the page -->
    <aside class="right-side">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <?php include('content/header.php') ?>
        </section>
        <!-- Main content -->
        <section class="content">
            <?= $content ?>
        </section>
        <!-- /.content -->
    </aside>
    <!-- /.right-side -->
</div>
<!-- ./wrapper -->
<?php $this->endBody();

$languages = [];
$languages['select2'] = [
    substr(Yii::$app->language, 0, 2) => [
        'formatMatches' => Yii::t('commons/select2', 'formatNoMatches'),
        'formatNoMatches' => Yii::t('commons/select2', 'formatNoMatches'),
        'formatInputTooShort' => Yii::t('commons/select2', 'formatInputTooShort'),
        'formatInputTooLong' => Yii::t('commons/select2', 'formatInputTooLong'),
        'formatSelectionTooBig' => Yii::t('commons/select2', 'formatSelectionTooBig'),
        'formatLoadMore' => Yii::t('commons/select2', 'formatLoadMore'),
        'formatSearching' => Yii::t('commons/select2', 'formatSearching'),
    ]];
$this->registerJs('(function () {
    "use strict";
    $.fn.select2.locales["' . key($languages['select2']) . '"] = JSON.parse(\'' . \yii\helpers\Json::encode($languages['select2']) . '\');
    $.extend($.fn.select2.defaults, $.fn.select2.locales["' . key($languages['select2']) . '"]);
})(jQuery);')
?>
</body>
</html>
<?php $this->endPage() ?>
