<?php
/**@var $params array**/
return [
    'class' => 'yii\web\UrlManager',
    'baseUrl' => $params['backendBaseUrl'],
    'enablePrettyUrl' => true,
    'showScriptName' => false,
    'rules' => [
        'tag' => 'tag/index'
    ],
];