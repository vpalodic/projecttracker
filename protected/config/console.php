<?php

// This is the configuration for yiic console application.
// Any writable CConsoleApplication properties can be configured here.
return array(
	'basePath' => dirname(__FILE__) . DIRECTORY_SEPARATOR . '..',
	'name' => 'Project Tracker',

	// preloading 'log' component
	'preload' => array('log'),

	// application components
	'components' => array(
        'authManager' => array(
            'class' => 'CDbAuthManager',
            'connectionID' => 'db',
            'itemTable' => 'auth_item',
            'itemChildTable' => 'auth_item_child',
            'assignmentTable' => 'auth_assignment',
        ),

		/*
		// uncomment the following to use a SQL Lite database
		'db' => array(
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

		'log' => array(
			'class' => 'CLogRouter',
			'routes' => array(
				array(
					'class' => 'CFileLogRoute',
					'levels' => 'error, warning',
				),
			),
		),
	),
);