<?php

/* @var $this yii\web\View */
/* @var $model backend\models\Menu */

$this->title = '新增权限';
$this->params['breadcrumbs'][] = ['label' => '权限管理', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="menu-base-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
