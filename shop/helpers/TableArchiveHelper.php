<?php

namespace shop\Helpers;

class TableArchiveHelper
{
    const DEFAULT_SCHEMA = 'system_archive';

    public static function create($class)
    {
        $tableName = $class::tableName();

        $sql = "create table if not exists " . self::DEFAULT_SCHEMA . ".$tableName(
                id serial PRIMARY KEY,
                class_path VARCHAR ( 255 ) NOT NULL,
                model_id INTEGER  NOT NULL,
                manager_id INTEGER  NOT NULL,
               json_data jsonb
                );";

        \Yii::$app->db->createCommand($sql)->execute();
    }
}