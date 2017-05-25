<?php
$params = array_merge(
    require(__DIR__ . '/../../common/config/params.php'),
    require(__DIR__ . '/../../common/config/params-local.php'),
    require(__DIR__ . '/params.php'),
    require(__DIR__ . '/params-local.php')
);

return [
    'id' => 'app-frontend',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log', 'nodeSocket','frontend\bootstraps\AppBootstrap'],
    'controllerNamespace' => 'frontend\controllers',
    'components' => [
        'request' => [
            'csrfParam' => '_csrf-frontend',
        ],
        'user' => [
            'identityClass' => 'common\models\User',
            'enableAutoLogin' => true,
            'identityCookie' => ['name' => '_identity-frontend', 'httpOnly' => true],
        ],
        'session' => [
            // this is the name of the session cookie used for login on the frontend
            'name' => 'advanced-frontend',
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
        
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
				'admin' => 'zakaz/admin',
				'view/<id:\d+>' => 'zakaz/view',
				'disain' => 'zakaz/disain',
				'master' => 'zakaz/master',
				'shop' => 'zakaz/shop',
				'courier' => 'courier/index',
				'todoist' => 'todoist/index',
				'helpdesk' => 'helpdesk/index',
				'custom' => 'custom/index',
				'versia' => 'zakaz/index',
				'create' => 'zakaz/create',
				'updete/<id:\d+>' => 'zakaz/update',
				'login' => 'site/login',
				'logout' => 'site/logout',
				'createzakaz/<id_zakaz:\d+>' => 'todoist/createzakaz',
				'view-todoist/<id:\d+>' => 'todoist/view',
            ],
        ],
        'nodeSocket' => [
		    'class' => '\YiiNodeSocket\NodeSocket',
//		    'dbOptions' => '',
		    'host' => 'localhost',
		    'allowedServerAddresses' => [
		        "localhost",
		        "127.0.0.1"
		    ],
		    'origin' => '*:*',
		    'sessionVarName' => 'PHPSESSID',
		    'port' => 3001,
		    'socketLogFile' => '/var/log/node-socket.log',
		],
    ],
    'params' => $params,
];
