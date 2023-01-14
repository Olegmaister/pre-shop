<?php

namespace shop\Entities\Shop\Products;

use Yii;
use yii\db\ActiveRecord;
use yii\web\UploadedFile;

/**
 * This is the model class for table "shop_photos".
 *
 * @property int $id
 * @property int $product_id
 * @property int $sort
 * @property string $file
 */
class Photo extends ActiveRecord
{

    public static function create(UploadedFile $file)
    {
        $photo = new self();
        $photo->file = $file;

        return $photo;
    }

    public function isIdEqualTo($photoId) : bool
    {
        return $this->id == $photoId;
    }

    public function setSort(int $i) : void
    {
        $this->sort = $i;
    }

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'shop_photos';
    }

    public function behaviors()
    {
        return [
            [
                'class' => '\yiidreamteam\upload\FileUploadBehavior',
                'attribute' => 'file',
                'filePath' => '@webroot/uploads/[[attribute_product_id]]/[[pk]].[[extension]]',
                'fileUrl' => '/uploads/[[attribute_product_id]]/[[pk]].[[extension]]',
            ],
        ];
    }

}
