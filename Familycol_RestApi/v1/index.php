<?php
header("Access-Control-Allow-Origin: *");
header('Access-Control-Allow-Credentials: true');
header('Access-Control-Allow-Methods: PUT, GET, POST, DELETE, OPTIONS');
header("Access-Control-Allow-Headers: X-Requested-With");
header('Content-Type: application/json; charset=utf-8');
header('P3P: CP="IDC DSP COR CURa ADMa OUR IND PHY ONL COM STA"');

include_once '../utils/Config.php';
require 'controllers/UserController.php';
require '../data/ConnectionDb.php';
require '../utils/ColUtil.php';
require '../vendor/autoload.php';

$configuration = [
    'settings' => [
        'displayErrorDetails' => true,
    ],
];
$container = new \Slim\Container($configuration);
$container['UserController'] = function ($container) {
    $router = $container->get('router');
    return new UserController($router);
};
$app = new Slim\App($container);

//Routes mapping --> [/{id}] optional
$app->map(['GET'], '/user', 'UserController:getAll');
$app->map(['GET'], '/user/{id}', 'UserController:get');
$app->map(['POST'], '/user/authenticate', 'UserController:getAuthenticate');
//$app->map(['POST'], '/user', 'UserController:save');
//$app->map(['PUT'], '/user', 'UserController:update');
//$app->map(['DELETE'], '/user', 'UserController:delete');

$app->run();

//http://www.hermosaprogramacion.com/2015/10/servicio-web-restful-android-php-mysql-json/