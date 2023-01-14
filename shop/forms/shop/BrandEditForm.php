<?php

namespace shop\Forms\Shop;

use shop\Entities\Shop\Brand;
use shop\Forms\CompositeForm;

/**
 * @property MetaForm $meta
 */
class BrandEditForm extends CompositeForm
{
    public $name;
    public $slug;
    private $_brand;

    public function __construct(Brand $brand, $config = [])
    {
        $this->_brand = $brand;
        $this->name = $brand->name;
        $this->slug = $brand->slug;
        $this->meta = new MetaForm($brand->meta);
        parent::__construct($config);
    }


    public function rules()
    {
        return [
            [['name'], 'required'],
            ['name', 'string', 'length' => [4, 24]],
            [['name'], 'unique', 'targetClass' => Brand::class, 'filter' => ['<>', 'id', $this->_brand->id]],
        ];
    }

    protected function internalForms(): array
    {
        return ['meta'];
    }
}