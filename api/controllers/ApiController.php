<?php

namespace api\controllers;

use yii\filters\ContentNegotiator;
use yii\rest\Controller;
use yii\web\Response;

/**
 * API基础控制器
 * @author
 */
class ApiController extends Controller
{
	public function behaviors()
	{
		return array_merge(parent::behaviors(), [
			'contentNegotiator' => [
				'class' => ContentNegotiator::className(),
				'formats' => [
					'application/json' => Response::FORMAT_JSON,
				]
			]
		]);
	}
}
