<?php

namespace common\tests\unit\shop\Entities\Brands;

use Codeception\Test\Unit;
use shop\Entities\Shop\Brand;
use shop\Entities\Shop\Meta;
use yii\helpers\Inflector;

class BrandCreateTest extends Unit
{
    //create
    public function testSuccess()
    {
        $brand = Brand::create(
            $name = 'brand name',
            $slug = Inflector::slug($name),
            $meta = new Meta('title','description','keywords')
        );

        $this->assertEquals($name, $brand->name);
        $this->assertEquals($slug, $brand->slug);
        $this->assertEquals($meta, $brand->meta);
    }
}