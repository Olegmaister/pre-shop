<?php

namespace shop\Forms\Shop\Products;

use shop\Entities\Shop\Products\Product;
use yii\base\Model;
use yii\helpers\ArrayHelper;

class TagsForm extends Model
{
    public $existing = [];

    public function __construct(Product $product = null, $config = [])
    {
        if ($product) {
            $this->existing = ArrayHelper::getColumn($product->tagAssignments, 'tag_id');
        }
        parent::__construct($config);
    }

    public function rules()
    {
        return [
            [['existing'], 'each', 'rule' => ['integer']]
        ];
    }
}



































