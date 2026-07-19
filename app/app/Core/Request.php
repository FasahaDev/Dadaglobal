<?php

namespace Core;

class Request
{
    public static function body()
        {
                return json_decode(file_get_contents("php://input"), true) ?? [];
                    }

                        public static function get($key, $default = null)
                            {
                                    return $_GET[$key] ?? $default;
                                        }

                                            public static function post($key, $default = null)
                                                {
                                                        return $_POST[$key] ?? $default;
                                                            }

                                                                public static function method()
                                                                    {
                                                                            return $_SERVER['REQUEST_METHOD'];
                                                                                }
                                                                                }