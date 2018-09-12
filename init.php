<?php
session_start();
$GLOBALS['config'] = array(
    /* database configuration */
    'database' => array(
        'host'      => 'localhost',
        'dbname'    => 'blog',
        'username'  => 'root',
        'password'  => ''
    ),
);

// abs path for the includes
define('APP_PATH', __DIR__ . DIRECTORY_SEPARATOR); 
define('APP_URL', 'http://localhost/Blog/');

$relative_path = explode('/', $_SERVER['REQUEST_URI']);
$relative_path = DIRECTORY_SEPARATOR . $relative_path[1] . DIRECTORY_SEPARATOR;
spl_autoload_register(function($classname){
    require_once APP_PATH . 'classes/' . $classname . '.php';
});
