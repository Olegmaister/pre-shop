<?php

namespace shop\entities\shop;

use shop\common\Behaviors\ArchiveBehavior;
use shop\common\Behaviors\Shop\MetaBehavior;
use Yii;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "brands".
 *
 * @property int $id
 * @property string $name
 * @property string $slug
 * @property string $json_meta
 */
class Brand extends ActiveRecord
{
    public $meta;

    public static function create($name, $slug, Meta $meta): self
    {
        $brand = new self();
        $brand->name = $name;
        $brand->slug = $slug;
        $brand->meta = $meta;

        return $brand;
    }

    public function edit($name, $slug, Meta $meta): void
    {
        $this->name = $name;
        $this->slug = $slug;
        $this->meta = $meta;
    }

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'shop_brands';
    }

    public function behaviors()
    {
        return [
          'meta' => [
              'class' => MetaBehavior::class
          ],
          'archive' => [
              'class' => ArchiveBehavior::class
          ]
        ];
    }

}

