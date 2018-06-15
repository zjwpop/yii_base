<?php
namespace backend\controllers;

use backend\controllers\base\AuthController;

class IndexController extends AuthController
{
	public function actionIndex(){
		return $this->render('index');
	}
}
