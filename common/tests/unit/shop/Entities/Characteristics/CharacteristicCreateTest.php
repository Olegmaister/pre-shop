<?php

namespace common\tests\unit\shop\Entities\Characteristics;
use Codeception\Test\Unit;
use shop\Entities\Shop\Products\Tag;
use yii\helpers\Inflector;

class CharacteristicCreateTest extends Unit
{
    //create
    public function testSuccess()
    {
        $characteristic = Characteristic::create(
          $name = 'Name',
          $type = Characteristic::TYPE_INTEGER,//тип int string bool
          $required = true,//заполнять обязательно/нет
            $default = 0,//значение по умолчанию
            $variants = [4,10],//варианты хранить в бд в jsonb
            $sort = 12//сортировка
        );

        $this->assertEquals($name, $characteristic->name);
        $this->assertEquals($type, $characteristic->type);
        $this->assertEquals($required, $characteristic->required);
        $this->assertEquals($default, $characteristic->default);
        $this->assertEquals($variants, $characteristic->variants);
        $this->assertEquals($sort, $characteristic->sort);
        $this->assertTrue($characteristic->isSelect());
    }
}
