<?php

namespace huzhenghui\yii\bootstrap4\user\models;

use Yii;
use yii\base\Model;

/**
 * @SuppressWarnings(PHPMD.CamelCasePropertyName) The property $_user is not named in camelCase.
 */
class LoginForm extends Model
{
    public $username;
    public $password;
    public $rememberMe = true;

    private $_user = false;

    /**
     * @return array
     */
    public function rules()
    {
        return [
            [['username', 'password'], 'required'],
            ['rememberMe', 'boolean'],
            ['password', 'validatePassword']
        ];
    }

    /**
     * @param string $attribute
     */
    public function validatePassword($attribute)
    {
        if (!$this->hasErrors()) {
            $user = $this->getUser();
            if (!$user || !$user->validatePassword($this->password)) {
                $this->addError($attribute, 'Incorrect username or password.');
            }
        }
    }

    /**
     * @return bool
     */
    public function login()
    {
        if ($this->validate()) {
            return Yii::$app->user->login($this->getUser(), $this->rememberMe ? 3600 * 24 : 0);
        }
        return false;
    }

    /**
     * @return User|null
     * @SuppressWarnings(PHPMD.StaticAccess) Avoid using static access to class 'huzhenghui\yii\bootstrap4\user\models\User' in method 'getUser'.
     */
    public function getUser()
    {
        if ($this->_user === false) {
            $this->_user = User::findByUsername($this->username);
        }
        return $this->_user;
    }
}
