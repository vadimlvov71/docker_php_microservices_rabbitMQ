<?php
namespace Index;

error_reporting(E_ALL ^ E_DEPRECATED);
require_once __DIR__ . '/vendor/autoload.php';


use App\Classes\Router;
use App\Controllers\IndexController;



/**
 * Create a new router instance.
 */
$router = new Router($_SERVER);
 
/**
 * Add a "hello" route that prints to the screen.
 */
$router->addRoute('', function() {
    $application = new IndexController();
    $application->run();
});
$router->addRoute('hello', function() {
    $application = new IndexController();
    $application->contacts();
});
/**
 * Run it!
 */
$router->run();



