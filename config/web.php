<?php

$params = require(__DIR__ . '/params.php');

$config = [
    'id' => 'basic',
    'basePath' => dirname(__DIR__),
	'language' => 'es',
// 	'charset' => 'iso-8859-1',
    'bootstrap' => ['log'],
    'components' => [
// 		'formatter' => [
// //     		'dateFormat' => 'd-M-Y',
//     		'dateFormat' => 'dd/MM/yyyy',
// //     		'datetimeFormat' => 'd-M-Y H:i:s',
//     		'datetimeFormat' => 'dd/MM/yyyy HH:mm:ss',
//     		'timeFormat' => 'HH:mm',
// // 			'timeFormat' => 'H:i:s',
// 			'locale' => 'es_ES', //your language locale
//     		'defaultTimeZone' => 'America/Argentina/Buenos_Aires', // time zone
//     	],
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => 'concursopj',
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'user' => [
            'identityClass' => 'app\models\User',
            'enableAutoLogin' => true,
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
    	'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            // send all mails to a file by default. You have to set
            // 'useFileTransport' to false and configure a transport
            // for the mailer to send real emails.
            'useFileTransport' => true,
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error'],
//                     'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'db' => require(__DIR__ . '/db.php'),
        /*
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
            ],
        ],
        */
    ],
    'params' => $params,
];

$config['modules']['gridview'] = [
				'class' => '\kartik\grid\Module'
				// enter optional module parameters below - only if you need to
				// use your own export download action or custom translation
				// message source
				// 'downloadAction' => 'gridview/export/download',
				// 'i18n' => []
		];

// if (YII_ENV_DEV) {
//     // configuration adjustments for 'dev' environment
//     $config['bootstrap'][] = 'debug';
//     $config['modules']['debug'] = [
//         'class' => 'yii\debug\Module',
//     ];

//     $config['bootstrap'][] = 'gii';
//     $config['modules']['gii'] = [
//         'class' => 'yii\gii\Module',
//     ];
// }

return $config;
