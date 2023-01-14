<?php

namespace shop\Forms\Shop\Products;

use shop\Entities\Shop\Products\Product;
use yii\base\Model;

class PriceForm extends Model
{
    public $new;
    public $old;

    public function __construct(Product $product = null, $config = [])
    {
        if ($product) {
            $this->new = $product->price_new;
            $this->old = $product->price_old;
        }
        parent::__construct($config);
    }

    public function rules()
    {
        return [
            [['new'], 'required'],
            [['old', 'new'], 'integer', 'min' => 0]
        ];
    }
}