<?php

namespace shop\Forms\Shop;

use shop\Forms\CompositeForm;
use yii\helpers\ArrayHelper;
use shop\Entities\Shop\Category;
/**
 * @property MetaForm $meta
 */
class CategoryCreateForm extends CompositeForm
{
    public $name;
    public $slug;
    public $title;
    public $description;
    public $parentId;

    public function __construct($config = [])
    {
        $this->meta = new MetaForm();
        parent::__construct($config);
    }

    public function rules()
    {
        return [
            [['name','parentId','title','description'], 'required'],
            ['name', 'string', 'length' => [4, 24]],
        ];
    }

    public function getCategories()
    {
        return ArrayHelper::map(Category::find()->orderBy('lft')->all(), 'id', function (Category $category)
        {
            $str = "- ";
            return str_repeat($str,$category->depth).$category->name;

        });
    }

    protected function internalForms(): array
    {
        return ['meta'];
    }
}