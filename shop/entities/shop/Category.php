<?php

namespace shop\entities\shop;
use paulzi\nestedsets\NestedSetsBehavior;
use paulzi\nestedsets\NestedSetsQueryTrait;
use shop\common\Behaviors\ArchiveBehavior;
use shop\common\Behaviors\Shop\MetaBehavior;
use Yii;

/**
 * This is the model class for table "shop_categories".
 *
 * @property int $id
 * @property int $lft
 * @property int $rgt
 * @property int $depth
 * @property string $name
 * @property string $slug
 * @property string $title
 * @property string $description
 *
 *
 */
class Category extends \yii\db\ActiveRecord
{
    public $meta;
    use NestedSetsQueryTrait;

    public static function create(string $name, string $slug, $title, $description, Meta $meta) : self
    {
        $category = new self();
        $category->name = $name;
        $category->slug = $slug;
        $category->title = $title;
        $category->description = $description;
        $category->meta = $meta;

        return $category;
    }

    public function edit(string $name, string $slug, $title, $description, Meta $meta) : void
    {
        $this->name = $name;
        $this->slug = $slug;
        $this->title = $title;
        $this->description = $description;
        $this->meta = $meta;
    }

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'shop_categories';
    }

    public function behaviors() {
        return [
            'meta' => [
              'class' => MetaBehavior::class
            ],
            'nested' => [
                'class' => NestedSetsBehavior::class,
            ],
            'archive' => [
                'class' => ArchiveBehavior::class,
            ],
        ];
    }

    public function transactions()
    {
        return [
            self::SCENARIO_DEFAULT => self::OP_ALL,
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'lft' => Yii::t('app', 'Lft'),
            'rgt' => Yii::t('app', 'Rgt'),
            'depth' => Yii::t('app', 'Depth'),
            'name' => Yii::t('app', 'Name'),
        ];
    }
}