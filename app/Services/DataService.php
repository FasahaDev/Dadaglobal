<?php

namespace Services;

use Models\Provider;

class DataService
{
    protected Provider $provider;

        public function __construct()
            {
                    $this->provider = new Provider();
                        }

                            public function purchase(array $payload)
                                {
                                        $provider = $this->provider->get('DATA');

                                                if (!$provider) {
                                                            return [
                                                                            "success" => false,
                                                                                            "message" => "No active provider found"
                                                                                                        ];
                                                                                                                }

                                                                                                                        return [
                                                                                                                                    "success" => true,
                                                                                                                                                "provider" => $provider,
                                                                                                                                                            "message" => "Provider selected successfully"
                                                                                                                                                                    ];
                                                                                                                                                                        }
                                                                                                                                                                        }