<?php
return [
    'dynagrid' => [
        'class' => '\kartik\dynagrid\Module',
    ],
    'gridview' => [
        'class' => '\kartik\grid\Module',
        'i18n' => [
            'class' => 'yii\i18n\PhpMessageSource',
            'basePath' => "@common/messages",
            'forceTranslation' => true
        ]
    ],
];
