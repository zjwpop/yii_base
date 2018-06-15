<?php

use backend\models\Menu;
use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model Menu */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => '权限管理', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="menu-base-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('修改权限', ['update', 'id' => $model->name], ['class' => 'btn btn-primary btn-sm']) ?>
        <?= Html::a('删除权限', ['delete', 'id' => $model->name], [
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
