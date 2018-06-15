<?php
namespace frontend\modules\user\controllers;

use Yii;
use frontend\modules\user\controllers\base\BaseController;

class IndexController extends BaseController
{
	public function actionIndex()
	{
		echo "Hello User";
	}
}
