<?php

use Core\Router;

$router = new Router();

/*
|--------------------------------------------------------------------------
| Authentication
|--------------------------------------------------------------------------
*/

$router->post('/api/register', ['AuthController', 'register']);
$router->post('/api/login', ['AuthController', 'login']);

/*
|--------------------------------------------------------------------------
| User
|--------------------------------------------------------------------------
*/

$router->get('/api/profile', ['AuthController', 'profile']);

return $router;