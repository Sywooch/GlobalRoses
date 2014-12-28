<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace frontend\assets;

use yii\web\AssetBundle;

/**
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'themes/ui-krf/css/bootstrap-theme.css',
        'themes/ui-krf/css/owl.carousel.css',
        'css/site.css',

    ];
    public $js = [
        'themes/ui-krf/js/vendor/owl.carousel.min.js',
        'themes/ui-krf/js/app.js',
        'js/app.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
        'yii\bootstrap\BootstrapPluginAsset',
        'kartik\select2\Select2Asset',
    ];
}
