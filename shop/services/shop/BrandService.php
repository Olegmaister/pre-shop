<?php

namespace shop\services\shop;

use shop\Entities\Shop\Meta;
use shop\Entities\Shop\Brand;
use shop\Forms\Shop\BrandCreateForm;
use shop\Forms\Shop\BrandEditForm;
use shop\Repositories\Shop\BrandRepository;
use yii\helpers\Inflector;

class BrandService
{
    private $brands;

    public function __construct(BrandRepository $brands)
    {
        $this->brands = $brands;
    }

    public function create(BrandCreateForm $form): Brand
    {
        $brand = Brand::create(
            $form->name,
            Inflector::slug($form->name),
            new Meta(
                $form->meta->title,
                $form->meta->description,
                $form->meta->keywords
            )
        );

        $this->brands->save($brand);

        return $brand;
    }

    public function edit(int $id, BrandEditForm $form): void
    {
        $brand = $this->brands->findById($id);
        $brand->edit(
            $form->name,
            Inflector::slug($form->name),
            new Meta(
                $form->meta->title,
                $form->meta->description,
                $form->meta->keywords
            )
        );

        $this->brands->save($brand);
    }

    public function remove($id): void
    {
        $brand = $this->brands->findById($id);
        $this->brands->remove($brand);
    }

}