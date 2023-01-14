<?php

require_once dirname(dirname(__DIR__)) . '/vendor/diembzz/yii2custom/src/common/core/BaseYii.php';

class Yii extends yii2custom\common\core\BaseYii
{
    /**
     * @var \api\core\Application|\admin\core\Application|\console\core\Application
     */
    public static $app;
}

spl_autoload_register(['Yii', 'autoload'], true, true);
Yii::$classMap = require_once dirname(dirname(__DIR__)) . '/vendor/yiisoft/yii2/classes.php';
Yii::$container = new yii\di\Container();