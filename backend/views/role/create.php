<?php

/* @var $this yii\web\View */
/* @var $model \backend\models\Role */

$this->title = '新增角色';
$this->params['breadcrumbs'][] = ['label' => '角色管理', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="menu-base-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
