<?php

namespace shop\services\shop\Products;

use shop\Entities\Shop\Products\Tag;
use shop\Forms\Shop\Products\TagCreateForm;
use shop\Forms\Shop\Products\TagEditForm;
use shop\Repositories\Shop\Products\TagRepository;
use yii\helpers\Inflector;

class TagService
{
    private $tags;

    public function __construct(TagRepository $tags)
    {
        $this->tags = $tags;
    }

    public function create(TagCreateForm $form): Tag
    {
        $tag = Tag::create(
            $form->name,
            Inflector::slug($form->name)
        );

        $this->tags->save($tag);

        return $tag;
    }

    public function edit(int $id, TagEditForm $form): void
    {
        /** @var Tag $tag */
        $tag = $this->tags->findById($id);

        $tag->edit(
            $form->name,
            Inflector::slug($form->name)
        );
    }

    public function remove(int $id) : void
    {
        $tag = $this->tags->findById($id);
        $this->tags->remove($tag);
    }
}