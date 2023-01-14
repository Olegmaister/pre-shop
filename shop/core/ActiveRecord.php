<?php

namespace shop\Core;

class ActiveRecord extends \yii\db\ActiveRecord
{
    const DEFAULT_KEY = 'id';

    public function hasManyId($class, array $link): \yii\db\ActiveQuery
    {
        if(!isset($link[1])){
            $link = [$link[0] => self::DEFAULT_KEY];
        }

        return parent::hasMany($class, $link);
    }
}
