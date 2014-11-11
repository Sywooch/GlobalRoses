<?php
return [
    'view' => [
        'theme' => [
            'pathMap' => [
                '@app/views' => '@backend/views/adminlte'
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
                'basePath' => "@backend/messages",
                'sourceLanguage' => '',

            ),
        ]
    ]
];
