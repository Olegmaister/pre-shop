<?php

namespace shop\Forms\Shop\Products;

use shop\Entities\Shop\Products\Product;
use yii\base\Model;
use yii\helpers\ArrayHelper;

class CategoriesForm extends Model
{
    public $main;
    public $others = [];

    public function __construct(Product $product = null, $config = [])
    {
        if ($product) {
            $this->main = $product->category_id;
            $others = ArrayHelper::getColumn($product->categoryAssignments, 'category_id');
        }
        parent::__construct($config);
    }

    public function rules()
    {
        return [
            [['main'], 'required'],
            [['main'], 'integer'],
            ['others', 'each', 'rule' => ['integer']]
        ];

    }
}