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
                                                                                                    $path = parse_url($uri, PHP_URL_PATH);

                                                                                                            if (!isset($this->routes[$method][$path])) {
                                                                                                                        Response::json([
                                                                                                                                        'status' => false,
                                                                                                                                                        'message' => 'Route Not Found',
                                                                                                                                                                        'path' => $path
                                                                                                                                                                                    ], 404);
                                                                                                                                                                                            }

                                                                                                                                                                                                    [$controller, $function] = $this->routes[$method][$path];

                                                                                                                                                                                                            $controller = "Controllers\\{$controller}";

                                                                                                                                                                                                                    if (!class_exists($controller)) {
                                                                                                                                                                                                                                Response::json([
                                                                                                                                                                                                                                                'status' => false,
                                                                                                                                                                                                                                                                'message' => "Controller {$controller} not found"
                                                                                                                                                                                                                                                                            ], 500);
                                                                                                                                                                                                                                                                                    }

                                                                                                                                                                                                                                                                                            $instance = new $controller();

                                                                                                                                                                                                                                                                                                    if (!method_exists($instance, $function)) {
                                                                                                                                                                                                                                                                                                                Response::json([
                                                                                                                                                                                                                                                                                                                                'status' => false,
                                                                                                                                                                                                                                                                                                                                                'message' => "Method {$function} not found"
                                                                                                                                                                                                                                                                                                                                                            ], 500);
                                                                                                                                                                                                                                                                                                                                                                    }

                                                                                                                                                                                                                                                                                                                                                                            $instance->$function();
                                                                                                                                                                                                                                                                                                                                                                                }
                                                                                                                                                                                                                                                                                                                                                                                }