<?php

namespace huzhenghui\yii\bootstrap4\user;

use Yii;
use yii\base\BootstrapInterface;
use yii\bootstrap4\Html;

use huzhenghui\yii\bootstrap4\starter\nav\StarterNavItemsInterface;

class Module extends \yii\base\Module implements BootstrapInterface,  StarterNavItemsInterface
{
    public $controllerNamespace = 'huzhenghui\yii\bootstrap4\user\controllers';

    /**
     * @SuppressWarnings(PHPMD.StaticAccess) Avoid using static access to class '\Yii' in method 'init'.
     */
    public function init()
    {
        parent::init();
        Yii::setAlias('@huzhenghui/yii/bootstrap4/user', __DIR__);
    }

    /**
     * @SuppressWarnings(PHPMD.UnusedFormalParameter) Avoid unused parameters such as '$app'.
     */
    public function bootstrap($app)
    {
    }

    /**
     * @SuppressWarnings(PHPMD.StaticAccess) Avoid using static access to class '\yii\bootstrap4\Html' in method 'getStarterNavItems'.
     */
    public function getStarterNavItems(): array
    {
        return Yii::$app->user->isGuest
            ?
            [
                ['label' => 'Login', 'url' => ['/' . $this->getUniqueId() . '/user/login']]
            ]
            :
            ['<li>'
                . Html::beginForm(['/' . $this->getUniqueId() . '/user/logout'], 'post')
                . Html::submitButton('Logout (' . Yii::$app->user->identity->username . ')', ['class' => 'btn btn-link'])
                . Html::endForm()
                . '</li>'];
    }
}
