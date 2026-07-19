<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/../bootstrap/app.php';

$router = require __DIR__ . '/../routes/api.php';

$router->dispatch(
    $_SERVER['REQUEST_METHOD'],
        $_SERVER['REQUEST_URI']
        );