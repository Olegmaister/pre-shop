<?php

namespace shop\Helpers;

class UserHelper
{
    public static function getId()
    {
        return \Yii::$app->user->id;
    }
}