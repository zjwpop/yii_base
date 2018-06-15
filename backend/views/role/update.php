<?php

/* @var $this yii\web\View */
/* @var $model \backend\models\Role */

$this->title = '修改角色: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => '角色管理', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->name]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="menu-base-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
