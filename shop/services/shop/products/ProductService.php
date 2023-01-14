<?php

namespace shop\services\shop\Products;

use shop\Entities\Shop\Meta;
use shop\Entities\Shop\Products\Product;
use shop\Forms\Shop\Products\ProductCreateForm;
use shop\Repositories\Shop\CategoryRepository;
use shop\Repositories\Shop\Products\ProductRepository;
use shop\Repositories\Shop\Products\TagRepository;

class ProductService
{
    private $products;
    private $tags;
    private $categories;

    public function __construct(
        ProductRepository $products,
        CategoryRepository $categories,
        TagRepository $tags
    )
    {
        $this->products = $products;
        $this->categories = $categories;
        $this->tags = $tags;
    }

    public function create(ProductCreateForm $form)
    {
        $product = Product::create(
            $form->name,
            $form->brandId,
            $form->code,
            $form->categories->main,
            new Meta(
                $form->meta->title,
                $form->meta->description,
                $form->meta->keywords
            )
        );

        //set prices
        $product->attachPrice($form->price->new, $form->price->old);

        //attach categories
        if(!empty($form->categories->others)){
            foreach ($form->categories->others as $categoryId) {
                $category = $this->categories->findById($categoryId);
                $product->assignmentCategory($category->id);
            }
        }

        //attach tags
        if(!empty($form->tags)){
            foreach ($form->tags->existing as $tagId) {
                $tag = $this->tags->findById($tagId);
                $product->assignmentTag($tag->id);

            }
        }

        foreach ($form->characteristicValue as $characteristicValue) {
            $product->setValue($characteristicValue->id,$characteristicValue->characteristicValue);
        }

        foreach ($form->photos->files as $file) {
            $product->attachPhoto($file);
        }

        $this->products->save($product);

        return $product;
    }

    public function remove(int $id)
    {
        $product = $this->products->findById($id);
        $this->products->remove($product);
    }

    public function movePhotoUp($product, $photoId) : void
    {
        /** @var Product $product*/
        $product->movePhotoUp($product->id,$photoId);
        $this->products->save($product);
    }

    public function movePhotoDown($product, $photoId) : void
    {
        /** @var Product $product*/
        $product->movePhotoDown($product->id,$photoId);
        $this->products->save($product);
    }
}