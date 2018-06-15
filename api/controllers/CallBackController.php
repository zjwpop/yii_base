<?php
namespace api\controllers;

use yii\web\ErrorAction;
use common\helpers\Helper;
//use yii\web\Controller;

/**
 * Site controller
 */
class CallBackController extends ApiController
{
	    /* 取消 Csrf 验证 */
	public function beforeAction($action) {

		$currentaction = $action->id;

		$novalidactions = ['recive'];

		if(in_array($currentaction,$novalidactions)) {

			$action->controller->enableCsrfValidation = false;
		}
		parent::beforeAction($action);

		return true;
	}



	public function actionRecive(){
		$streamData = isset($GLOBALS['HTTP_RAW_POST_DATA'])? $GLOBALS['HTTP_RAW_POST_DATA'] : '';
		if(empty($streamData)){
			$streamData = file_get_contents('php://input');
		}
		if($streamData==''){ return ['error'=>'3','remark'=>'send empty data']; }
		if(!Helper::is_json($streamData)){ return ['error'=>'4','remark'=>'data is not json'];}

		$data=json_decode($streamData,true);
		$getToken=$data['accessToken'];
		unset($data['accessToken']);
		ksort($data);
		$reToken=Helper::getToken($data);
		if($reToken!==$getToken){
			return ['error'=>'2','remark'=>'verification error'];
		}

		$redata=Helper::rewrite($data);
		// return ['ret'=>$redata];

		$table_name=$redata['tablename']; //表名
		$data=$redata['dat'];  //数据
		$primary_key=$redata['primary']; //主键
		$lock_key=$redata['lock']; //锁定键

		$ret= Helper::saveData($table_name,$data,$primary_key,$lock_key);

		return $ret;
	}

}

