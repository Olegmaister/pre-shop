<?php

namespace shop\Repositories\Shop\Products;

use shop\Entities\Shop\Products\Tag;

class TagRepository
{
    public function findById(int $id) : Tag
    {
        return $this->getBy(['id' => $id]);
    }

    public function save(Tag $tag) : void
    {
        if(!$tag->save()){
            throw new \DomainException('Saving error.');
        }
    }

    public function remove(Tag $tag) : void
    {
        if(!$tag->delete()){
            throw new \DomainException('Remove error.');
        }
    }

    private function getBy(array $condition) : Tag
    {
        if(!$tag = Tag::find()->where($condition)->one()){
            throw new \DomainException('Tag is not found');
        }

        return $tag;
    }
}
