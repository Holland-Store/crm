<?php
return [
	'language' => 'ru-RU',
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'components' => [
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
    ],
    'aliases' => [
        '@YiiNodeSocket' => '@vendor/ratacibernetica/yii2-node-socket/lib/php',
        '@nodeWeb' => '@vendor/ratacibernetica/yii2-node-socket/lib/js',
        '@console'=>dirname(dirname(__DIR__)) . '/console',
    ],
];
