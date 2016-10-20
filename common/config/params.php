<?php
return [
    'adminEmail' => 'admin@example.com',
    'supportEmail' => 'support@example.com',
    'user.passwordResetTokenExpire' => 3600,
    'user.emailConfirmTokenExpire' => 3600,
    'mapConfig'=>[
        'center' => [
            'lat'=> 51.919438, 'lng' => 19.145136
        ],
        'zoom' => 9
    ],
    'fileManager' => [
        'storagePath'         => dirname(dirname(__DIR__)).'/www/storage',
        'storageUrl'          => 'http://poland.local/storage/',
        'baseValidationRules' => [
            'file',
            'maxFiles' => 1,
            'maxSize'  => 1024 * 1024,
        ],
        'attributeName'       => 'file',
    ],
];
