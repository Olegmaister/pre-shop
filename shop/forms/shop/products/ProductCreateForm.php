<?php

namespace shop\Forms\Shop\Products;

use shop\Entities\Shop\Brand;
use shop\Entities\Shop\Category;
use shop\Entities\Shop\Characteristic;
use shop\Entities\Shop\Products\Tag;
use shop\Forms\CompositeForm;
use shop\Forms\Shop\MetaForm;
use yii\helpers\ArrayHelper;

/**
 * @property PriceForm $price
 * @property MetaForm $meta
 * @property CategoriesForm $categories
 * @property PhotosForm $photos
 * @property TagsForm $tags
 * @property CharacteristicValueForm [] $characteristicValue
 */
class ProductCreateForm extends CompositeForm
{

    public $brandId;
    public $code;
    public $name;

    public function __construct($config = [])
    {
        $this->price = new PriceForm();
        $this->meta = new MetaForm();
        $this->categories = new CategoriesForm();
        $this->photos = new PhotosForm();
        $this->tags = new TagsForm();
        $this->characteristicValue = array_map(function(Characteristic $characteristic){
            return new CharacteristicValueForm($characteristic);
        },Characteristic::find()->orderBy('sort')->all());
        parent::__construct($config);
    }

    public function rules()
    {
        return [
            [['name', 'code', 'brandId'], 'required']
        ];
    }

    public function getBrands()
    {
        return ArrayHelper::map(Brand::find()->all(),'id','name');
    }

    public function getCategories()
    {
        return ArrayHelper::map(Category::find()->where(['<>','depth',0])->all(),'id','name');
    }

    public function getTags()
    {
        return ArrayHelper::map(Tag::find()->all(),'id','name');
    }

    protected function internalForms(): array
    {
        return ['price','meta','categories','photos','tags','characteristicValue'];
    }

}