<?php

$params = array_merge(
    require(__DIR__ . '/../../common/config/params.php'),
    require(__DIR__ . '/../../common/config/params-local.php'),
    require(__DIR__ . '/params.php')
    //require(__DIR__ . '/params-local.php')
);

return [
    'id' => 'app-api',
    'basePath' => dirname(__DIR__),    
    'bootstrap' => ['log'],
    'modules' => [
        'v1' => [
            'basePath' => '@app/modules/v1',
            'class' => 'api\modules\v1\Module'
        ]
    ],
    'components' => [
        'request' => [
            'parsers' => [
                'application/json' => 'yii\web\JsonParser',
            ],
            'enableCsrfCookie' => false
        ],
        'response'=>[
            'formatters' =>[
                'json' =>[
                    'class' => 'yii\web\JsonResponseFormatter',
                    'prettyPrint' => YII_DEBUG,
                    'encodeOptions' => JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE,
                ],
            ],
        ],
        'user' => [
            'identityClass' => 'common\models\User',
            'enableAutoLogin' => false,
            'enableSession' => false,
            'loginUrl'=> null,
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],

        //regras que mudificam o url para aceder ao API
        'urlManager' => [
            'enablePrettyUrl' => true,
            'enableStrictParsing' => true,
            'showScriptName' => false,
            'rules' => [
                [
                    //função que desativa o plurize no link do url, vindo do vendor/yiisoft/yii2/rest/UrlRule.
                    'pluralize' => false,
                    'class' => 'yii\rest\UrlRule', 
                    'controller' => ['v1/country','v1/trip','v1/review','v1/continent','v1/wishlist'],
                    'tokens' => [
                        '{id}' => '<id:\\w+>'
                    ],
                ],

                [
                    'pluralize'=> false,
                    'class'=> 'yii\rest\UrlRule',
                    'controller'=> 'v1/user',
                    'extraPatterns'=>[
                        'POST login'=>'login',
                    ],
                ],



            ],        
        ]
    ],
    'params' => $params,
];



