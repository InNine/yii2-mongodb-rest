<?php
$params = array_merge(
    require __DIR__ . '/../../common/config/params.php',
    require __DIR__ . '/../../common/config/params-local.php',
    require __DIR__ . '/params.php',
    require __DIR__ . '/params-local.php'
);

return [
    'id' => 'app-frontend',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'controllerNamespace' => 'frontend\controllers',
    'components' => [
        'request' => [
            'csrfParam' => '_csrf-frontend',
            'parsers' => [
                'application/json' => 'yii\web\JsonParser',
            ]
        ],
        'errorHandler' => [
            'errorAction' => '/error/index',
        ],
        'response' => [
            'class' => \yii\web\Response::class,
            'on beforeSend' => function ($event) {
                $response = $event->sender;
                switch ($response->statusCode) {
                    case 200:
                        $response->data = [
                            'status' => 'Success',
                            'message' => 'Успешно',
                            'data' => [
                                'posts' => $response->data
                            ]
                        ];
                        break;
                    case 404:
                        $response->data = [
                            'status' => 'UrlNotFound',
                            'message' =>  "URL не найден",
                            'data' => []
                        ];
                        break;
                    case 500:
                        $response->data = [
                            'status' => 'GeneralInternalError',
                            'message' => 'Произошла ошибка',
                            'data' => []
                        ];
                        break;
                    case 400:
                        $response->data = [
                            'status' => 'BadRequest',
                            'message' => 'не все обязательные аргументы указаны!',
                            'data' => []
                        ];
                }
                if ($response->statusCode == 404) {
                    $response->data = [
                        'success' => 'UrlNotFound',
                        'message' => 'URL не найден',
                        'data' => []
                    ];
                }
                if ($response->data !== null) {

                    $response->statusCode = 200;
                }
            },
        ],
        'user' => [
            'identityClass' => 'common\models\User',
            'enableAutoLogin' => true,
            'identityCookie' => ['name' => '_identity-frontend', 'httpOnly' => true],
        ],
        'session' => [
            // this is the name of the session cookie used for login on the frontend
            'name' => 'advanced-frontend',
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
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
            ],
        ],
    ],
    'params' => $params,
    'modules' => [
        'api' => [
            'class' => \frontend\modules\api\Module::class,
            'modules' => [
                'v1' => [
                    'class' => \frontend\modules\api\v1\Module::class
                ]
            ]
        ]
    ]
];
