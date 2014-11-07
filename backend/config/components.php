<?php
return [
    'view' => [
        'theme' => [
            'pathMap' => [
                '@app/views' => '@webroot/themes/adminlte/views'
            ]
        ]
    ],
    'request' => [
        'baseUrl' => '/admin',
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
            'common*'=>array(
                'class' => 'yii\i18n\PhpMessageSource',
                'basePath' => "@common/messages",
                'sourceLanguage'=>''
            ),
            '*'=>array(
                'class' => 'yii\i18n\PhpMessageSource',
                'basePath' => "@backend/messages",
                'sourceLanguage'=>''
            ),
        ]
    ]
];
