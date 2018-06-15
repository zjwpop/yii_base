<?php

namespace backend\models\form;

use common\models\table\Admin;
use Yii;
use yii\base\Model;

class LoginForm extends Model {
	public $username;
	public $password;
	public $verifyCode;

	private $_user = false;

	/**
	 * @inheritdoc
	 */
	public function attributeLabels() {
		return [
			'username' => '用户名',
			'password' => '密码',
			'verifyCode' => '验证码',
		];
	}

	/**
	 * @inheritdoc
	 */
	public function rules() {
		return [
			[['username', 'password', 'verifyCode'], 'required'],
			['username', 'string', 'max' => 26],
			['password', 'validatePassword'],
			[['verifyCode'], 'captcha', 'captchaAction' => '/site/captcha'],
		];
	}

	/**
	 * Validates the password.
	 * This method serves as the inline validation for password.
	 *
	 * @param string $attribute the attribute currently being validated
	 * @param array $params the additional name-value pairs given in the rule
	 */
	public function validatePassword($attribute, $params) {
		if (!$this->hasErrors()) {
			$user = $this->getUser();
			if (!$user || !$user->validatePassword($this->password)) {
				$this->addError('username', '用户名或密码错误');
			}
		}
	}

	/**
	 * Logs in a user using the provided username and password.
	 * @return boolean whether the user is logged in successfully
	 */
	public function login() {
		if ($this->validate()) {
			$user = $this->getUser();
			return Yii::$app->user->login($user, 86400);
		}
		return false;
	}

	public function getUser() {
		if ($this->_user === false) {
			$this->_user = Admin::findOne([
				'username' => $this->username,
				'status' => Admin::STATUS_ENABLE,
			]);
		}
		return $this->_user;
	}
}
