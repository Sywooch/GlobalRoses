<?php
use yii\helpers\Html;

?>
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
                        <?php
                        echo Html::a(
                            sprintf('<i class="glyphicon glyphicon-circle-arrow-right"></i>&nbsp;%s', Yii::t('application', 'Login')),
                            ['login'], ['class' => 'login']);
                        echo Html::a(
                            sprintf('<i class="glyphicon glyphicon-user"></i>&nbsp;%s', Yii::t('application', 'Registration')),
                            ['signup'], ['class' => 'register']);
                        echo Html::a(
                            sprintf('<i class="glyphicon glyphicon-shopping-cart"></i>&nbsp;%s', Yii::t('application', 'Shopping Cart ({items})', ['items' => '<span class="cart-items">3</span>'])),
                            ['cart'], ['class' => 'visible-xs']);
                        echo Html::a(
                            sprintf('<i class="glyphicon glyphicon-phone-alt"></i>&nbsp;%s', Yii::t('application', 'Contact')),
                            ['contact']);
                        ?>
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
            <?= Html::a('<img src="/themes/ui-krf/imgs/logos/logo.png"/>',
                Yii::$app->homeUrl, ['class' => 'navbar-brand']) ?>
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