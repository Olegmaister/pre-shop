<?php

namespace admin\core;

use Yii;
use yii\web\UnauthorizedHttpException;

class Controller extends \yii2custom\api\core\Controller
{
    public function beforeAction($action)
    {
        $res = parent::beforeAction($action);
        $res && $this->checkAccess($action->id);
        return $res;
    }

    public function checkAccess($action, $model = null, $params = [])
    {
        if (!in_array($this->uniqueId, ['site', 'auth']) && Yii::$app->user->isGuest) {
            throw new UnauthorizedHttpException();
        }

        return true;
    }

    protected function file($b64)
    {
        if (!$b64 || $b64 == 'data:') {
            exit;
        }

        list($type, $data) = explode(';', substr($b64, strlen('data:')));
        list(, $data) = explode(',', $data);
        $data = base64_decode($data);

        header('Expires: 0');
        header('Cache-Control: must-revalidate');
        header('Pragma: public');
        header('Content-Type: ' . $type);
        header("Content-length: " . strlen($data));

        exit($data);
    }
}