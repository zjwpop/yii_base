<?php

use yii\helpers\Html;
use yii\grid\GridView;
use backend\models\AdminMenu;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '菜单管理';
$this->params['breadcrumbs'][] = $this->title;
$gridColumns = [
    //['class' => SerialColumn::className()],

    'id',
    'name',
    [
        'attribute' => 'pid',
        'value' => function ($model) {
            return AdminMenu::getMenuMap($model->pid);
        },
    ],
    //'uri',
    [
        'attribute' => 'uri',
        'format'=>'raw',
        'value' => function ($model) {
            if(!empty($model->uri) && $model->uri!='#'){
                return Html::a($model->uri,$model->uri,['target'=>'_blank']);
            }
        },
    ],
    'description',
    [
        'attribute' => 'status',
        'value' => function ($model) {
            return AdminMenu::statusMap($model->status);
        },
    ],

    [
        'class' => 'yii\grid\ActionColumn',
        'template' => '{update} {delete}',
    ],

    [
        'header' => '子菜单',
        'format' => 'raw',
        'value' => function($model){
            $str=Html::a('查看子菜单',['index','MenuSearch[pid]'=>$model->id],['class'=>'btn btn-xs btn-warning']).' '
                .Html::a('添加子菜单',['create','pid'=>$model->id],['class'=>'btn btn-xs btn-warning']);
            return $str;
        }
    ],
     'icon',
    'order_index',
];
?>
<style type="text/css">
    th,td{text-align: center;}
</style>
<div class="menu-base-index" style="width: 1000px;">
    <?php echo $this->render('_search', ['model' => $searchModel]); ?>
    <?php // = RenderHelper::gridView($dataProvider, $gridColumns) ?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => $gridColumns,
    ]); ?>
</div>
