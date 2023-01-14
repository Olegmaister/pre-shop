<?php

namespace shop\Forms\Shop;

use shop\Entities\Shop\Meta;
use yii\base\Model;

class MetaForm extends Model
{
    public $title;
    public $description;
    public $keywords;

    public function __construct(Meta $meta = null, $config = [])
    {
        if($meta){
            $this->title = $meta->title;
            $this->description = $meta->description;
            $this->keywords = $meta->keywords;
        }
        parent::__construct($config);
    }

    public function rules()
    {
        return [
            [['title','description','keywords'], 'required'],
            ['title', 'string', 'length' => [4, 24]],
            ['description', 'string', 'length' => [4, 24]],
            ['keywords', 'string', 'length' => [4, 24]],
        ];
    }
}