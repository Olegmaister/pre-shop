<?php

namespace console\core;

use Yii;

class Application extends \yii2custom\console\core\Application
{
    const APP_API = 'app-api';
    const APP_ADMIN = 'app-admin';
    const APP_CONSOLE = 'app-console';

    public function isApi(): bool
    {
        return Yii::$app->id == \common\core\Application::APP_API;
    }

    public function isAdmin(): bool
    {
        return Yii::$app->id == Application::APP_ADMIN;
    }

    public function isConsole(): bool
    {
        return Yii::$app->id == Application::APP_CONSOLE;
    }
}