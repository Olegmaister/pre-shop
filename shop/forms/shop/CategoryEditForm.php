<?php

namespace shop\Forms\Shop;

use shop\Forms\CompositeForm;
use yii\helpers\ArrayHelper;
use shop\Entities\Shop\Category;

/**
 * @property MetaForm $meta
 */
class CategoryEditForm extends CompositeForm
{
    public $name;
    public $slug;
    public $title;
    public $description;
    public $parentId;
    private $_category;

    public function __construct(Category $category, $config = [])
    {
        $this->_category = $category;
        $this->name = $category->name;
        $this->slug = $category->slug;
        $this->title = $category->title;
        $this->description = $category->description;
        $this->meta = new MetaForm($category->meta);
        $this->parentId = $category->parent->id;
        parent::__construct($config);
    }

    public function rules()
    {
        return [
            [['name', 'parentId', 'title', 'description'], 'required'],
            ['name', 'string', 'length' => [4, 24]],
        ];
    }

    public function getCategories()
    {
        $result =  ArrayHelper::map(Category::find()->orderBy('lft')->all(), 'id', function (Category $category) {
            $str = "- ";
            return str_repeat($str, $category->depth) . $category->name;
        });

        unset($result[$this->_category->id]);
        return $result;
    }

    protected function internalForms(): array
    {
        return ['meta'];
    }
}