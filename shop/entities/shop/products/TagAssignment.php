<?php

namespace shop\entities\shop\products;

use Yii;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "shop_tag_assignments".
 *
 * @property int $id
 * @property int $tag_id
 * @property int $product_id
 *
 * @property Product $product
 * @property Tag $tag
 */
class TagAssignment extends ActiveRecord
{
    public static function create(int $tagId) : self
    {
        $tagAssignment = new self();
        $tagAssignment->tag_id = $tagId;

        return $tagAssignment;
    }

    public function isFor(int $tagId)
    {
        return $this->id === $tagId;
    }

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'shop_tag_assignments';
    }

    /**
     * Gets query for [[Product]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getProduct()
    {
        return $this->hasOne(Product::class, ['id' => 'product_id']);
    }

    /**
     * Gets query for [[Tag]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTag()
    {
        return $this->hasOne(Tag::class, ['id' => 'tag_id']);
    }
}
