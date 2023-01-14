<?php

namespace shop\Forms\Shop\Products;

use shop\Entities\Shop\Products\Tag;
use yii\base\Model;

class TagCreateForm extends Model
{
    public $name;
    public $slug;

    public function rules()
    {
        return [
            [['name'], 'required'],
            ['name', 'string', 'length' => [4, 24]],
            [['name'], 'unique', 'targetClass' => Tag::class],
        ];
    }
}