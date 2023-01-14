<?php

namespace shop\entities\shop\products;

use shop\Core\ActiveRecord;
use Yii;

/**
 * This is the model class for table "shop_category_assignments".
 *
 * @property int $id
 * @property int $category_id
 * @property int $product_id
 */
class CategoryAssignment extends ActiveRecord
{
    public static function create($categoryId) : self
    {
        $categoryAssignment = new self();
        $categoryAssignment->category_id = $categoryId;

        return $categoryAssignment;
    }

    public function isFor(int $categoryId) : bool
    {
        return $this->category_id === $categoryId;
    }

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'shop_category_assignments';
    }

}
