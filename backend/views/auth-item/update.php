<?php

/* @var $this yii\web\View */
/* @var $model backend\models\Menu */

$this->title = '修改权限: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => '权限管理', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->name]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="menu-base-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
