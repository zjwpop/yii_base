<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = '权限管理';
$this->params['breadcrumbs'][] = $this->title;
?>
<div style="padding:15px"> 
<?php $form = ActiveForm::begin([
        'action' => ['list-do'],
        'method' => 'post',
		'options'=>['class'=>'form-inline'],
    ]); ?>
<input type='hidden' value="<?=$role ?>" name="role" />
<?php foreach($data as $ctrl=>$acts) : ?>
<div class="row"><div style="float:left;width:200px;"><?php echo $ctrl ?></div>

<div style="float:left;">
<?php foreach($acts as $act) :  ?>
	<input type='checkbox' name="prem[]" value="<?php echo $act['route'] ?>"  <?= isset($items[$act['route']])?'checked' : '' ?> /> 
	<?php echo Html::a($act['name'],'#',['title'=>$act['route']]) ?>
<?php endforeach ?>
</div>
</div>
<?php endforeach ?>
<div><?= Html::submitButton('设置', ['class' => 'btn btn-primary btn-sm']) ?></div>
<?php ActiveForm::end() ?>
</div>