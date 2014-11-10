<?php
return [
    'request' => [
        'baseUrl' => '',
    ],
    'user' => [
        'identityClass' => 'common\models\User',
        'enableAutoLogin' => true,
    ],
    'log' => [
        'traceLevel' => YII_DEBUG ? 3 : 0,
        'targets' => [
            [
                'class' => 'yii\log\FileTarget',
                'levels' => ['error', 'warning'],
            ],
        ],
    ],
    'errorHandler' => [
        'errorAction' => 'site/error',
    ],
    'i18n' => [
        'translations' => [
            'common/*' => array(
                'class' => 'yii\i18n\PhpMessageSource',
                'basePath' => "@common/messages",
                'sourceLanguage' => '',
                'fileMap' => [
                    'common/application' => 'application.php'
                ]
            ),
            '*'=>array(
                'class' => 'yii\i18n\PhpMessageSource',
                'basePath' => "@frontend/messages",
                'sourceLanguage'=>''
            ),
        ]
    ]
];
