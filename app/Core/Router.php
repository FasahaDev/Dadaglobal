<?php

namespace Core;

class Router
{
    private array $routes = [];

        public function get(string $uri, array $action): void
            {
                    $this->routes['GET'][$uri] = $action;
                        }

                            public function post(string $uri, array $action): void
                                {
                                        $this->routes['POST'][$uri] = $action;
                                            }

                                                public function put(string $uri, array $action): void
                                                    {
                                                            $this->routes['PUT'][$uri] = $action;
                                                                }

                                                                    public function delete(string $uri, array $action): void
                                                                        {
                                                                                $this->routes['DELETE'][$uri] = $action;
                                                                                    }

                                                                                        public function dispatch(string $method, string $uri): void
                                                                                            {
                                                                                                    $uri = parse_url($uri, PHP_URL_PATH);

                                                                                                            if (!isset($this->routes[$method][$uri])) {
                                                                                                                        Response::json([
                                                                                                                                        'status' => false,
                                                                                                                                                        'message' => 'Route Not Found'
                                                                                                                                                                    ], 404);
                                                                                                                                                                            }

                                                                                                                                                                                    [$controller, $function] = $this->routes[$method][$uri];

                                                                                                                                                                                            $controller = "Controllers\\{$controller}";

                                                                                                                                                                                                    $instance = new $controller();

                                                                                                                                                                                                            call_user_func([$instance, $function]);
                                                                                                                                                                                                                }
                                                                                                                                                                                                                }