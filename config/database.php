<?php

$connection = new \Illuminate\Database\Capsule\Manager;

$dotenv = Dotenv\Dotenv::createUnsafeImmutable(__DIR__ .'/../');
$dotenv->load();

$db_config = [
    "driver" => $_ENV['DRIVER'],
    "host" => $_ENV['DB_HOST'],
    "database" => $_ENV['DB_NAME'],
    "username" => $_ENV['DB_USER'],
    "password" => $_ENV['DB_PASSWORD'],
    "charset" => "utf8",
    "collation" => "utf8_unicode_ci",
    "prefix" => ""
];

$connection->addConnection($db_config);
$connection->setAsGlobal();
$connection->bootEloquent();

return $connection;
