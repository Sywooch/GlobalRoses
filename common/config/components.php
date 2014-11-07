<?php
return [
    'assetManager' => [
        'linkAssets' => true,
        'bundles' => [
            'yii\bootstrap\BootstrapAsset' => [
                'css' => [
                    'css/bootstrap.min.css',
                ]
            ],
            'yii\bootstrap\BootstrapPluginAsset' => [
                'js' => [
                    YII_ENV_DEV ? 'js/bootstrap.js' : 'js/bootstrap.min.js',
                ]
            ],
        ]
    ],
    'cache' => [
        'class' => 'yii\caching\FileCache',
    ],
];
