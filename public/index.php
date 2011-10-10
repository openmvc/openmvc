<?php

/**
 * Define "/" (UNIX) or "\" (WINDOWS) as DS 
 */
define('DS', DIRECTORY_SEPARATOR);

/**
 * Define Framework path
 */
define('OPENMVC_PATH', realpath(__DIR__ . '../openmvc') . DS);

/**
 * Define Application path 
 */
define('APP_PATH', realpath(__DIR__ . '../app') . DS);

/**
 * Bootstrap the application 
 */
require APP_PATH . 'bootstrap.php';
