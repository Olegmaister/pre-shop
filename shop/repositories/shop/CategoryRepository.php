<?php

namespace shop\Repositories\Shop;

use shop\Entities\Shop\Category;

class CategoryRepository
{
    public function getBindCategory(int $id) : Category
    {
        return $this->getBy(['id' => $id]);
    }

    public function findById($id) : Category
    {
        return $this->getBy(['id' => $id]);
    }

    public function save(Category $category) : void
    {
        if(!$category->save()){
            throw new \DomainException('Saving error.');
        }
    }

    private function getBy(array $condition) : Category
    {
        if(!$category = Category::find()->where($condition)->one()){
            throw new \DomainException('Category not found');
        }

        return $category;
    }
}