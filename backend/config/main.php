<?php
$params = array_merge(
    require __DIR__ . '/../../common/config/params.php',
    require __DIR__ . '/../../common/config/params-local.php',
    require __DIR__ . '/params.php',
    require __DIR__ . '/params-local.php'
);

return [
    'id' => 'app-backend',
    'basePath' => dirname(__DIR__),
    'controllerNamespace' => 'backend\controllers',
    'bootstrap' => ['log'],
	
	'aliases' => [
		'@adminlte/widgets' => '@vendor/adminlte/yii2-widgets'
	],
    'modules' => [
		'gridview' =>  [
        'class' => '\kartik\grid\Module'
    	],
	],
    'components' => [
       
		'apu' => [
            'class' => 'common\components\ApuComponent'
        ],
		'request'=>[
   		 	'class' => 'common\components\Request',
    		'web'=> '/backend/web',
            'baseUrl'=>'/admin',
    		'adminUrl' => '/admin',
			'enableCsrfValidation' => false,
			
		],
        'user' => [
            'identityClass' => 'common\models\User',
            'enableAutoLogin' => true,
            'identityCookie' => ['name' => '_identity-backend', 'httpOnly' => true],
        ],
        'session' => [
            // this is the name of the session cookie used for login on the backend
            'name' => 'cnaexam-backend',
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
            'enablePrettyUrl' => false,
            'showScriptName' => false,
            'baseUrl' => '/admin',
            
		],
		'urlManagerFrontEnd' => [
            'class' => 'yii\web\urlManager',
            'baseUrl' => '/',
            'enablePrettyUrl' => true,
            'showScriptName' => false,
        ],
       
    ],
    'params' => $params,
];
