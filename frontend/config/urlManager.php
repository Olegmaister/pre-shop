<?php
/**@var $params array**/
return [
    'class' => '\yii\web\UrlManager',
    'baseUrl' => $params['frontendBaseUrl'],
    'enablePrettyUrl' => true,
    'showScriptName' => false,
    'rules' => [
        '' => 'site/index',
        '<_a:signup>' => 'signup/<_a>',
        '<_a:contact>' => 'contact/<_a>',
        '<_a:login|logout>' => 'auth/<_a>',
        'password/request' => 'password/request',
        '<_c:[\w\-]+>' => '<_c>/index',
        '<_c:[\w\-]+>/<id:\d+>' => '<_c>/view',
        '<_c:[\w\-]+>/<_a:[\w-]+>' => '<_c>/<_a>',
        '<_c:[\w\-]+>/<id:\d+>/<_a:[\w\-]+>' => '<_c>/<_a>',
    ],
];