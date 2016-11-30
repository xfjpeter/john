<?php
// bootstrap program

// define DIRECTORY_SEPARATOR
// define( 'DS', DIRECTORY_SEPARATOR );
define( 'DS', '/' );

// application name
define( 'APP_NAME', 'app' );

// base path
define( 'BASE_PATH', str_replace('\\', '/', dirname(__FILE__)) . DS );

// application path
define( 'APP_PATH', BASE_PATH . APP_NAME . DS );

// core path
define( 'CORE_PATH', BASE_PATH . 'core' . DS );

// runtime path
define( 'RUNTIME_PATH', BASE_PATH . 'runtime' . DS );

// config path
define( 'CONFIG_PATH', BASE_PATH . 'config' . DS );

// loaer compose autoload
require BASE_PATH . 'vendor' . DS . 'autoload.php';

// run exception model
$whoops = new \Whoops\Run;
$whoops -> pushHandler(new \Whoops\Handler\PrettyPageHandler);
$whoops -> register();

// load common/funcitons.php
require CORE_PATH . DS . 'common' . DS . 'functions.php';

// load Core.php
require CORE_PATH . 'Core.php';
// register autoload class
spl_autoload_register("\core\Core::autoload");

// launch framework
\core\Core::run();
