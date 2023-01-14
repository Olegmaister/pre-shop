<?php

namespace shop\Forms\Shop\Products;

use shop\Entities\Shop\Characteristic;
use shop\Entities\Shop\Products\CharacteristicValue;
use yii\base\Model;

class CharacteristicValueForm extends Model
{
    public $characteristicValue;
    private $_characteristic;

    public function __construct(
        Characteristic $characteristic,
        CharacteristicValue $characteristicValue = null, $config = [])
    {
        $this->_characteristic = $characteristic;
        if ($characteristicValue) {
            $this->characteristicValue = $characteristicValue;
        }
        parent::__construct($config);
    }

    public function rules()
    {
        return array_filter([
            $this->_characteristic->required ? ['characteristicValue', 'required'] : false,
            $this->_characteristic->isString() ? ['characteristicValue','string','max' => 255] : false,
            $this->_characteristic->isInteger() ? ['characteristicValue','integer'] : false,
            $this->_characteristic->isFloat() ? ['characteristicValue','number'] : false,
            ['characteristicValue','safe']
        ]);
    }

    public function attributeLabels(): array
    {
        return [
            'characteristicValue' => $this->_characteristic->name,
        ];
    }

    public function getDefaultValue()
    {
        return $this->_characteristic->default;
    }

    public function variantsList(): array
    {

        return $this->_characteristic->variants ? array_combine($this->_characteristic->variants, $this->_characteristic->variants) : [];
    }

    public function getId(): int
    {
        return $this->_characteristic->id;
    }
}