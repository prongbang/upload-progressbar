<?php

require_once('vendor/autoload.php');

/**
 * @Slim
 */
\Slim\Slim::registerAutoloader();
$app = new \Slim\Slim(array(
    'mode' => 'development',
    'debug' => true
        ));

/**
 * @Template
 */
$app->config(array(
    'templates.path' => './views',
));

/**
 * @Response
 */
$response = $app->response();
$response->header('Access-Control-Allow-Origin', '*');

/**
 * @Load Controller
 */
$routes = glob("controller/*Controller.php");
foreach ($routes as $route) {
    if ($route != "models/.htaccess") {
        require_once($route);
    }
}

/**
 * @Run
 */
$app->run();
