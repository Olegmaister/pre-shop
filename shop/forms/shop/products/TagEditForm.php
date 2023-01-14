<?php

namespace shop\Forms\Shop\Products;

use shop\Entities\Shop\Products\Tag;
use yii\base\Model;

class TagEditForm extends Model
{
    public $name;
    public $slug;
    private $_tag;

    public function __construct(Tag $tag, $config = [])
    {
        $this->name = $tag->name;
        $this->slug = $tag->slug;
        $this->_tag = $tag;
        parent::__construct($config);
    }

    public function rules()
    {
        return [
            [['name'], 'required'],
            ['name', 'string', 'length' => [4, 24]],
            [['name'], 'unique', 'targetClass' => Tag::class, 'filter' => ['<>', 'id', $this->_tag->id]],
        ];
    }
}