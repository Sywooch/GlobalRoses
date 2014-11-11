<?php
use yii\helpers\Html;
use yii\helpers\Url;

/* @var $this \yii\web\View */
/* @var $content string */
?>

<!-- sidebar: style can be found in sidebar.less -->
<section class="sidebar">
    <!-- Sidebar user panel -->
    <div class="user-panel">
        <div class="pull-left image">
            <?php echo Html::beginTag('img', [
                'class' => 'img-circle',
                'src' => Yii::$app->request->baseUrl . '/themes/adminlte/img/avatar5.png',
                'alt' => Yii::t('application', 'Admin Image Alt')]);
            echo Html::endTag('img')
            ?>
        </div>
        <div class="pull-left info">
            <p><?= Yii::t('application', 'Hello, username', ['username' => Yii::$app->user->identity->username]) ?></p>
            <a href="#"><i
                    class="fa fa-circle text-success"></i> <?= Yii::t('application', 'Online') ?>
            </a>
        </div>
    </div>
    <!-- search form -->
    <form action="#" method="get" class="sidebar-form">
        <div class="input-group">
            <input type="text" name="q" class="form-control"
                   placeholder="<?= Yii::t('application', 'Search...') ?>"/>
                <span class="input-group-btn">
                    <button type='submit' name='search' id='search-btn'
                            class="btn btn-flat"><i class="fa fa-search"></i>
                    </button>
                </span>
        </div>
    </form>
    <!-- /.search form -->
    <!-- sidebar menu: : style can be found in sidebar.less -->
    <ul class="sidebar-menu">
        <li>
            <a href="<?= Url::home() ?>">
                <i class="fa fa-dashboard"></i>
                <span><?= Yii::t('dashboard', 'menu-title') ?></span>
            </a>
        </li>
        <li class="treeview">
            <a href="#">
                <i class="fa fa-bar-chart-o"></i>
                <span><?= Yii::t('item', 'menu-title') ?></span>
                <i class="fa fa-angle-left pull-right"></i>
            </a>
            <ul class="treeview-menu">
                <li><a href="<?= Url::toRoute(['item/']) ?>"><i
                            class="fa fa-angle-double-right"></i> <?= Yii::t('item', 'menu-title') ?>
                    </a></li>
                <li><a href="<?= Url::toRoute(['category/']) ?>"><i
                            class="fa fa-angle-double-right"></i> <?= Yii::t('items/category', 'menu-title') ?>
                    </a></li>
                <li><a href="<?= Url::toRoute(['color/']) ?>"><i
                            class="fa fa-angle-double-right"></i> <?= Yii::t('items/color', 'menu-title') ?>
                    </a></li>
            </ul>
        </li>
        <li>
            <a href="<?= Url::toRoute(['order/']) ?>">
                <i class="fa fa-money"></i>
                <span><?= Yii::t('order', 'menu-title') ?></span>
            </a>
        </li>
        <li>
            <a href="<?= Url::toRoute(['user/']) ?>">
                <i class="fa fa-users"></i>
                <span><?= Yii::t('user', 'menu-title') ?></span>
            </a>
        </li>
    </ul>
</section><!-- /.sidebar -->