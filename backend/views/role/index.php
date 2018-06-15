<?php

use yii\grid\ActionColumn;
use yii\grid\SerialColumn;
use yii\grid\GridView;
use common\helpers\RenderHelper;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '角色管理';
$this->params['breadcrumbs'][] = $this->title;
$gridColumns = [
    ['class' => SerialColumn::className()],

    'name',
    'description',
    [
        'header' => '角色权限',
        'format' => 'html',
        'value' => function ($model) {
            //return Html::a('配置权限', ['/manage/role/permission', 'id' => $model->name]);
			return Html::a('配置权限', ['/role/list', 'role' => $model->name]);
        },
    ],

    ['class' => ActionColumn::className()],
];
?>
<div class="menu-base-index">
    <p>
        <?= Html::a('新增角色', ['create'], ['class' => 'btn btn-success btn-sm']) ?>
    </p>
     <?php //= Render::gridView($dataProvider, $gridColumns) ?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => $gridColumns,
    ]); ?>
</div>
