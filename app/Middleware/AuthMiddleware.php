<?php

namespace Middleware;

use Core\Response;
use Services\JWTService;

class AuthMiddleware
{
    public static function user()
        {
                $headers = getallheaders();

                        if (!isset($headers['Authorization'])) {
                                    Response::json([
                                                    'status' => false,
                                                                    'message' => 'Authorization token is required'
                                                                                ], 401);
                                                                                        }

                                                                                                $auth = $headers['Authorization'];

                                                                                                        if (!preg_match('/Bearer\s(\S+)/', $auth, $matches)) {
                                                                                                                    Response::json([
                                                                                                                                    'status' => false,
                                                                                                                                                    'message' => 'Invalid authorization format'
                                                                                                                                                                ], 401);
                                                                                                                                                                        }

                                                                                                                                                                                try {

                                                                                                                                                                                            $jwt = new JWTService();

                                                                                                                                                                                                        return $jwt->verify($matches[1]);

                                                                                                                                                                                                                } catch (\Exception $e) {

                                                                                                                                                                                                                            Response::json([
                                                                                                                                                                                                                                            'status' => false,
                                                                                                                                                                                                                                                            'message' => 'Invalid or expired token'
                                                                                                                                                                                                                                                                        ], 401);

                                                                                                                                                                                                                                                                                }
                                                                                                                                                                                                                                                                                    }
                                                                                                                                                                                                                                                                                    }