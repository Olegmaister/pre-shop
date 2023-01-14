<?php

namespace shop\entities\shop\products;

use shop\common\Behaviors\ArchiveBehavior;
use Yii;

/**
 * This is the model class for table "shop_tags".
 *
 * @property int $id
 * @property string $name
 * @property string $slug
 */
class Tag extends \yii\db\ActiveRecord
{
    public static function create($name, $slug): self
    {
        $tag = new self();
        $tag->name = $name;
        $tag->slug = $slug;

        return $tag;
    }

    public function edit($name, $slug): void
    {
        $this->name = $name;
        $this->slug = $slug;
    }

    public function behaviors()
    {
        return [
            'archive' => [
                'class' => ArchiveBehavior::class,
            ],
        ];
    }


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'shop_tags';
    }

}
