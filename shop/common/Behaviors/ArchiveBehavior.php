<?php

namespace shop\common\Behaviors;

use shop\Helpers\TableArchiveHelper;
use shop\Helpers\UserHelper;
use yii\base\Behavior;
use yii\base\Event;
use yii\db\ActiveRecord;

class ArchiveBehavior extends Behavior
{
    const DEFAULT_SCHEMA = 'system_archive';

    public function events()
    {
        return [
            ActiveRecord::EVENT_BEFORE_DELETE => 'onDeleteBefore'
        ];
    }

    public function onDeleteBefore(Event $event)
    {
        $classPath = $this->getClassPath();
        /** @var ActiveRecord $class */
        $class = new $classPath;

        TableArchiveHelper::create($class);
        $this->insertTable($class, $classPath);

    }

    private function insertTable($class, $classPath)
    {
        /** @var ActiveRecord $sender */
        $sender = $this->owner;

        \Yii::$app->db->createCommand()->insert(self::DEFAULT_SCHEMA . '.' . $class::tableName(), [
            'model_id' => $sender->id,
            'class_path' => $classPath,
            'manager_id' => UserHelper::getId(),
            'json_data' => $sender->attributes
        ])->execute();
    }

    private function getClassPath()
    {
        return lcfirst(get_class($this->owner));
    }
}