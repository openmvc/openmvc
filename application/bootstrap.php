<?php
namespace MyApp;

/**
 * Define "/" (UNIX) or "\" (WINDOWS) as DS
 */
define('DS', DIRECTORY_SEPARATOR);

/**
 * Define Framework path
 */
define('__CORE', realpath(__DIR__ . '/../core') . DS);

/**
 * Define Application path
 */
define('__APP', _DIR__);

/**
 * Define URL paths 
 */
define('__WWW', 'http://' . str_replace('index.php', '', $_SERVER['HTTP_HOST'] . $_SERVER['SCRIPT_NAME']));
define('__WWW_ASSETS', __WWW . 'assets/');
define('__WWW_CSS', __WWW_ASSETS . 'css/');
define('__WWW_JS', __WWW_ASSETS . 'js/');
define('__WWW_IMG', __WWW . 'img/');

/**
 * Define APP paths 
 */
define('__APP_MODELS', __APP . 'models' . DS);
define('__APP_VIEWS', __APP . 'views' . DS);
define('__APP_CONTROLLERS', __APP . 'controllers' . DS);
define('__APP_CONFIG', __APP . 'config' . DS);

/**
 * Define APP Logs paths
 */
define('__LOGS', __APP . 'logs/');
define('__ERROR_LOG_FILE', __LOGS . 'errors.log');


/**
 * Show Warnings & Errors if DEV_MODE define was set to (bool) TRUE
 */
defined('DEV_MODE') or define('DEV_MODE', 0);
error_reporting(DEV_MODE ? E_ALL & E_STRICT : 0);
ini_set('display_errors', DEV_MODE ? 1 : 0);

/*** Set Error Codes ***/
define('ERRORCODE_TECHNICAL_DIFFICULTIES', 1001);

/**
 * Define "/" (UNIX) or "\" (WINDOWS) as DS 
 */
define( __NAMESPACE__ . '\\DS', DIRECTORY_SEPARATOR);


        /*** Include Logger Class ***/
//      include_once (CORE_PATH . 'logger.class.php');
        /*** Initialize Core Object (that manages all child objects/classes) ***/
//      include_once (OPENMVC_SYSTEM_PATH . 'core.class.php');
//      $Core = new Core;


                        /*** Each time a new lib class is instantiated/called - include_once it's source file ***/
                        function __autoload($class_name) {

                                /*** All NOT-system classes should be in OPENMVC_LIB_PATH and their names should begin with lowercased class name plus ".class.php" ***/
                            $filename = strtolower($class_name) . '.class.php';
                            $file = OPENMVC_LIB_PATH . $filename;

                            /*** Check if file exists in OPENMVC_LIB_PATH ***/
                            if (!file_exists($file)) {

                                        /*** Look in MODEL PATH ***/
                                        $filename = strtolower($class_name) . '.class.php';
                                        $file = MODELS_PATH . $filename;

                                        if (!file_exists($file)) {
                                                throw new Exception('Can\'t find class ['.$class_name.'] ('.$filename.')', ERRORCODE_TECHNICAL_DIFFICULTIES);
                                        }
                            }

                                include_once ($file);
                        }





        try {

                /*** Using "Router" try to set "View" components and run proper "Controller" that will prepare and run output ***/
//              Router::loader();
                echo 'loaded';

        } catch (Exception $e) {

                /*** Some other error - load Error Controller, Error Layout and Content according to ErrorCode ***/
//              $Core->Router->loadError();

        }

use OpenMvc as O;
echo OM\DS;
