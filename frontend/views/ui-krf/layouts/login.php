<?php
use yii\helpers\Html;
use frontend\assets\AppAsset;
use frontend\assets\IE9Asset;

/* @var $this \yii\web\View */
/* @var $content string */
/* @var $item_search_model \frontend\models\ItemSearchForm */

AppAsset::register($this);
IE9Asset::register($this);

?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<!--[if IE 7]>
<html class="no-js lt-ie9 lt-ie8 ie7"> <![endif]-->
<!--[if IE 8]>
<html class="no-js lt-ie9 ie8"> <![endif]-->
<!--[if IE 9]>
<html class="no-js ie9"> <![endif]-->
<!--[if gt IE 8]><!-->
<html class="no-js">
<!--<![endif]-->
<!--[if !IE]><!-->
<script>
    if (/*@cc_on!@*/false) {
        document.documentElement.className += ' ie10';
    }
</script>
<!--<![endif]-->

<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>
<div class="container">
    <?php include('main/header.php'); ?>
    <main class="row">
        <!-- Left sidebar -->
        <?php include('login/left_sidebar.php'); ?>
        <!-- / Left sidebar -->
        <div class="col-sm-9 col-md-9">
            <?= $content ?>
        </div>
    </main>
    <!-- Footer -->
    <?php include('main/footer.php'); ?>
    <!-- /Footer -->
</div>
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
