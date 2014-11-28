<?php
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use frontend\assets\AppAsset;
use frontend\assets\IE9Asset;
use frontend\widgets\Alert;

/* @var $this \yii\web\View */
/* @var $content string */

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
                    <form class="form-inline form-grid form-grid-sidebar"
                          id="form-grid-sidebar-id" role="form" method="post">
                        <div class="form-group">
                            <select class="selectpicker selectcolors"
                                    name="filter-colour-name"
                                    id="filter-colour-id"
                                    data-placeholder="<?= Yii::t('application', 'Filters') ?>"
                                    multiple="">
                                <option></option>
                                <option value="2">Red</option>
                                <option value="3">Blue</option>
                                <option value="4">Green</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <select id="sidebarCat" name="" multiple="">
                                <optgroup label="Alaskan/Hawaiian Time Zone">
                                    <option value="AK">Alaska</option>
                                    <option value="HI">Hawaii</option>
                                </optgroup>
                                <optgroup label="Pacific Time Zone">
                                    <option value="CA">California</option>
                                    <option value="NV">Nevada</option>
                                    <option value="OR">Oregon</option>
                                    <option value="WA">Washington</option>
                                </optgroup>
                                <optgroup label="Mountain Time Zone">
                                    <option value="AZ">Arizona</option>
                                    <option value="CO">Colorado</option>
                                    <option value="ID">Idaho</option>
                                    <option value="MT">Montana</option>
                                    <option value="NE">Nebraska</option>
                                    <option value="NM">New Mexico</option>
                                    <option value="ND">North Dakota</option>
                                    <option value="UT">Utah</option>
                                    <option value="WY">Wyoming</option>
                                </optgroup>
                                <optgroup label="Central Time Zone">
                                    <option value="AL">Alabama</option>
                                    <option value="AR">Arkansas</option>
                                    <option value="IL">Illinois</option>
                                    <option value="IA">Iowa</option>
                                    <option value="KS">Kansas</option>
                                    <option value="KY">Kentucky</option>
                                    <option value="LA">Louisiana</option>
                                    <option value="MN">Minnesota</option>
                                    <option value="MS">Mississippi</option>
                                    <option value="MO">Missouri</option>
                                    <option value="OK">Oklahoma</option>
                                    <option value="SD">South Dakota</option>
                                    <option value="TX">Texas</option>
                                    <option value="TN">Tennessee</option>
                                    <option value="WI">Wisconsin</option>
                                </optgroup>
                                <optgroup label="Eastern Time Zone">
                                    <option value="CT">Connecticut</option>
                                    <option value="DE">Delaware</option>
                                    <option value="FL">Florida</option>
                                    <option value="GA">Georgia</option>
                                    <option value="IN">Indiana</option>
                                    <option value="ME">Maine</option>
                                    <option value="MD">Maryland</option>
                                    <option value="MA">Massachusetts</option>
                                    <option value="MI">Michigan</option>
                                    <option value="NH">New Hampshire</option>
                                    <option value="NJ">New Jersey</option>
                                    <option value="NY">New York</option>
                                    <option value="NC">North Carolina</option>
                                    <option value="OH">Ohio</option>
                                    <option value="PA">Pennsylvania</option>
                                    <option value="RI">Rhode Island</option>
                                    <option value="SC">South Carolina</option>
                                    <option value="VT">Vermont</option>
                                    <option value="VA">Virginia</option>
                                    <option value="WV">West Virginia</option>
                                </optgroup>
                            </select>
                        </div>
                        <div class="form-group">
                            <button type="submit"
                                    class="btn btn-primary btn-md btn-cart">
                                <span
                                    class="icon glyphicon glyphicon-search"></span> <?= Yii::t('application', 'Find') ?>
                            </button>
                        </div>
                    </form>
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
