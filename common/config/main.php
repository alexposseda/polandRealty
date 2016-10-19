<?php
    return [
        'sourceLanguage' => 'en',
        'language' => 'en',
        'vendorPath'     => dirname(dirname(__DIR__)).'/vendor',
        'components'     => [
            'cache'       => [
                'class' => 'yii\caching\FileCache',
            ],
            'authManager' => [
                'class' => 'yii\rbac\DbManager',
            ],
            'urlManager'  => [
                'class'     => 'codemix\localeurls\UrlManager',
                'showScriptName' => false,
                'rules' => [
                ],
                'languages' => [
                    'en',
                    'pl'
                ],
            ],
            'i18n'        => [
                'translations' => [
                    'app'   => [
                        'class'    => 'yii\i18n\PhpMessageSource',
                        'basePath' => '@common/translations',
                    ],
                    'data'   => [
                        'class'    => 'yii\i18n\PhpMessageSource',
                        'basePath' => '@common/translations',
                    ],
                    'info'  => [
                        'class'    => 'yii\i18n\PhpMessageSource',
                        'basePath' => '@common/translations',
                    ],
                    'error' => [
                        'class'    => 'yii\i18n\PhpMessageSource',
                        'basePath' => '@common/translations',
                    ],
                ],
            ]
        ],
    ];
