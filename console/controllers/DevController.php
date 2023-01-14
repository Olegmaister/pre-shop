<?php

namespace console\controllers;

use Yii;
use yii\console\Controller;
use yii\helpers\Inflector;
use yii2custom\common\core\ActiveRecord;

class DevController extends Controller
{
//    public function actionGiiModel(string $tableName, ?string $modelClass = null, ?string $ns = null)
//    {
//        $modelClass = $modelClass ?? Inflector::camelize($tableName);
//        $ns = $ns ?? 'common\\\\models';
//        $baseClass = str_replace('\\', '\\\\', ActiveRecord::class);
//
//        echo `./yii gii/model --enableI18N=1 --interactive=0 --overwrite=1 --generateRelationsFromCurrentSchema=0 --useSchemaName=0 --ns=$ns --tableName=$tableName --modelClass=$modelClass --baseClass=$baseClass`;
//    }
    public function actionGiiModel(string $tableName, $pathEntities, ?string $modelClass = null)
    {
        $modelClass = $modelClass ?? Inflector::camelize($tableName);
        $modelClass = substr($modelClass,0,-1);

        $path = 'shop\\\\Entities';
        $delimiter = '\\\\';

        if(isset($pathEntities)){
            $result = explode('/',$pathEntities);
            foreach ($result as $elementPath) {
                $path .= $delimiter.Inflector::camelize($elementPath);
            }
        }

        $ns = $path;

        //$baseClass = str_replace('\\', '\\\\', ActiveRecord::class);

        echo `./yii gii/model --enableI18N=1 --interactive=0 --overwrite=1 --generateRelationsFromCurrentSchema=0 --useSchemaName=0 --ns=$ns --tableName=$tableName --modelClass=$modelClass`;
    }

    public function actionGiiApi(string $tableName, ?string $modelClass = null, ?string $ns = null)
    {
        $modelClass = $modelClass ?? Inflector::camelize($tableName);
        $ns = $ns ?? 'api\\\\models';
        echo `./yii gii/api --interactive=0 --overwrite=1 --ns=$ns --tableName=$tableName --modelClass=$modelClass`;
    }

    public function actionGiiAdmin(string $tableName, ?string $modelClass = null, ?string $ns = null)
    {
        $modelClass = $modelClass ?? Inflector::camelize($tableName);
        $ns = $ns ?? 'admin\\\\models';
        echo `./yii gii/admin --interactive=0 --overwrite=1 --ns=$ns --tableName=$tableName --modelClass=$modelClass`;
    }

    public function actionGiiCrud(string $table, ?string $name = null)
    {
        $name = $name ?? $table;
        $modelClass = 'common\\\\models\\\\' . Inflector::camelize($table);
        $searchModelClass = 'admin\\\\models\\\\search\\\\' . Inflector::camelize($table) . 'Search';
        $baseControllerClass = 'yii2custom\\\\admin\\\\core\\\\Controller';
        $controllerClass = 'admin\\\\controllers\\\\' . Inflector::camelize($name) . 'Controller';
        $viewPath = 'admin\\\\views\\\\' . str_replace('_', '-', $name);

        echo `./yii gii/crud --enableI18N=1 --interactive=0 --overwrite=1 --modelClass=$modelClass --searchModelClass=$searchModelClass --baseControllerClass=$baseControllerClass --controllerClass=$controllerClass --viewPath=$viewPath`;
    }

    public function actionI18n()
    {
        //$languages = Yii::$app->{'languages'}->list();
        $languages = ['en'];
        system('./yii message common/config/i18n.php -l "' . join(',', $languages) . '"');
    }
}