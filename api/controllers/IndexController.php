<?php
namespace api\controllers;

use yii\web\ErrorAction;

/**
 * Site controller
 */
class IndexController extends ApiController
{
	public function actionIndex(){
		return ['msg'=>'ok'];
	}
}
