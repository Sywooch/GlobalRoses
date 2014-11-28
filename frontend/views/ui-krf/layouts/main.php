<?php
use yii\helpers\Html;
use frontend\assets\AppAsset;
use frontend\assets\IE9Asset;
use kartik\widgets\ColorInput;
use \kartik\select2\Select2;
use common\models\Item;
use \common\models\items\Category;
use \kartik\form\ActiveForm;

/* @var $this \yii\web\View */
/* @var $content string */

AppAsset::register($this);
IE9Asset::register($this);

$colors = Item::getUsedColor(5);

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
        <header>
            <div class="row">
                <div class="col-xs-12 col-md-12 header-top">
                    <div class="row">
                        <div
                            class="col-xs-12 col-sm-3 col-md-3 customer-service">
                            <p class="text-right">
                                <i class="glyphicon glyphicon-earphone"></i><strong>(+30)
                                    210 55 555 245</strong>
                            </p>
                        </div>
                        <div
                            class="col-xs-12 col-sm-6 col-md-6 help text-center">
                            <div class="links">
                                <a href="login.html" class="login"> <i
                                        class="glyphicon glyphicon-circle-arrow-right"></i>&nbsp;<?= Yii::t('application', 'Login') ?>
                                </a>
                                <a href="register.html" class="register"> <i
                                        class="glyphicon glyphicon-user"></i>&nbsp;<?= Yii::t('application', 'Registration') ?>
                                </a>
                                <a href="cart.html" class="visible-xs"> <i
                                        class="glyphicon glyphicon-shopping-cart"></i>&nbsp;<?= Yii::t('application', 'Shopping Cart ({items})', ['items' => '<span class="cart-items">3</span>']) ?>
                                </a>
                                <a href="contact.html"> <i
                                        class="glyphicon glyphicon-phone-alt"></i>&nbsp;<?= Yii::t('application', 'Contact') ?>
                                </a>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-3 col-md-3">
                            <form class="navbar-form" role="search" action=""
                                  method="" id="form-search-id">
                                <div class="input-group">
                                    <input type="text" class="form-control"
                                           placeholder="<?= Yii::t('application', 'Placeholder: Search') ?>"
                                           name="form-search-name" value="">

                                    <div class="input-group-btn">
                                        <button class="btn btn-default"
                                                type="submit">
                                            <i class="glyphicon glyphicon-search"></i>
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end header -->
            <!-- Navigation -->
            <nav class="navbar navbar-default navbar-static">
                <div class="navbar-header">
                    <button class="navbar-toggle" type="button"
                            data-toggle="collapse"
                            data-target=".js-navbar-collapse">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a href="index.html" class="navbar-brand"> <img
                            src="themes/ui-krf/imgs/logos/logo.png"/> </a>
                </div>

                <div class="collapse navbar-collapse js-navbar-collapse">

                    <div class="col-sm-3 col-md-3 pull-right">
                        <div class="cart-top pull-right hidden-xs">
                            <div id="cart" class="">
                                <span
                                    class="icon glyphicon glyphicon-shopping-cart"></span>

                                <div class="heading">
                                    <h4><?= Yii::t('application', 'Shopping Cart') ?></h4>
                                    <a><span
                                            id="cart-total"><?= Yii::t('application', '{items} items - {price}', ['items' => 0, 'price' => '0.00']) ?></span></a>
                                </div>
                                <div class="content">
                                    <div class="empty">
                                        <?= Yii::t('application', 'Your shopping cart is empty!') ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <!-- /.nav-collapse -->
            </nav>
        </header>
        <main class="row">
            <!-- Left sidebar -->
            <div class="col-sm-3 col-md-3 left">
                <div class="well well-sm well-title well-side">
                    <strong><?= Yii::t('application', 'Filters') ?></strong>
                </div>
                <!-- Filters -->
                <div class="well well-sm">
                    <?php $form = ActiveForm::begin([
                        'type' => ActiveForm::TYPE_VERTICAL
                    ]); ?>
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group">
                                <?= ColorInput::widget([
                                    'name' => 'colors',
                                    'showDefaultPalette' => false,
                                    'pluginOptions' => [
                                        'showPalette' => true,
                                        'showPaletteOnly' => true,
                                        'showSelectionPalette' => true,
                                        'showAlpha' => false,
                                        'allowEmpty' => true,
                                        'preferredFormat' => 'name',
                                        'palette' => $colors
                                    ],
                                ]) ?>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group">
                                <?php echo '<label class="control-label">Categories</label>'; ?>
                                <?= Select2::widget([
                                    'name' => 'category[]',
                                    'data' => Category::getCategoryGrouped(),
                                    'language' => Yii::$app->language,

                                    'pluginOptions' => [
                                        'allowClear' => true,
                                    ],
                                    'options' => [
                                        'multiple' => true,
                                        'placeholder' => Yii::t('item', 'Placeholder: Select category ...')
                                    ]
                                ]) ?>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group">
                                <button type="submit"
                                        class="btn btn-primary btn-md btn-cart">
                                    <span
                                        class="icon glyphicon glyphicon-search"></span> <?= Yii::t('application', 'Find') ?>
                                </button>
                            </div>
                        </div>
                    </div>
                    <?php ActiveForm::end(); ?>
                </div>
                <!-- /Filters -->
            </div>
            <!-- Left menu -->
            <!-- / Left sidebar -->
            <div class="col-sm-9 col-md-9">
                <?= $content ?>
            </div>
        </main>
        <!-- Footer -->
        <footer>
            <div class="row">
                <div class="col-lg-12">
                    <div class="col-sm-3 col-md-3">
                        <ul class="nav nav-pills nav-stacked">
                            <li>
                                <a href="#"><?= Yii::t('application', 'FAQ') ?></a>
                            </li>
                        </ul>
                    </div>
                    <div class="col-sm-3 col-md-3">
                        <ul class="nav nav-pills nav-stacked">
                            <li>
                                <a href="#"><?= Yii::t('application', 'Contact') ?></a>
                            </li>
                        </ul>
                    </div>
                    <div class="col-sm-3 col-md-3">
                        <ul class="nav nav-pills nav-stacked">
                            <li>
                                <a href="#"><?= Yii::t('application', 'Who we are') ?></a>
                            </li>
                        </ul>
                    </div>
                    <div class="col-sm-3 col-md-3">
                        <ul class="nav nav-pills nav-stacked">
                            <li>
                                <a href="#"><?= Yii::t('application', 'Payment methods') ?></a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <hr>
            <div class="row">
                <div class="col-lg-12">
                    <ul class="nav nav-pills nav-justified">
                        <li>
                            <a href="/"><?= Yii::t('application', 'Copyright Project', ['year' => date('Y')]) ?></a>
                        </li>
                        <li>
                            <a href="#"><?= Yii::t('application', 'Terms and conditions') ?></a>
                        </li>
                        <li>
                            <a href="#"><?= Yii::t('application', 'Privacy policy') ?></a>
                        </li>
                    </ul>
                </div>

            </div>
        </footer>
        <!-- /Footer -->
        </div>
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
