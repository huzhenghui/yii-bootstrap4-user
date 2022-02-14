<?php

namespace huzhenghui\yii\bootstrap4\user;

use Yii;
use yii\base\BootstrapInterface;
use yii\bootstrap4\Html;

use huzhenghui\yii\bootstrap4\starter\nav\StarterNavItemsInterface;

class Module extends \yii\base\Module implements BootstrapInterface,  StarterNavItemsInterface
{
    public $controllerNamespace = 'huzhenghui\yii\bootstrap4\user\controllers';

    public function init()
    {
        parent::init();
        Yii::setAlias('@huzhenghui/yii/bootstrap4/user', __DIR__);
    }

    public function bootstrap($app)
    {
    }

    public function getStarterNavItems(): array
    {
        if (Yii::$app->user->isGuest) {
            return [
                ['label' => 'Login', 'url' => ['/' . $this->getUniqueId() . '/user/login']]
            ];
        } else {
            return ['<li>'
                . Html::beginForm(['/' . $this->getUniqueId() . '/user/logout'], 'post')
                . Html::submitButton('Logout (' . Yii::$app->user->identity->username . ')', ['class' => 'btn btn-link'])
                . Html::endForm()
                . '</li>'];
        }
    }
}
