<?php

// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');

// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.
return array(
	'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
	'name'=>'My Web Application',

	// preloading 'log' component
	'preload'=>array('log'),

	// autoloading model and component classes
	'import'=>array(
		'application.models.*',
		'application.components.*',
	),

	'modules'=>array(
		// uncomment the following to enable the Gii tool

		'gii'=>array(
			'class'=>'system.gii.GiiModule',
            'password'=>'1234',
			// If removed, Gii defaults to localhost only. Edit carefully to taste.
			'ipFilters'=>array('127.0.0.1','::1'),
		),

        'invoices'
	),

	// application components
	'components'=>array(

        'ePdf' => array(
            'class'         => 'ext.yii-pdf.EYiiPdf',
            'params'        => array(
                'mpdf'     => array(
                    'librarySourcePath' => 'application.vendors.mpdf.*',
                    'constants'         => array(
                        '_MPDF_TEMP_PATH' => Yii::getPathOfAlias('application.runtime'),
                    ),
                    'class'=>'mpdf', // the literal class filename to be loaded from the vendors folder
                    'defaultParams'     => array( // More info: http://mpdf1.com/manual/index.php?tid=184
                        'mode'              => 'utf-8', //  This parameter specifies the mode of the new document.
                        'format'            => 'A4', // format A4, A5, ...
                        'default_font_size' => 8, // Sets the default document font size in points (pt)
                        'default_font'      => 'Arial', // Sets the default font-family for the new document.
                        'mgl'               => 10, // margin_left. Sets the page margins for the new document.
                        'mgr'               => 10, // margin_right
                        'mgt'               => 10, // margin_top
                        'mgb'               => 10, // margin_bottom
                        'mgh'               => 10, // margin_header
                        'mgf'               => 10, // margin_footer
                        'orientation'       => 'P', // landscape or portrait orientation
                    )
                ),
                'HTML2PDF' => array(
                    'librarySourcePath' => 'application.vendors.html2pdf.*',
                    'classFile'         => 'html2pdf.class.php', // For adding to Yii::$classMap
                    /*'defaultParams'     => array( // More info: http://wiki.spipu.net/doku.php?id=html2pdf:en:v4:accueil
                        'orientation' => 'P', // landscape or portrait orientation
                        'format'      => 'A4', // format A4, A5, ...
                        'language'    => 'en', // language: fr, en, it ...
                        'unicode'     => true, // TRUE means clustering the input text IS unicode (default = true)
                        'encoding'    => 'UTF-8', // charset encoding; Default is UTF-8
                        'marges'      => array(5, 5, 5, 8), // margins by default, in order (left, top, right, bottom)
                    )*/
                )
            ),
        ),

		'user'=>array(
			// enable cookie-based authentication
			'allowAutoLogin'=>true,
		),
		// uncomment the following to enable URLs in path-format

		'urlManager'=>array(
            'showScriptName' => false,
			'urlFormat'=>'path',
			'rules'=>array(

                'invoices' => 'invoices/list/index',
                'invoices/<controller:\w+>' => 'invoices/<controller>/index',
                'invoices/<controller:\w+>/<id:\d+>' => 'invoices/<controller>/view',
                'invoices/<controller:\w+>/<action:\w+>' => 'invoices/<controller>/<action>',
                'invoices/<controller:\w+>/<action:\w+>/<id:\d+>' => 'invoices/<controller>/<action>',

                'gii'=>'gii',
                'gii/<controller:\w+>'=>'gii/<controller>',
                'gii/<controller:\w+>/<action:\w+>'=>'gii/<controller>/<action>',

				'<controller:\w+>/<id:\d+>'=>'<controller>/view',
				'<controller:\w+>/<action:\w+>/<id:\d+>'=>'<controller>/<action>',
				'<controller:\w+>/<action:\w+>'=>'<controller>/<action>',
                
			),
		),

		'db'=>array(
			'connectionString' => 'sqlite:'.dirname(__FILE__).'/../data/crm_db.db',
		),
		// uncomment the following to use a MySQL database
		/*
		'db'=>array(
			'connectionString' => 'mysql:host=localhost;dbname=testdrive',
			'emulatePrepare' => true,
			'username' => 'root',
			'password' => '',
			'charset' => 'utf8',
		),
		*/
		'errorHandler'=>array(
			// use 'site/error' action to display errors
			'errorAction'=>'site/error',
		),

		'log'=>array(
			'class'=>'CLogRouter',
			'routes'=>array(
				array(
					'class'=>'CFileLogRoute',
					'levels'=>'error, warning',
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