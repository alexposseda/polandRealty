<?php
    return [
        'components' => [
            'db'     => [
                'class'       => 'yii\db\Connection',
                'dsn'         => 'mysql:host=localhost;dbname=yii2advanced',
                'username'    => '',
                'password'    => '',
                'charset'     => 'utf8',
                'tablePrefix' => ''
            ],
            'mailer' => [
                'class'            => 'yii\swiftmailer\Mailer',
                'viewPath'         => '@common/mail',
                'useFileTransport' => false,
                'transport'        => [
                    'class'      => 'Swift_SmtpTransport',
                    'host'       => 'smtp.gmail.com',
                    'username'   => '',
                    'password'   => '',
                    'port'       => '587',
                    'encryption' => 'tls',
                ],
            ],
        ],
    ];
