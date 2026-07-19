<?php

namespace Controllers;

use Core\Response;
use Middleware\AuthMiddleware;
use Models\ReservedAccount;
use Services\VirtualAccountService;

class DepositController
{
    private ReservedAccount $reservedAccount;
        private VirtualAccountService $virtualAccount;

            public function __construct()
                {
                        $this->reservedAccount = new ReservedAccount();
                                $this->virtualAccount = new VirtualAccountService();
                                    }

                                        public function account()
                                            {
                                                    $user = AuthMiddleware::user();

                                                            $sid = $user->data->id;

                                                                    $account = $this->reservedAccount->findByUser($sid);

                                                                            if ($account) {

                                                                                        Response::json([
                                                                                                        "status" => true,
                                                                                                                        "message" => "Reserved account found",
                                                                                                                                        "data" => $account
                                                                                                                                                    ]);

                                                                                                                                                            }

                                                                                                                                                                    /*
                                                                                                                                                                             |---------------------------------------------------------
                                                                                                                                                                                      | Default Provider
                                                                                                                                                                                               |---------------------------------------------------------
                                                                                                                                                                                                        */

                                                                                                                                                                                                                $provider = "billstack";

                                                                                                                                                                                                                        $response = $this->virtualAccount->create([
                                                                                                                                                                                                                                    "provider" => $provider,
                                                                                                                                                                                                                                                "sid" => $sid
                                                                                                                                                                                                                                                        ]);

                                                                                                                                                                                                                                                                if (!$response["success"]) {

                                                                                                                                                                                                                                                                            Response::json([
                                                                                                                                                                                                                                                                                            "status" => false,
                                                                                                                                                                                                                                                                                                            "message" => $response["message"]
                                                                                                                                                                                                                                                                                                                        ],400);

                                                                                                                                                                                                                                                                                                                                }

                                                                                                                                                                                                                                                                                                                                        $this->reservedAccount->create($response["data"]);

                                                                                                                                                                                                                                                                                                                                                Response::json([
                                                                                                                                                                                                                                                                                                                                                            "status" => true,
                                                                                                                                                                                                                                                                                                                                                                        "message" => "Reserved account created",
                                                                                                                                                                                                                                                                                                                                                                                    "data" => $response["data"]
                                                                                                                                                                                                                                                                                                                                                                                            ]);
                                                                                                                                                                                                                                                                                                                                                                                                }
                                                                                                                                                                                                                                                                                                                                                                                                }