<?php

namespace shop\Forms\Shop;

use shop\Entities\Shop\Characteristic;
use yii\base\Model;

class CharacteristicEditForm extends Model
{
    public $name;
    public $type;
    public $required;
    public $default;
    public $textVariants;
    public $sort;

    private $_characteristic;

    public function __construct(Characteristic $characteristic, $config = [])
    {
        $this->name = $characteristic->name;
        $this->type = $characteristic->type;
        $this->required = $characteristic->required;
        $this->default = $characteristic->default;
        $this->sort = $characteristic->sort;
        $this->textVariants = implode("\n", $characteristic->variants);
        $this->_characteristic = $characteristic;
        parent::__construct($config);
    }

    public function rules()
    {
        return [
            [['name', 'type', 'required'], 'required'],
            [['required'], 'boolean'],
            [['textVariants', 'default'], 'string'],
            ['name', 'string', 'length' => [4, 24]],
            [['name'], 'unique', 'targetClass' => Characteristic::class, 'filter' => ['<>', 'id', $this->_characteristic->id]],
        ];
    }

    public function getVariants()
    {
        return preg_split('#[\r\n]+#i', $this->textVariants);
    }

}
