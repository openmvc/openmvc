<?php
/*** Turn DEBUG mode On/Off ***/
define('DEV_MODE', 1);
	error_reporting(DEV_MODE ? E_ALL : 0);
	ini_set('display_errors', DEV_MODE ? 1 : 0);

	
			####################### SET MAIN DEFINES ##########################
				/*** Set WWW Paths ***/
				define('WWW_CSS_PATH', '/css/');
				define('WWW_JS_PATH', '/js/');
				define('WWW_IMAGES_PATH', '/images/');
				define('WWW_PATH', str_replace( 'index.php', '', $_SERVER['SCRIPT_NAME'])); //sets web path of MVC dir
				
				define('HTTP_HOST', 'http://' . $_SERVER['HTTP_HOST']);
				define('STATIC_DIR', 'static_files/');
				
				/*** Set absolute Paths ***/
				define('APP_PATH', dirname(dirname(__FILE__)) . WWW_PATH);
				define('LOGS_PATH', APP_PATH . 'logs/');
				define('SYSTEM_PATH', APP_PATH . 'system/');
				define('LIB_PATH', APP_PATH . 'lib/');
				define('VIEWS_PATH', APP_PATH . 'views/');
				define('CONTROLLERS_PATH', APP_PATH . 'controllers/');
				define('CONFIG_PATH', APP_PATH . 'config/');
				
				/*** Set Logs files paths ***/
				define('ERROR_LOG_FILE_PATH', LOGS_PATH . 'errors.log');
				
				/*** Set Error Codes ***/
				define('ERRORCODE_TECHNICAL_DIFFICULTIES', 1001);
			####################### SET MAIN DEFINES ##########################


	/*** Include Logger Class ***/
	include_once (SYSTEM_PATH . 'logger.class.php');
	/*** Initialize Core Object (that manages all child objects/classes) ***/
	include_once (SYSTEM_PATH . 'core.class.php');
	$Core = new Core;
	

			/*** Each time a new lib class is instantiated/called - include_once it's source file ***/
			function __autoload($class_name) {
				
				/*** All NOT-system classes should be in LIB_PATH and their names should begin with lowercased class name plus ".class.php" ***/
			    $filename = strtolower($class_name) . '.class.php';
			    $file = LIB_PATH . $filename;
			    
			    /*** Check if file exists in LIB_PATH ***/
			    if (!file_exists($file)) {
					throw new Exception('Can\'t find class ['.$class_name.'] ('.$filename.')', ERRORCODE_TECHNICAL_DIFFICULTIES);
			    }
			    
			  	include_once ($file);
			}

	
	

	
	try {
	
		/*** Using "Router" try to set "View" components and run proper "Controller" that will prepare and run output ***/
		$Core->Router->loader();
	
	} catch (Exception $e) {
		
		/*** Some other error - load Error Controller, Error Layout and Content according to ErrorCode ***/
		$Core->Router->loadError();
		
	}