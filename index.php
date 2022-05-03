<?php

require __DIR__ . '/vendor/autoload.php';

require_once './routes.php';
require_once './config.php';
require_once './init.php';

/** @var \Bramus\Router\Router $router */

$router->run();
