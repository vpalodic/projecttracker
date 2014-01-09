<?php

// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');

// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.

/**
 * Helper function to easily join to paths
 * @param string $dir1
 * @param string $dir2
 * @return string Returns canonicalized absolute pathname
 */
function _joinpath($dir1, $dir2)
{
    return realpath($dir1 . DIRECTORY_SEPARATOR . $dir2);
}

$homePath = dirname(__FILE__) . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . '..';
$protectedPath = _joinpath($homePath, 'protected');
$webrootPath = _joinpath($homePath, 'www');
$runtimePath = _joinpath($homePath, 'runtime');

return array(
    'basePath' => dirname(__FILE__) . DIRECTORY_SEPARATOR . '..',
    'runtimePath' => $runtimePath,
	'name'=>'Project Tracker',
	'id' => 'ProjectTracker',
	'theme' => 'bootstrap',

    'aliases' => array(
        'bootstrap' => realpath(__DIR__ . '/../extensions/bootstrap'),
        'yiiwheels' => realpath(__DIR__ . '/../extensions/yiiwheels'),
    ),

	// preloading 'log' component
	'preload' => array('log'),

	// autoloading model and component classes
	'import' => array(
		'application.models.*',
		'application.components.*',
		'application.modules.admin.models.*',
        'ext.YiiMailer.YiiMailer',
        'bootstrap.helpers.TbHtml',
        'bootstrap.helpers.TbArray',
	),

	'modules' => array(
		'gii' => array(
            'generatorPaths' => array(
                'bootstrap.gii',
            ),
			'class' => 'system.gii.GiiModule',
			'password' => false,
			// If removed, Gii defaults to localhost only. Edit carefully to taste.
			'ipFilters' => false,
			'ipFilters' => array('127.0.0.1','::1'),
		),
		'admin',
	),

	// application components
	'components' => array(
        // yiistrap configuration
        'bootstrap' => array(
            'class' => 'bootstrap.components.TbApi',
        ),

        // yiiwheels configuration
        'yiiwheels' => array(
            'class' => 'yiiwheels.YiiWheels',
        ),

		'user' => array(
			// enable cookie-based authentication
			'allowAutoLogin' => true,
		),

        'authManager' => array(
            'class' => 'CDbAuthManager',
            'connectionID' => 'db',
            'itemTable' => 'auth_item',
            'itemChildTable' => 'auth_item_child',
            'assignmentTable' => 'auth_assignment',
        ),

		// uncomment the following to enable URLs in path-format
		'urlManager' => array(
			'urlFormat' => 'path',
			'showScriptName' => false,
			'rules' => array(
				'<pid:\d+>/commentfeed' => array('comment/feed', 'urlSuffix' => '.xml', 'caseSensitive' => false),
				'commentfeed' => array('comment/feed', 'urlSuffix' => '.xml', 'caseSensitive' => false),
				'<controller:\w+>/<id:\d+>' => '<controller>/view',
				'<controller:\w+>/<action:\w+>/<id:\d+>' => '<controller>/<action>',
				'<controller:\w+>/<action:\w+>' => '<controller>/<action>',
			),
		),

		// uncomment the following to use a SQL Lite database
		/*
		'db'=>array(
			'connectionString' => 'sqlite:'.dirname(__FILE__).'/../data/testdrive.db',
		),
		*/
		'db' => array(
			'connectionString' => 'mysql:host=127.0.0.1;dbname=projecttracker',
			'emulatePrepare' => true,
			'username' => 'project_tracker',
			'password' => 'ProjectTracker2014#',
			'charset' => 'utf8',
		),
		
		'errorHandler' => array(
			// use 'site/error' action to display errors
			'errorAction' => 'site/error',
		),
		'log' => array(
			'class' => 'CLogRouter',
			'routes' => array(
				array(
					'class' => 'CFileLogRoute',
					'levels' => 'error, warning',
				),
/*				array(
					'class' => 'CWebLogRoute',
				),
*/			),
		),
	),

	// application-level parameters that can be accessed
	// using Yii::app()->params['paramName']
	'params' => array(
		// this is used in contact page
		'adminEmail' => 'webmaster@example.com',
	),
);
