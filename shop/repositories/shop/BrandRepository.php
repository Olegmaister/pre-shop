<?php

namespace shop\Repositories\Shop;

use shop\Entities\Shop\Brand;

class BrandRepository
{

    public function findById(int $id): Brand
    {
        return $this->getBy(['id' => $id]);
    }

    public function save(Brand $brand): void
    {
        if (!$brand->save()) {
            throw new \DomainException('Saving error.');
        }
    }

    public function remove(Brand $brand) : void
    {
        if(!$brand->delete()){
            throw new \DomainException('Delete error.');
        }
    }

    private function getBy(array $condition): Brand
    {
        if (!$brand = Brand::find()->where($condition)->one()) {
            throw new \DomainException('Brand not found.');
        }

        return $brand;
    }
}
