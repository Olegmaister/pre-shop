<?php

namespace shop\Repositories\Shop;

use shop\Entities\Shop\Category;
use shop\Entities\Shop\Characteristic;

class CharacteristicRepository
{

    public function findById($id): Characteristic
    {
        return $this->getBy(['id' => $id]);
    }

    public function save(Characteristic $characteristic): void
    {
        if (!$characteristic->save()) {
            throw new \DomainException('Saving error.');
        }
    }

    private function getBy(array $condition): Characteristic
    {
        if (!$characteristic = Characteristic::find()->where($condition)->one()) {
            throw new \DomainException('Characteristic not found');
        }

        return $characteristic;
    }
}