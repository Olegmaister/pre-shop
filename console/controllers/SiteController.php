<?php

namespace console\controllers;

use yii\console\Controller;

class SiteController extends Controller
{
    public function actionIndex()
    {
        dd(\Yii::$app->frontendUrlManager->createAbsoluteUrl('product/view'));
        dd('console');
    }
}