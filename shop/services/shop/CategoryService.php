<?php

namespace shop\services\shop;

use shop\Entities\Shop\Category;
use shop\Entities\Shop\Meta;
use shop\Forms\Shop\CategoryCreateForm;
use shop\Forms\Shop\CategoryEditForm;
use shop\Repositories\Shop\CategoryRepository;
use yii\helpers\Inflector;

class CategoryService
{
    private $categories;

    public function __construct(CategoryRepository $categories)
    {
        $this->categories = $categories;
    }

    public function create(CategoryCreateForm $form): Category
    {
        //create new category
        $category = Category::create(
            $form->name,
            Inflector::slug($form->name),
            $form->title,
            $form->description,
            new Meta(
                $form->meta->title,
                $form->meta->description,
                $form->meta->keywords
            )
        );

        //get parent category
        $parent = $this->categories->getBindCategory($form->parentId);
        //save
        $category->appendTo($parent)->save();

        return $category;
    }

    public function edit(int $id, CategoryEditForm $form): void
    {
        /** @var Category $category*/
        $category = $this->categories->findById($id);

        if($this->assertIsNotRoot($category)){
            throw new \DomainException('Root element cannot be edit');
        }

        if($category->parent->id != $form->parentId){
            $parent = $this->categories->getBindCategory($form->parentId);
            $category->appendTo($parent)->save();
        }

        $category->edit($form->name,
            Inflector::slug($form->name),
            $form->title,
            $form->description,
            new Meta(
                $form->meta->title,
                $form->meta->description,
                $form->meta->keywords
            ));

        $this->categories->save($category);

    }

    public function remove(int $id)
    {
        $category = $this->categories->findById($id);
        if($this->assertIsNotRoot($category)){
            throw new \DomainException('Root element cannot be removed');
        }

        $category->deleteWithChildren();
    }

    public function moveUp(int $id) : void
    {
        /** @var Category $category*/
        $category = $this->categories->findById($id);
        $prev = $category->prev;
        if($prev){
            $category->insertBefore($prev)->save();
        }
    }

    public function moveDown(int $id) : void
    {
        /** @var Category $category*/
        $category = $this->categories->findById($id);
        $next = $category->next;
        if($next){
            $category->insertAfter($next)->save();
        }
    }

    private function assertIsNotRoot(Category $category)
    {
        return $category->isRoot();
    }
}