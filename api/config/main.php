<?php

$params = array_merge(
    require(__DIR__ . '/../../common/config/params.php'),
    require(__DIR__ . '/../../common/config/params-local.php'),
    require(__DIR__ . '/params.php'),
    require(__DIR__ . '/params-local.php')
);

$components = array_merge(
    require(__DIR__ . '/components.php'),
    require(__DIR__ . '/db.php')// 数据库
);

//$modules = require(__DIR__ . '/modules.php');

$config = [
    'id' => 'admin',
    'name' => '****公司',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'controllerNamespace' => 'api\controllers',
    'params' => $params,
    'components' => $components,
    ///'modules' => $modules,
    'as access' => [
        'class' => 'yii\filters\AccessControl',
        'only' => [
            'gii/*',
            'manage/*'
        ],
        'rules' => [
            [
                'allow' => true,
                'roles' => ['@'],
            ],
        ],
    ],
];

if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = [
        'class' => 'yii\debug\Module',
        'allowedIPs' => ['*.*.*.*'],
    ];

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
        'generators' => [
            'model' => [
                'class' => 'yii\gii\generators\model\Generator',
                'ns' => 'common\models\base',
                'baseClass' => 'common\extensions\ActiveRecord',
                'generateLabelsFromComments' => true,
                'useTablePrefix' => false,
            ],
            'crud' => [
                'class' => 'yii\gii\generators\crud\Generator',
                'modelClass' => 'backend\models\(Model名)',
                'controllerClass' => 'backend\modules\manage\controllers\(Model名)Controller',
                'viewPath' => '@backend/modules/manage/views/(路由)',
                'baseControllerClass' => 'backend\modules\manage\controllers\base\ModuleController',
                'searchModelClass' => 'backend\models\search\(Model名)Search',
            ],
        ],
    ];
}

return $config;
