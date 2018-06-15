<?php

$config = [
    'manage' => [
        'class' => 'backend\modules\manage\Module',
        'layout' => '@backend/views/layouts/manage',
    ],
    'user' => [
        'class' => 'backend\modules\user\Module',
        'layout' => '@backend/views/layouts/user_form',
    ],
    // 表格用
    'gridview' => [
        'class' => 'kartik\grid\Module',
    ],
];

return $config;
