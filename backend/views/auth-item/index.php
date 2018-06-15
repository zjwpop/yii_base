<?php

use admin\models\AdminMenu;
use yii\grid\SerialColumn;
use yii\grid\ActionColumn;
use yii\grid\GridView;
//use common\helpers\Render;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '权限管理';
$this->params['breadcrumbs'][] = $this->title;
$gridColumns = [
    ['class' => SerialColumn::className()],

    // [
    //     'attribute' => 'menu_id',
    //     'value' => function ($model) {
    //         return AdminMenu::getMenuMap($model->menu_id);
    //     },
    // ],
    'name',
    'description',

    ['class' => ActionColumn::className()],
];
?>
<div class="menu-base-index">
    <p>
        <?= Html::a('新增权限', ['create'], ['class' => 'btn btn-success btn-sm']) ?>
    </p>
    <?php //= Render::gridView($dataProvider, $gridColumns) ?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => $gridColumns,
    ]); ?>
</div>
