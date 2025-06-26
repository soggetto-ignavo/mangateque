<?php
require 'vendor/autoload.php';
require 'vendor/altorouter/altorouter/AltoRouter.php';

$router = new AltoRouter();
$router->setBasePath('/mangateque');

$router->map('GET', '/', 'ControllerPage#homePage', 'homepage');

$match = $router->match();

if(is_array($match)) {
    list($controller, $action) = explode("#", $match['target']);
    $obj = new $controller();

    if(is_callable($obj, $action)) {
        call_user_func_array(array($obj, $action), $match['params']);
  }      
} else {
    http_reponse_code(404);
}