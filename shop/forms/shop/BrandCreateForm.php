<?php

namespace shop\Forms\Shop;

use shop\Entities\Shop\Brand;
use shop\Forms\CompositeForm;
use yii\base\Model;

/**
 * @property MetaForm $meta
 */
class BrandCreateForm extends CompositeForm
{
    public $name;
    public $slug;

    public function __construct($config = [])
    {
        $this->meta = new MetaForm();
        parent::__construct($config);
    }


    public function rules()
    {
        return [
            [['name'], 'required'],
            ['name', 'string', 'length' => [4, 24]],
            [['name'], 'unique', 'targetClass' => Brand::class],
        ];
    }

    protected function internalForms(): array
    {
        return ['meta'];
    }
}