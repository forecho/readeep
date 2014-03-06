<?php

// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');

// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.
return array(
	'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
	'name' => '深度阅读',
	'theme' => 'foundation',
	'timeZone' => 'Asia/Shanghai',
	'language' => 'zh_cn',
	// preloading 'log' component
	'preload'=>array(
		'log',
		'weixin',
		// 'login',
	),

	// autoloading model and component classes
	'import'=>array(
		'application.models.*',
		'application.components.*',
                'application.extensions.qiniu.QiNiuClound',
	),

	'modules'=>array(
		// uncomment the following to enable the Gii tool

		'gii'=>array(
			'class'=>'system.gii.GiiModule',
			'password'=>'123456',
			// If removed, Gii defaults to localhost only. Edit carefully to taste.
			'ipFilters'=>array('127.0.0.1','::1'),
		),

	),

	// application components
	'components'=>array(
		'user'=>array(
			// enable cookie-based authentication
			'allowAutoLogin'=>true,
		),
		'weixin' => array(
            'class' => 'ext.weixin.Weixin',
        ),
        // 配置插件
        'config' => array(
        	'class' => 'application.extensions.EConfig',
      	),
        // 'login' => array(
        //     'class' => 'ext.login.LoginWeixin',
        // ),
		// uncomment the following to enable URLs in path-format
		// 'urlManager'=>array(
		// 	'urlFormat'=>'path',
		// 	'showScriptName' => false,// 使用URL重写，去掉index.php
		// 	'urlSuffix' => '.html',//开启伪静态
		// 	'rules'=>array(
		// 		'<controller:\w+>/<id:\d+>'=>'<controller>/view',
		// 		'<controller:\w+>/<action:\w+>/<id:\d+>'=>'<controller>/<action>',
		// 		'<controller:\w+>/<action:\w+>'=>'<controller>/<action>',
		// 	),
		// ),

		// 'db'=>array(
		// 	'connectionString' => 'sqlite:'.dirname(__FILE__).'/../data/testdrive.db',
		// ),
		// uncomment the following to use a MySQL database

		'db'=>array(
			'connectionString' => 'mysql:host=localhost;dbname=readeep',
			'emulatePrepare' => true,
			'username' => 'root',
			'password' => '',
			'charset' => 'utf8',
			'enableProfiling'=>true,
        	'enableParamLogging'=>true,
		),

		'errorHandler'=>array(
			// use 'site/error' action to display errors
			'errorAction'=>'site/error',
		),

		'log'=>array(
			'class'=>'CLogRouter',
			'routes'=>array(
				array(
					// 'class'=>'CFileLogRoute',
					// 'levels'=>'error, warning',
					'class'=>'ext.yii-debug-toolbar.YiiDebugToolbarRoute',
					'ipFilters'=>array('*'),
				),
				// uncomment the following to show log messages on web pages
				/*
				array(
					'class'=>'CWebLogRoute',
				),
				*/
			),
		),
	),

	// application-level parameters that can be accessed
	// using Yii::app()->params['paramName']
	'params'=>array(
		// this is used in contact page
		'adminEmail'=>'webmaster@example.com',
	),
);