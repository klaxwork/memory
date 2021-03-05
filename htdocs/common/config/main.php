<?php
return [
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm' => '@vendor/npm-asset',
        '@t' => 'main',
    ],
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'components' => [
        'db' => [
            'class' => 'yii\db\Connection',
            'dsn' => 'pgsql:host=127.0.0.1;port=5432;dbname=memory_v02_dev',
            'username' => 'postgres',
            'password' => 'postgres',
            'charset' => 'utf8',
        ],
        'elasticsearch' => [
            'class' => 'yii\elasticsearch\Connection',
            'autodetectCluster' => false,
            'nodes' => [
                'node' => [
                    //'http_address' => 'elastic.whdb:9200',
                    'http_address' => '127.0.0.1:9200',
                    //'nameDB' => 'fish_test_server',
                ],
                // configure more hosts if you have a cluster
            ],
        ],
        'elasticsearchFilter' => [
            'class' => 'yii\elasticsearch\Connection',
            'autodetectCluster' => false,
            'nodes' => [
                'node' => [
                    //'http_address' => 'elastic.whdb:9200',
                    'http_address' => '127.0.0.1:9200',
                    //'nameDB' => 'fish_filter_test',
                ],
                // configure more hosts if you have a cluster
            ],
        ],
        'mymailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            'viewPath' => '@common/mail',
        ],
        //*/
        'cache' => [
            'class' => 'yii\caching\FileCache',
            'keyPrefix' => 'fishmen5',
        ],
        //*/
    ],
];
