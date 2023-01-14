<?php

namespace shop\services\shop;

use shop\Entities\Shop\Characteristic;
use shop\Forms\Shop\CharacteristicCreateForm;
use shop\Forms\Shop\CharacteristicEditForm;
use shop\Repositories\Shop\CharacteristicRepository;

class CharacteristicService
{
    private $characteristics;
    public function __construct(CharacteristicRepository $characteristics)
    {
        $this->characteristics = $characteristics;
    }

    public function create(CharacteristicCreateForm $form) : Characteristic
    {

        $characteristic = Characteristic::create(
            $form->name,
            $form->type,
            $form->required,
            $form->default,
            $form->variants,
            $form->sort
        );

        $this->characteristics->save($characteristic);

        return $characteristic;
    }

    public function edit(int $id, CharacteristicEditForm $form) : void
    {
        $characteristic = $this->characteristics->findById($id);

        $characteristic->edit(
            $form->name,
            $form->type,
            $form->required,
            $form->default,
            $form->variants,
            $form->sort
        );

        $this->characteristics->save($characteristic);
    }
}
