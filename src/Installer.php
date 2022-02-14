<?php

namespace huzhenghui\yii\bootstrap4\user;

use Composer\Installer\LibraryInstaller;
use Composer\Script\Event;

use yii\composer\Installer as YiiComposerInstaller;


class Installer extends LibraryInstaller
{
    public static function postUpdate(Event $event): void
    {
        YiiComposerInstaller::copyFiles(array(
            "./config/cookieValidationKey.dist.php" => "./config/cookieValidationKey.local.php",
            "./vendor/huzhenghui/yii2-app-basic-files/yii" => "./yii",
            "./vendor/huzhenghui/yii2-app-basic-files/web/index.php" => "./web/index.php",
            "./vendor/huzhenghui/yii2-app-basic-files/web/assets/.gitignore" => "./web/assets/.gitignore",
        ));
    }

    public static function postInstall(Event $event): void
    {
        YiiComposerInstaller::generateCookieValidationKey("./config/cookieValidationKey.local.php");
    }
}
