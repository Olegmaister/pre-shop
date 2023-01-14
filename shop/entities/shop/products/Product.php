<?php

namespace shop\entities\shop\products;

use Yii;
use lhs\Yii2SaveRelationsBehavior\SaveRelationsBehavior;
use shop\common\Behaviors\Shop\MetaBehavior;
use shop\Entities\Shop\Brand;
use shop\Entities\Shop\Category;
use shop\Entities\Shop\Meta;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveQuery;
use yii\db\ActiveRecord;
use yii\web\UploadedFile;

/**
 * This is the model class for table "shop_products".
 *
 * @property int $id
 * @property int $category_id
 * @property int $brand_id
 * @property int $created_at
 * @property string $code
 * @property string $name
 * @property int|null $price_old
 * @property int|null $price_new
 * @property float|null $rating
 * @property string|null $json_meta
 * @property int|null $main_photo_id
 * @property int $status
 * @property int $quantity
 *
 * @property Brand $brand
 * @property Category $category
 * @property TagAssignment[] $tagAssignments
 * @property CategoryAssignment[] $categoryAssignments
 * @property CharacteristicValue[] $characteristicValues
 * @property Photo[] $photos
 * @property Photo $mainPhoto
 */
class Product extends ActiveRecord
{
    const STATUS_DRAFT = 0;
    const STATUS_ACTIVE = 1;

    public $meta;

    public static function create($name, $brandId, $code, $categoryId, Meta $meta): self
    {
        $product = new self();
        $product->name = $name;
        $product->brand_id = $brandId;
        $product->code = $code;
        $product->category_id = $categoryId;
        $product->meta = $meta;
        $product->quantity = 99;

        return $product;
    }

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'shop_products';
    }

    public function behaviors()
    {
        return [
            TimestampBehavior::class,
            'meta' => [
                'class' => MetaBehavior::class
            ],
            'saveRelations' => [
                'class' => SaveRelationsBehavior::class,
                'relations' => [
                    'tagAssignments',
                    'categoryAssignments',
                    'characteristicValues',
                    'photos'
                ],
            ],
        ];
    }

    public function attachPrice($new, $old)
    {
        $this->price_new = $new;
        $this->price_old = $old;
    }

    /*=============tags=========================*/
    public function assignmentTag($tagId): void
    {
        $assignments = $this->tagAssignments;
        /** @var TagAssignment $assignment */
        foreach ($assignments as $assignment) {
            if ($assignment->isFor($tagId)) {
                return;
            }
        }

        $assignments[] = TagAssignment::create($tagId);
        $this->tagAssignments = $assignments;

    }

    /*============other categories=============*/
    public function assignmentCategory($categoryId)
    {
        $assignments = $this->categoryAssignments;
        /** @var CategoryAssignment $assignment */
        foreach ($assignments as $assignment) {
            if ($assignment->isFor($categoryId)) {
                return;
            }
        }

        $assignments[] = CategoryAssignment::create($categoryId);
        $this->categoryAssignments = $assignments;
    }

    /*=========================================*/
    public function setValue($characteristicId, $characteristicValue)
    {
        $assignments = $this->characteristicValues;
        /** @var CharacteristicValue $assignment*/
        foreach ($assignments as $assignment) {
            if($assignment->isFor($characteristicId)){
                return;
            }
        }

        $assignments[] = CharacteristicValue::create($characteristicId, $characteristicValue);
        $this->characteristicValues = $assignments;
    }

    /*=============photos===============*/
    public function attachPhoto(UploadedFile $file) : void
    {
        $assignments = $this->photos;
        $assignments[] = Photo::create($file);
        $this->photos = $assignments;
        $this->updatePhoto($assignments);
    }

    public function movePhotoUp($productId,$photoId)
    {
        $assignments = $this->photos;
        /** @var Photo $assignment*/

        foreach ($assignments as $i=>$assignment) {
            if($assignment->isIdEqualTo($photoId)){
                if($prev = $assignments[$i - 1] ?? null){
                    $assignments[$i - 1] = $assignment;
                    $assignments[$i] = $prev;
                }
            }
        }
        $this->updatePhoto($assignments);
    }

    public function movePhotoDown($productId,$photoId)
    {
        $assignments = $this->photos;
        /** @var Photo $assignment*/

        foreach ($assignments as $i=>$assignment) {
            if($assignment->isIdEqualTo($photoId)){
                if($next = $assignments[$i + 1] ?? null){
                    $assignments[$i + 1] = $assignment;
                    $assignments[$i] = $next;
                }
            }
        }

        $this->updatePhoto($assignments);
    }

    public function updatePhoto(array $assignments)
    {
        /** @var Photo $assignment*/
        foreach ($assignments as $i=>$assignment){
            $assignment->setSort(++$i);
        }

        $this->photos = $assignments;
        $this->populateRelation('mainPhoto', reset($assignments));
    }

    /*=======relations=======*/
    public function getBrand() : ActiveQuery
    {
        return $this->hasOne(Brand::class, ['id' => 'brand_id']);
    }


    public function getCategory() : ActiveQuery
    {
        return $this->hasOne(Category::class, ['id' => 'category_id']);
    }

    public function getCategoryAssignments(): ActiveQuery
    {
        return $this->hasMany(CategoryAssignment::class, ['product_id' => 'id']);
    }

    public function getTagAssignments(): ActiveQuery
    {
        return $this->hasMany(TagAssignment::class, ['product_id' => 'id']);
    }

    public function getCharacteristicValues(): ActiveQuery
    {
        return $this->hasMany(CharacteristicValue::class, ['product_id' => 'id']);
    }

    public function getPhotos(): ActiveQuery
    {
        return $this->hasMany(Photo::class, ['product_id' => 'id'])->orderBy(['sort' => SORT_ASC]);
    }

    public function getMainPhoto() : ActiveQuery
    {
        return $this->hasOne(Photo::class,['id' => 'main_photo_id']);
    }

    public function afterSave($insert, $changedAttributes): void
    {
        $related = $this->getRelatedRecords();
        parent::afterSave($insert, $changedAttributes);
        if (array_key_exists('mainPhoto', $related)) {
            $this->updateAttributes(['main_photo_id' => $related['mainPhoto'] ? $related['mainPhoto']->id : null]);
        }
    }
}
