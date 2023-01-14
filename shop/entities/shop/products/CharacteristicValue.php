<?php

namespace shop\entities\shop\products;

use shop\Entities\Shop\Characteristic;
use Yii;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "shop_characteristic_values".
 *
 * @property int $characteristic_id
 * @property int $product_id
 * @property string|null $characteristic_value
 *
 * @property Characteristic $characteristic
 * @property Product $product
 */
class CharacteristicValue extends ActiveRecord
{

    public static function create($characteristicId, $characteristicVal) : self
    {
        $characteristicValue = new self();
        $characteristicValue->characteristic_id = $characteristicId;
        $characteristicValue->characteristic_value = $characteristicVal;

        return $characteristicValue;
    }

    public function isFor($characteristicId)
    {
        return $this->characteristic_id === $characteristicId;
    }

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'shop_characteristic_values';
    }



    /**
     * Gets query for [[Characteristic]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCharacteristic()
    {
        return $this->hasOne(Characteristic::class, ['id' => 'characteristic_id']);
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
}
