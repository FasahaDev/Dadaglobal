<?php

use Core\Router;

$router = new Router();

$router->get('/api/wallet/balance', ['WalletController', 'balance']);

$router->get('/api/wallet/history', ['WalletController', 'history']);

$router->get(
        '/api/deposit/account',
            ['DepositController','account']
            );

 $router->get(
        '/api/banks',
            ['WithdrawController','banks']
            );

            $router->post(
                '/api/withdraw',
                    ['WithdrawController','request']
                    ); 

return $router;