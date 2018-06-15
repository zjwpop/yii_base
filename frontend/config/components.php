<?php

$config = [
	'cache' => [
		'class' => 'yii\caching\FileCache',
	],
	'request' => [
		'class' => 'yii\web\Request',
		'csrfParam' => '_csrf-frontend',
		'csrfCookie' => [
			'name' => '_csrf-frontend',
		],
	],
	'user' => [
		'identityClass' => '',
		'loginUrl' => ['/login'],
		'enableAutoLogin' => true,
		'identityCookie' => [
			'name' => '_identity-frontend',
			'httpOnly' => true,
		],
	],
	'session' => [
		'class' => 'yii\web\Session',
		// this is the name of the session cookie used for login on the backend
		'name' => 'advanced-frontend',
	],
	'errorHandler' => [
		'errorAction' => 'site/error',
	],
	'urlManager' => [
		'enablePrettyUrl' => true,
		'showScriptName' => false,
	],
];

return $config;
