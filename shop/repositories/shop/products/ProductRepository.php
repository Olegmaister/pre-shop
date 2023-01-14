<?php

namespace shop\Repositories\Shop\Products;

use shop\entities\shop\products\Product;

class ProductRepository
{
    public function findById(int $id) : Product
    {
        return $this->getBy(['id' => $id]);
    }

    public function save(Product $product) : void
    {
        if(!$product->save()){
            throw new \DomainException('Saving error.');
        }
    }

    public function remove(Product $product) : void
    {
        if(!$product->delete()){
            throw new \DomainException('Remove error.');
        }
    }

    private function getBy($condition) : Product
    {
        if(!$product = Product::find()->where($condition)->one()){
            throw new \DomainException('Product not found.');
        }

        return $product;
    }
}