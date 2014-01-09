<?php

// This is the configuration for yiic console application.
// Any writable CConsoleApplication properties can be configured here.
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