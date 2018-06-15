<?php
namespace backend\models;

use common\models\base\AdminMenuBase;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use yii\helpers\ArrayHelper;

class AdminMenu extends AdminMenuBase{
	const STATUS_ENABLE = 1;
    const STATUS_DISABLE = 0;

    static $menutree = null;

	public function scenarios() {
		return Model::scenarios();
	}

	public function search($params) {
		$query = self::find();
		$dataProvider = new ActiveDataProvider([
			'query' => $query,
            'sort'=>['defaultOrder'=>['order_index'=>SORT_DESC,'id'=>SORT_DESC]],
		]);

		$this->load($params);

		if (!$this->validate()) {
			return $dataProvider;
		}

		$query->andFilterWhere([
				'pid' => $this->pid,
				'status' => $this->status,
			]);

		$query->andFilterWhere([
					'OR',
					['like', 'name', $this->name],
					['like', 'description', $this->name]
				])
			  ->andFilterWhere(['like', 'uri', $this->uri]);

		return $dataProvider;
	}

	public static function getMenuMap($menu_id = null)
    {
        if (empty(self::$menutree)) {
            self::$menutree = self::tree([]);
        }
        $tree = self::$menutree;
        $menu = [0 => '-'];
        foreach ($tree as $top_menu) {
            $top_menu_id = $top_menu['id'];
            $menu[$top_menu_id] = $top_menu['name'];
            if (!isset($top_menu['children'])) {
                continue;
            }
            foreach ($top_menu['children'] as $side_menu) {
                $side_menu_id = $side_menu['id'];
                $menu[$side_menu_id] = $side_menu['name'];
                if (!isset($side_menu['children'])) {
                    continue;
                }
                foreach ($side_menu['children'] as $sub_menu) {
                    $sub_menu_id = $sub_menu['id'];
                    $menu[$sub_menu_id] = $sub_menu['name'];
                }
            }
        }

        if (!is_null($menu_id)) {
            if (isset($menu[$menu_id])) {
                return $menu[$menu_id];
            } else {
                return null;
            }
        }

        return $menu;
    }

    public static function statusMap($value = -1)
    {
        $map = [
            self::STATUS_ENABLE => '已启用',
            self::STATUS_DISABLE => '已禁用',
        ];
        if ($value == -1) {
            return $map;
        }
        return ArrayHelper::getValue($map, $value, $value);
    }

    public static function tree($condition = ['status' => 1])
    {
        $tree = [];
        $list = self::find()->where($condition)->orderBy(['pid' => SORT_DESC, 'order_index' => SORT_DESC])->all();
        $list = ArrayHelper::toArray($list);

        $tree = [];
        foreach ($list as $menu) {
            $tree[$menu['id']] = $menu;
        }

        foreach ($list as $menu) {
            $id = $menu['id'];
            $pid = $menu['pid'];
            $menu = $tree[$id];
            if (!$pid) {
                continue;
            }
            if (!isset($tree[$pid])) {
                continue;
            }
            if (!isset($tree[$pid]['children'])) {
                $tree[$pid]['children'] = [];
            }
            $tree[$pid]['children'][] = $menu;
            unset($tree[$id]);
        }

        return $tree;
    }

}
