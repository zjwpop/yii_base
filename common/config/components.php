<?php

$config = [
    'formatter' => [
        'nullDisplay' => '',
        'dateFormat' => 'php:Y-m-d',
        'datetimeFormat' => 'php:Y-m-d H:i:s',
    ],
	'log' => [
		'traceLevel' => YII_DEBUG ? 3 : 0,
		'targets' => [
			[
				'class' => 'yii\log\FileTarget',
				// 'common\nmc\FileTarget',
				'levels' => ['error', 'warning'],
			],
		],
	],
];

return $config;
