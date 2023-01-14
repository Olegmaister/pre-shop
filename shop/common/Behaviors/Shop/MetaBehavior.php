<?php

namespace shop\common\Behaviors\Shop;

use shop\Entities\Shop\Meta;
use yii\base\Behavior;
use yii\base\Event;
use yii\db\ActiveRecord;

class MetaBehavior extends Behavior
{
    public $attribute = 'json_meta';

    public function events()
    {
        return [
            ActiveRecord::EVENT_BEFORE_INSERT => 'onBeforeInsert',
            ActiveRecord::EVENT_BEFORE_UPDATE => 'onBeforeInsert',
            ActiveRecord::EVENT_AFTER_FIND => 'onAfterFind',
        ];
    }

    public function onBeforeInsert(Event $event)
    {
        /** @var ActiveRecord $owner */
        $owner = $this->owner;

        $owner->setAttribute($this->attribute, [
            'title' => $owner->meta->title,
            'description' => $owner->meta->description,
            'keywords' => $owner->meta->keywords
        ]);

    }

    public function onAfterFind()
    {
        /** @var ActiveRecord $owner */
        $owner = $this->owner;
        $jsonData = $owner->json_meta;

        $owner->meta = new Meta(
            $jsonData['title'] ?? '',
            $jsonData['description'] ?? '',
            $jsonData['keywords'] ?? ''
        );
    }
}