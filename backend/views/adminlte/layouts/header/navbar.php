<?php
use yii\helpers\Html;
use yii\helpers\Url;

/* @var $this \yii\web\View */
/* @var $content string */
?>
<?= Html::a(Yii::t('common/application', 'PROJECT NAME'), Yii::$app->homeUrl, ['class' => 'logo']) ?>
<nav class="navbar navbar-static-top" role="navigation">
    <!-- Sidebar toggle button-->
    <a href="#" class="navbar-btn sidebar-toggle" data-toggle="offcanvas"
       role="button">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
    </a>

    <div class="navbar-right">
        <ul class="nav navbar-nav">
            <!-- Tasks: style can be found in dropdown.less -->
            <li class="dropdown tasks-menu">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                    <i class="fa fa-tasks"></i>
                    <span class="label label-danger">9</span>
                </a>
                <ul class="dropdown-menu">
                    <li class="header">You have 9 tasks</li>
                    <li>
                        <!-- inner menu: contains the actual data -->
                        <ul class="menu">
                            <li><!-- Task item -->
                                <a href="#">
                                    <h3>
                                        Design some buttons
                                        <small class="pull-right">20%</small>
                                    </h3>
                                    <div class="progress xs">
                                        <div
                                            class="progress-bar progress-bar-aqua"
                                            style="width: 20%"
                                            role="progressbar"
                                            aria-valuenow="20" aria-valuemin="0"
                                            aria-valuemax="100">
                                            <span
                                                class="sr-only">20% Complete</span>
                                        </div>
                                    </div>
                                </a>
                            </li>
                            <!-- end task item -->
                            <li><!-- Task item -->
                                <a href="#">
                                    <h3>
                                        Create a nice theme
                                        <small class="pull-right">40%</small>
                                    </h3>
                                    <div class="progress xs">
                                        <div
                                            class="progress-bar progress-bar-green"
                                            style="width: 40%"
                                            role="progressbar"
                                            aria-valuenow="20" aria-valuemin="0"
                                            aria-valuemax="100">
                                            <span
                                                class="sr-only">40% Complete</span>
                                        </div>
                                    </div>
                                </a>
                            </li>
                            <!-- end task item -->
                            <li><!-- Task item -->
                                <a href="#">
                                    <h3>
                                        Some task I need to do
                                        <small class="pull-right">60%</small>
                                    </h3>
                                    <div class="progress xs">
                                        <div
                                            class="progress-bar progress-bar-red"
                                            style="width: 60%"
                                            role="progressbar"
                                            aria-valuenow="20" aria-valuemin="0"
                                            aria-valuemax="100">
                                            <span
                                                class="sr-only">60% Complete</span>
                                        </div>
                                    </div>
                                </a>
                            </li>
                            <!-- end task item -->
                            <li><!-- Task item -->
                                <a href="#">
                                    <h3>
                                        Make beautiful transitions
                                        <small class="pull-right">80%</small>
                                    </h3>
                                    <div class="progress xs">
                                        <div
                                            class="progress-bar progress-bar-yellow"
                                            style="width: 80%"
                                            role="progressbar"
                                            aria-valuenow="20" aria-valuemin="0"
                                            aria-valuemax="100">
                                            <span
                                                class="sr-only">80% Complete</span>
                                        </div>
                                    </div>
                                </a>
                            </li>
                            <!-- end task item -->
                        </ul>
                    </li>
                    <li class="footer">
                        <a href="#">View all tasks</a>
                    </li>
                </ul>
            </li>
            <!-- User Account: style can be found in dropdown.less -->
            <li class="dropdown user user-menu">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                    <i class="glyphicon glyphicon-user"></i>
                    <span><?= Yii::t('application', 'username', ['username' => Yii::$app->user->identity->email]) ?>
                        <i class="caret"></i></span>
                </a>
                <ul class="dropdown-menu">
                    <!-- User image -->
                    <li class="user-header bg-light-blue">
                        <?php echo Html::beginTag('img', [
                            'class' => 'img-circle',
                            'src' => Yii::$app->request->baseUrl . '/themes/adminlte/img/avatar5.png',
                            'alt' => Yii::t('application', 'Admin Image Alt')]);
                        echo Html::endTag('img')
                        ?>
                        <p>
                            <?= Yii::t('application', 'username - position', [
                                'username' => Yii::$app->user->identity->email,
                                'position' => Yii::t('user', 'administrator_position')
                            ]) ?>
                            <small></small>
                        </p>
                    </li>
                    <!-- Menu Footer-->
                    <li class="user-footer">
                        <div class="pull-left">
                            <?= Html::a(
                                Yii::t('application', 'view your profile'),
                                Url::toRoute(['user/view', 'id' => Yii::$app->user->identity->id]),
                                [
                                    'class' => 'btn btn-default btn-flat',
                                ]) ?>
                        </div>
                        <div class="pull-right">
                            <?= Html::a(
                                Yii::t('application', 'sign out'),
                                Url::to(['/site/logout']),
                                [
                                    'class' => 'btn btn-default btn-flat',
                                    'data-method' => 'post'
                                ]) ?>
                        </div>
                    </li>
                </ul>
            </li>
        </ul>
    </div>
</nav>