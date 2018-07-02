<?php

$config = [
	// 'db' => [
        // 'class' => 'yii\db\Connection',
        // 'dsn' => 'mysql:host=127.0.0.1;dbname=yii_base',
        // 'username' => 'root',
        // 'password' => '123456',
        // 'charset' => 'utf8',
    // ],

	'db' => [
        'class' => 'yii\db\Connection',
        'dsn' => 'mysql:host=192.168.0.195;dbname=tuangou',
        'username' => 'tuangou',
        'password' => 'ux2Lw3XGOuBRV0AQ',
        'charset' => 'utf8',
    ],

    'redis' => [
        'class' => 'yii\redis\Connection',
        'hostname' => '127.0.0.1',
        'port' => 6379,
        'database' => 6,
    ],
];
return $config;
