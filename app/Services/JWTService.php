<?php

namespace Services;

use Firebase\JWT\JWT;
use Firebase\JWT\Key;

class JWTService
{
    private string $secret;
        private string $issuer;
            private int $expire;

                public function __construct()
                    {
                            $config = require __DIR__ . '/../config/jwt.php';

                                    $this->secret = $config['secret'];
                                            $this->issuer = $config['issuer'];
                                                    $this->expire = $config['expire'];
                                                        }

                                                            public function generate(array $user): string
                                                                {
                                                                        $time = time();

                                                                                $payload = [
                                                                                            'iss' => $this->issuer,
                                                                                                        'iat' => $time,
                                                                                                                    'exp' => $time + $this->expire,
                                                                                                                                'data' => [
                                                                                                                                                'id' => $user['sId'],
                                                                                                                                                                'email' => $user['sEmail'],
                                                                                                                                                                                'phone' => $user['sPhone'],
                                                                                                                                                                                                'type' => $user['sType']
                                                                                                                                                                                                            ]
                                                                                                                                                                                                                    ];

                                                                                                                                                                                                                            return JWT::encode($payload, $this->secret, 'HS256');
                                                                                                                                                                                                                                }

                                                                                                                                                                                                                                    public function verify(string $token)
                                                                                                                                                                                                                                        {
                                                                                                                                                                                                                                                return JWT::decode(
                                                                                                                                                                                                                                                            $token,
                                                                                                                                                                                                                                                                        new Key($this->secret, 'HS256')
                                                                                                                                                                                                                                                                                );
                                                                                                                                                                                                                                                                                    }
                                                                                                                                                                                                                                                                                    }