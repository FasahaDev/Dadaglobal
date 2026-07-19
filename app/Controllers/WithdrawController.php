<?php

namespace Controllers;

use Core\Request;
use Core\Response;
use Middleware\AuthMiddleware;
use Models\Bank;
use Services\WithdrawService;

class WithdrawController
{
    private WithdrawService $service;
        private Bank $bank;

            public function __construct()
                {
                        $this->service = new WithdrawService();
                                $this->bank = new Bank();
                                    }

                                        /**
                                             * Get Bank List
                                                  */
                                                      public function banks()
                                                          {
                                                                  Response::json([
                                                                              "status" => true,
                                                                                          "data" => $this->bank->all()
                                                                                                  ]);
                                                                                                      }

                                                                                                          /**
                                                                                                               * Withdraw Request
                                                                                                                    */
                                                                                                                        public function request()
                                                                                                                            {
                                                                                                                                    $user = AuthMiddleware::user();

                                                                                                                                            $body = Request::body();

                                                                                                                                                    $result = $this->service->request([
                                                                                                                                                                "sid" => $user->data->id,
                                                                                                                                                                            "account_name" => $body["account_name"] ?? "",
                                                                                                                                                                                        "account_number" => $body["account_number"] ?? "",
                                                                                                                                                                                                    "bank_code" => $body["bank_code"] ?? "",
                                                                                                                                                                                                                "bank_name" => $body["bank_name"] ?? "",
                                                                                                                                                                                                                            "amount" => (float)($body["amount"] ?? 0),
                                                                                                                                                                                                                                        "provider" => $body["provider"] ?? "billstack"
                                                                                                                                                                                                                                                ]);

                                                                                                                                                                                                                                                        if (!$result["success"]) {

                                                                                                                                                                                                                                                                    Response::json([
                                                                                                                                                                                                                                                                                    "status" => false,
                                                                                                                                                                                                                                                                                                    "message" => $result["message"]
                                                                                                                                                                                                                                                                                                                ],400);

                                                                                                                                                                                                                                                                                                                        }

                                                                                                                                                                                                                                                                                                                                Response::json([
                                                                                                                                                                                                                                                                                                                                            "status" => true,
                                                                                                                                                                                                                                                                                                                                                        "message" => $result["message"],
                                                                                                                                                                                                                                                                                                                                                                    "reference" => $result["reference"]
                                                                                                                                                                                                                                                                                                                                                                            ]);
                                                                                                                                                                                                                                                                                                                                                                                }
                                                                                                                                                                                                                                                                                                                                                                                }