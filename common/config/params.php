<?php
    return [
        'adminEmail'                    => 'admin@gr.solutions',
        'supportEmail'                  => 'admin@gr.solutions',
        'user.passwordResetTokenExpire' => 3600,
        'user.emailConfirmTokenExpire'  => 3600,
        'mapConfig'                     => [
            'center' => [
                'lat' => 51.919438,
                'lng' => 19.145136
            ],
            'zoom'   => 9
        ],
        'fileManager'                   => [
            'storagePath'         => dirname(dirname(__DIR__)).'/www/storage',
            'storageUrl'          => 'http://poland.promo.gr.solutions/storage/',
            'baseValidationRules' => [
                'file',
                'maxFiles' => 1,
                'maxSize'  => 1024 * 1024,
            ],
            'attributeName'       => 'file',
        ],
        'userStatuses'                  => [
            10 => 'active',
            1  => 'not confirmed',
            0  => 'deleted'
        ]
    ];
