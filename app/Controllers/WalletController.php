<?php

namespace Controllers;

use Core\Response;
use Middleware\AuthMiddleware;
use Models\Wallet;
use Models\Transaction;

class WalletController
{
    private Wallet $wallet;
        private Transaction $transaction;

            public function __construct()
                {
                        $this->wallet = new Wallet();
                                $this->transaction = new Transaction();
                                    }

                                        public function balance()
                                            {
                                                    $user = AuthMiddleware::user();

                                                            $sid = $user->data->id;

                                                                    $balance = $this->wallet->balance($sid);

                                                                            Response::json([
                                                                                        "status" => true,
                                                                                                    "balance" => $balance
                                                                                                            ]);
                                                                                                                }

                                                                                                                    public function history()
                                                                                                                        {
                                                                                                                                $user = AuthMiddleware::user();

                                                                                                                                        $sid = $user->data->id;

                                                                                                                                                Response::json([
                                                                                                                                                            "status" => true,
                                                                                                                                                                        "transactions" => $this->transaction->history($sid)
                                                                                                                                                                                ]);
                                                                                                                                                                                    }
                                                                                                                                                                                    }