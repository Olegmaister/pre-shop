<?php

namespace common\tests\unit\shop\Entities\Tags;
use Codeception\Test\Unit;
use shop\Entities\Shop\Products\Tag;
use yii\helpers\Inflector;

class TagCreateTest extends Unit
{
    //create
    public function testSuccess()
    {
        $tag = Tag::create(
            $name = 'Name',
            $slug = Inflector::slug($name)
        );

        $this->assertEquals($name, $tag->name);
        $this->assertEquals($slug, $tag->slug);
    }
}