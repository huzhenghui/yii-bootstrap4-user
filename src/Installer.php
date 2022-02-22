<?php

namespace huzhenghui\yii\bootstrap4\user;

use Composer\Installer\LibraryInstaller;
use Composer\Script\Event;

use yii\composer\Installer as YiiComposerInstaller;

class Installer extends LibraryInstaller
{
    /**
     * @SuppressWarnings(PHPMD.UnusedFormalParameter) Avoid unused parameters such as '$event'.
     * @SuppressWarnings(PHPMD.StaticAccess) Avoid using static access to class '\yii\composer\Installer' in method 'postUpdate'.
     */
    public static function postUpdate(Event $event): void
    {
        YiiComposerInstaller::copyFiles(array(
            "./config/cookieValidationKey.dist.php" => "./config/cookieValidationKey.local.php",
            "./vendor/huzhenghui/yii2-app-basic-files/yii" => "./yii",
            "./vendor/huzhenghui/yii2-app-basic-files/web/index.php" => "./web/index.php",
            "./vendor/huzhenghui/yii2-app-basic-files/web/assets/.gitignore" => "./web/assets/.gitignore",
        ));
    }

    /**
     * @SuppressWarnings(PHPMD.UnusedFormalParameter) Avoid unused parameters such as '$event'.
     * @SuppressWarnings(PHPMD.StaticAccess) Avoid using static access to class '\yii\composer\Installer' in method 'postInstall'.
     */
    public static function postInstall(Event $event): void
    {
        YiiComposerInstaller::generateCookieValidationKey("./config/cookieValidationKey.local.php");
    }
}
