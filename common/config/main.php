<?php
$db =    require __DIR__ . '/db.php';
return [
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
    ],
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'components' => [
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'session' => [
            'class' => 'yii\redis\Session',
            'redis' => [
                'hostname' => '192.168.33.10',
                'port' => 6379,
                'database' => 0,
            ],
        ],
        'db' => $db['itbook'],
        'itbook_log' => $db['itbook_log'],
        'redis' => [
            'class' => 'yii\redis\Connection',
            'hostname' => '192.168.33.10',
            'port' => 6379,
            'database' => 0,
        ],
    ],
];
