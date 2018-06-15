<?php
namespace backend\models;

use common\models\table\Admin as AdminTalbe;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use yii\helpers\ArrayHelper;

class Admin extends AdminTalbe{
	public function search($params) {
		$query = self::find();
		$dataProvider = new ActiveDataProvider([
			'query' => $query,
		]);

		return $dataProvider;
	}
}
