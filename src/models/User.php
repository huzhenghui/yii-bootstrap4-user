<?php

namespace huzhenghui\yii\bootstrap4\user\models;

use yii\base\BaseObject;
use yii\web\IdentityInterface;

class User extends BaseObject implements IdentityInterface
{
    public $id;
    public $accessToken;
    public $authKey;
    public $username;
    public $password;

    private static $users = [
        '100' => [
            'id' => '100',
            'accessToken' => '100-token',
            'authKey' => '100-Key',
            'username' => 'admin',
            'password' => 'admin'
        ]
    ];

    /**
     * {@inheritdoc}
     */
    public static function findIdentity($id)
    {
        return isset(self::$users[$id]) ? new static(self::$users[$id]) : null;
    }

    /**
     * {@inheritdoc}
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        foreach (self::$users as $user) {
            if ($user['accessToken'] === $token) {
                return new static($user);
            }
        }
        return null;
    }

    /**
     * {@inheritdoc}
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * {@inheritdoc}
     */
    public function getAuthKey()
    {
        return $this->authKey;
    }

    /**
     * {@inheritdoc}
     */
    public function validateAuthKey($authKey)
    {
        return $this->authKey === $authKey;
    }

    /**
     * @param string $username
     * @return static|null
     */
    public static function findByUsername($username)
    {
        foreach (self::$users as $user) {
            if (strcasecmp($user['username'], $username) === 0) {
                return new static($user);
            }
        }
        return null;
    }

    /**
     * @param string $password
     * @return bool
     */
    public function validatePassword($password)
    {
        return $this->password === $password;
    }
}
