<?php

use Slim\App;

require(__DIR__ . '/../vendor/autoload.php');

$settings = require_once(__DIR__ . '/settings.php');
$routeContainers = require_once(__DIR__ . '/routeContainers.php');
$middleware = require_once(__DIR__ . '/middleware.php');

$app = new App($settings);

require_once(__DIR__ . '/errorHandler.php');
require_once(__DIR__ . '/routes.php');
require_once(__DIR__ . '/database.php');

$container = $app->getContainer();
$routeContainers($container);
$middleware($app);

$app->run();