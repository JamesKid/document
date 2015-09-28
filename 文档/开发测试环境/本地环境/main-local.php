<?php

$config = [
    'components' => [
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => 'T3Ky5O-qENG9NmN0N8y_GGUZ4axK570Y-local',
        ],
        'db' => [
            'class' => 'yii\db\Connection',
                'dsn' => 'mysql:host=127.0.0.1;dbname=elearninglms',
//                'dsn' => 'mysql:host=115.29.48.215;dbname=elearninglms',
            'username' => 'root',
            'password' => 'root',
//            'password' => 'Root@Mysql.2015',
            'charset' => 'utf8',
            'tablePrefix'=>'eln_'
        ],
		'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            'viewPath' => '@common/mail',
            // send all mails to a file by default. You have to set
            // 'useFileTransport' to false and configure a transport
            // for the mailer to send real emails.
            'useFileTransport' => true,
            'enableSwiftMailerLogging' => true,
        ],
    ],
];

if (YII_DEBUG) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = 'yii\debug\Module';

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = 'yii\gii\Module';
}

return $config;