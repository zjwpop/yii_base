<?php

use backend\models\Auth;
use backend\models\Menu;
use yii\helpers\Html;
use yii\rbac\DbManager;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\Role */

$this->title = '角色权限';
$this->params['breadcrumbs'][] = ['label' => '角色管理', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

$menus = Menu::tree();
$auth_items = [];
$list = Auth::find()->where(['type' => 2])->all();
foreach ($list as $item) {
    $menu_id = $item['menu_id'];
    if (!isset($auth_items[$menu_id])) {
        $auth_items[$menu_id] = [];
    }
    $auth_items[$menu_id][] = [
        'name' => $item['name'],
        'description' => $item['description'],
    ];
}

$auth = Yii::$app->authManager;
$role = $auth->createRole($model->name);

$auth_db = new DbManager();
$auth_db->init();
$items = $auth_db->getPermissionsByRole($model->name);
?>
<div class="menu-base-create">

    <div class="menu-base-form">

        <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($model, 'name')->textInput(['disabled' => true]) ?>

        <?= $form->field($model, 'description')->textInput(['disabled' => true]) ?>

        <ul>
            <li>
                未分类权限
                <input type="checkbox" class="checkall">全选
                <ul>
                    <?php if (isset($auth_items[0])): ?>
                        <?php foreach ($auth_items[0] as $item): ?>
                            <li>
                                <input type="checkbox" name="auth[]"
                                       value="<?= $item['name'] ?>" <?= isset($items[$item['name']]) ? 'checked' : '' ?>>
                                <?= $item['description'] ?>
                            </li>
                        <?php endforeach ?>
                    <?php endif ?>
                </ul>
            </li>
            <hr>
            <?php foreach ($menus as $top_menu): ?>
                <li>
                    <?= $top_menu['name'] ?>
                    <input type="checkbox" class="checkall">全选
                    <ul>

                        <?php if (isset($auth_items[$top_menu['id']])): ?>
                            <?php foreach ($auth_items[$top_menu['id']] as $item): ?>
                                <li>
                                    <input type="checkbox" name="auth[]"
                                           value="<?= $item['name'] ?>" <?= isset($items[$item['name']]) ? 'checked' : '' ?>>
                                    <?= $item['description'] ?>
                                </li>
                            <?php endforeach ?>
                        <?php endif ?>

                        <?php if (isset($top_menu['children'])): ?>
                            <?php foreach ($top_menu['children'] as $side_menu): ?>
                                <li>
                                    <?= $side_menu['name'] ?>
                                    <input type="checkbox" class="checkall">全选
                                    <ul>

                                        <?php if (isset($auth_items[$side_menu['id']])): ?>
                                            <?php foreach ($auth_items[$side_menu['id']] as $item): ?>
                                                <li>
                                                    <input type="checkbox" name="auth[]"
                                                           value="<?= $item['name'] ?>" <?= isset($items[$item['name']]) ? 'checked' : '' ?>>
                                                    <?= $item['description'] ?>
                                                </li>
                                            <?php endforeach ?>
                                        <?php endif ?>

                                        <?php if (isset($side_menu['children'])): ?>
                                            <?php foreach ($side_menu['children'] as $sub_menu): ?>
                                                <li>
                                                    <?= $sub_menu['name'] ?>
                                                    <input type="checkbox" class="checkall">全选
                                                    <ul>
                                                        <?php if (isset($auth_items[$sub_menu['id']])): ?>
                                                            <?php foreach ($auth_items[$sub_menu['id']] as $item): ?>
                                                                <li>
                                                                    <input type="checkbox" name="auth[]"
                                                                           value="<?= $item['name'] ?>" <?= isset($items[$item['name']]) ? 'checked' : '' ?>>
                                                                    <?= $item['description'] ?>
                                                                </li>
                                                            <?php endforeach ?>
                                                        <?php endif ?>
                                                    </ul>
                                                </li>
                                            <?php endforeach ?>
                                        <?php endif ?>
                                    </ul>
                                </li>
                            <?php endforeach ?>
                        <?php endif ?>
                    </ul>
                </li>
                <hr>
            <?php endforeach ?>
        </ul>

        <div class="form-group">
            <?= Html::submitButton('修改权限', ['class' => 'btn btn-primary btn-sm']) ?>
        </div>

        <?php ActiveForm::end(); ?>

    </div>

</div>

<?php
$js = <<<EOT
$('.checkall:checkbox').click(function() {
	$(this).parent().find(':checkbox').prop('checked', this.checked);
});
EOT;
$this->registerJs($js);
?>
