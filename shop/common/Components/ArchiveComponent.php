<?php

namespace shop\common\components;

use shop\Repositories\Sql\Archive\ArchiveRepository;
use yii\base\Component;
use yii\db\ActiveRecord;

class ArchiveComponent extends Component
{
    private $repository;
    public function __construct(ArchiveRepository $repository,$config = [])
    {
        $this->repository = $repository;
        parent::__construct($config);
    }

    public function restoreRecord($tableName, $modelId) : void
    {
        $modelArchive = $this->repository->findByNameId($tableName, $modelId);
        /** @var ActiveRecord $class */

        $data = json_decode($modelArchive['json_data'],true);

        $class = new $modelArchive['class_path'];


        foreach ($class->getAttributes() as $name => $attribute) {
            if($name == 'id'){
                continue;
            }
            if(isset($data[$name])){
                $class->{$name} = $data[$name];
            }
        }

        $this->repository->save($tableName, $class);
        $this->repository->remove($tableName, $modelId);
    }
}