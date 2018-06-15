<?php

namespace common\models\base;

use Yii;

/**
 * This is the model class for table "admin".
 *
 * @property int $id 用户ID
 * @property string $username 用户名
 * @property string $realname 真实名
 * @property string $password 用户密码
 * @property int $mobile 手机号码
 * @property string $email 用户邮箱
 * @property int $status 状态：0 - 未启用；1 - 已启用
 * @property string $create_time 创建时间
 * @property string $update_time 更新时间
 */
class AdminBase extends \common\extensions\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'admin';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['username', 'mobile'], 'required'],
            [['mobile', 'status'], 'integer'],
            [['create_time', 'update_time'], 'safe'],
            [['username', 'realname'], 'string', 'max' => 20],
            [['password'], 'string', 'max' => 255],
            [['email'], 'string', 'max' => 30],
            [['username'], 'unique'],
            [['mobile'], 'unique'],
            [['email'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => '用户ID',
            'username' => '用户名',
            'realname' => '真实名',
            'password' => '用户密码',
            'mobile' => '手机号码',
            'email' => '用户邮箱',
            'status' => '状态：0 - 未启用；1 - 已启用',
            'create_time' => '创建时间',
            'update_time' => '更新时间',
        ];
    }
}
