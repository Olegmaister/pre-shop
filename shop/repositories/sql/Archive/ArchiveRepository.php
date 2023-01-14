<?php

namespace shop\Repositories\Sql\Archive;

use yii\db\ActiveRecord;

class ArchiveRepository
{
    const SCHEMA = 'system_archive';

    public function findByNameId($tableName, $modelId): array
    {
        $tableName = self::SCHEMA . '.' . $tableName;
        $sql = "select * from $tableName
        where model_id = $modelId";

        if (!$model = \Yii::$app->db->createCommand($sql)->queryOne()) {
            throw new \DomainException('record not found.');
        }

        return $model;
    }

    public function save($tableName, ActiveRecord $class) : void
    {
        if(!$class->save()){
            throw new \DomainException('Saving error.');
        }
    }

    public function remove($tableName, $modelId): void
    {
        $tableName = self::SCHEMA . '.' . $tableName;
        $sql = "delete from $tableName
        where model_id = $modelId";

        if (!\Yii::$app->db->createCommand($sql)->execute()) {
            throw new \DomainException('remove error.');
        }
    }
}