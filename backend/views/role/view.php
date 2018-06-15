<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model \backend\models\Role */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => '角色管理', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="menu-base-view">

    <p>
        <?= Html::a('修改角色', ['update', 'id' => $model->name], ['class' => 'btn btn-primary btn-sm']) ?>
        <?= Html::a('删除角色', ['delete', 'id' => $model->name], [
            'class' => 'btn btn-danger btn-sm',
            'data' => [
                'confirm' => '确定要删除这条数据吗？',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'name',
            'description',
        ],
    ]) ?>

</div>
