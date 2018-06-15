<?php

$config = [
	'cache' => [
		'class' => 'yii\caching\FileCache',
	],
	'request' => [
		'class' => 'yii\web\Request',
		'csrfParam' => '_csrf-backend',
		'csrfCookie' => [
			'name' => '_csrf-backend',
		],
	],
	'user' => [
		'identityClass' => '',
		'loginUrl' => ['/login'],
		'enableAutoLogin' => true,
		'identityCookie' => [
			'name' => '_identity-backend',
			'httpOnly' => true,
		],
	],
	'session' => [
		'class' => 'yii\web\Session',
		// this is the name of the session cookie used for login on the backend
		'name' => 'advanced-backend',
	],
	'errorHandler' => [
		'errorAction' => 'site/error',
	],
	'urlManager' => [
		'enablePrettyUrl' => true,
		'showScriptName' => false,
		'rules' => [
			'login' => '/user/default/login',
			'logout' => '/user/default/logout',
		],
	],
	'authManager' => [
		'class' => 'yii\rbac\DbManager',
	],
];

return $config;
