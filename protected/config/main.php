<?php

// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');

// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.

Yii::setPathOfAlias('bootstrap', dirname(__FILE__).'/../extensions/bootstrap');

return array(
	'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
	'name'=>'中山大学多媒体信息服务平台',
	'language'=>'zh_cn',

	// preloading 'log' component
	'preload'=>array('log'),

	// autoloading model and component classes
	'import'=>array(
		'application.models.*',
		'application.components.*',
                'ext.simple_html_dom',
	),

	'modules'=>array(
		// uncomment the following to enable the Gii tool
		'gii'=>array(
		   	'generatorPaths'=>array(
			   	'bootstrap.gii',
			   ),
			'class'=>'system.gii.GiiModule',
			'password'=>'123456',
			// If removed, Gii defaults to localhost only. Edit carefully to taste.
		//	'ipFilters'=>array('127.0.0.1','::1'),
			'ipFilters'=>array('172.18.60.62','::1'),
                     //   'ipFilters'=>array("*","*"),
		),
		
	),

	// application components
	'components'=>array(
		'bootstrap'=>array(
			'class'=>'bootstrap.components.Bootstrap' 
		),

		'user'=>array(
			// enable cookie-based authentication
			'allowAutoLogin'=>true,
		),
		// uncomment the following to enable URLs in path-format
		
		'urlManager'=>array(
			'urlFormat'=>'path',
			'rules'=>array(
				'<controller:\w+>/<id:\d+>'=>'<controller>/view',
				'<controller:\w+>/<action:\w+>/<id:\d+>'=>'<controller>/<action>',
				'<controller:\w+>/<action:\w+>'=>'<controller>/<action>',
			),
		),
		
		/*
		'db'=>array(
			'connectionString' => 'sqlite:'.dirname(__FILE__).'/../data/testdrive.db',
		),
		*/
		// uncomment the following to use a MySQL database
		
		'db'=>array(
			'connectionString' => 'mysql:host=localhost;dbname=mis',
			'emulatePrepare' => true,
			'username' => 'root',
			'password' => '123',
			'charset' => 'utf8',
		),
		
		'errorHandler'=>array(
			// use 'site/error' action to display errors
			'errorAction'=>'site/error',
		),
		'log'=>array(
			'class'=>'CLogRouter',
			'routes'=>array(
				array( 		//数据库日志记载在db.log中
					'class'=>'CFileLogRoute',
					'categories'=>'db.*',
					'logFile'=>'db.log',
				),
				array(		//用户交互的日志记载在uc.log中
			   		'class'=>'CFileLogRoute',
					'categories'=>'uc.*',
					'logFile'=>'uc.log',
				),
				array(		//error日志单独保存到error.log中
			   		'class'=>'CFileLogRoute',
					'levels'=>'error',
					'logFile'=>'error.log',
				),
				array(		//其他日志保存到warning.log中
			   		'class'=>'CFileLogRoute',
					'levels'=>'trace, info, profile, warning',
					'logFile'=>'warning.log',
				),
			 	array(		//用户中心的错误日志直接发邮件
			   		'class'=>'CEmailLogRoute',
					'categories'=>'uc.*',
					'levels'=>'error',
					'emails'=>'hehao5@mail2.sysu.edu.cn',
				),	
				array(		//开发过程中，所有日志直接打印到页面

			   		'class'=>'CWebLogRoute',
					'levels'=>'trace, info, profile, warning, error',
				),
	
				// uncomment the following to show log messages on web pages
				/*
				array(
					'class'=>'CWebLogRoute',
				),
				*/
			),
		),
		'request'=>array(	//防范cookie欺骗和csrf攻击
		      	'enableCsrfValidation'=>true,
			'enableCookieValidation'=>true,      
		),
		/*
		'cache'=>array(		//memcache缓存配置，暂不启用，后期性能调优时再追加
			'class'=>'system.caching.CMemCache',
			'servers'=>array(
			 	array('host'=>'server1', 'port'=>11211, 'weight'=>60),  
			 	array('host'=>'server2', 'port'=>11211, 'weight'=>40),  
			 ),
		),
		*/
		
	),

	// application-level parameters that can be accessed
	// using Yii::app()->params['paramName']
	'params'=>array(
		// this is used in contact page
		'adminEmail'=>'hehao5@mail2.sysu.edu.cn',
		'recentlyNewsCount'=>12,	//首页上显示的最近服务咨询的条数
		'dictTypeSpecialClassroom'=>'SpecialClassroom',  //特色课室在KV字典表的类型名称
		'dictTypeCampus'=>'Campus',                      //校区名称在KV字典表的类型名称
		'dictTypeModule'=>'Module',                      //校区名称在KV字典表的类型名称
		'dictTypeArticle'=>'Article',                      //校区名称在KV字典表的类型名称
		'dictTypeCategory'=>'Category',                      //校区名称在KV字典表的类型名称
		'siteSpecialArticle'=>'SpecialArticle',		//特色课室页面的文章在Article表中的Publisher字段
                'siteIntroduceArticle'=>'IntroduceArticle',     //课室介绍页面的文章在Article表中的Publisher字段
	),
);
