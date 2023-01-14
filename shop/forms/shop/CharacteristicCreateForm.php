<?php

namespace shop\Forms\Shop;

use shop\Entities\Shop\Characteristic;
use yii\base\Model;

class CharacteristicCreateForm extends Model
{
    public $name;
    public $type;
    public $required;
    public $default;
    public $textVariants;
    public $sort;

    public function __construct($config = [])
    {
        $this->sort = Characteristic::find()->min('sort') + 1;
        parent::__construct($config);
    }

    public function rules()
    {
        return [
            [['name', 'type', 'required'], 'required'],
            [['required'], 'boolean'],
            [['textVariants','default'], 'string'],
            ['name', 'string', 'length' => [4, 24]],
            [['name'], 'unique', 'targetClass' => Characteristic::class],
        ];
    }

    public function getVariants()
    {
        return preg_split('#[\r\n]+#i',$this->textVariants);
    }

}