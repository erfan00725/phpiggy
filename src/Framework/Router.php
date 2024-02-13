<?php

declare(strict_types=1);

namespace Framework;

class Router
{
    private array $routes = [];
    private array $middleWares = [];

    public function add(string $method, string $path, array $controller)
    {

        $path = $this->normalizePath($path);

        $regexPath = preg_replace('#{[^/]+}#' , '([^/]+)', $path);

        $this->routes[] = [
            'path' => $path,
            'method' => strtoupper($method),
            "controller" => $controller,
            'middleware' => [],
            'regexPath' => $regexPath
        ];  
    }
    private function normalizePath(string $path): string
    {
        $path = trim($path, '/');
        $path = "/{$path}/";

        $path = preg_replace("#[/]{2,}#", "/", $path);

        return $path;
    }

    public function dispatch(string $path, string $method, Container $container = null)
    {
        $path = $this->normalizePath($path);
        $method = strtoupper($method);

        // regex nafahmidam

        foreach ($this->routes as $route) {
            if (!preg_match("#^{$route['regexPath']}$#", $path , $paramValues) || $route["method"] !== $method) {
                continue;
            }

            array_shift($paramValues);

            preg_match_all('#{([^/]+)}#' , $route['path'] , $paramKeys);

            $paramKeys = $paramKeys[1];

            $params = array_combine($paramKeys , $paramValues);

            [$class, $method] = $route["controller"];

            $controllerInstance = $container ? $container->resolve($class) : new $class();

            $action = fn () => $controllerInstance->{$method}($params);

            $allMiddlewares = [...$route['middleware'], ...$this->middleWares];

            foreach ($allMiddlewares as $middleWare) {
                $middleWareInstance = $container ? $container->resolve($middleWare) :
                    new $middleWare;
                $action = fn () => $middleWareInstance->process($action);
            }

            $action();

            return;
        }
    }

    public function addMiddleWare(string $middleWare)
    {
        $this->middleWares[] = $middleWare;
    }

    public function addRouteMiddleware(string $middleware)
    {
        $lastRoutKey = array_key_last($this->routes);
        $this->routes[$lastRoutKey]['middleware'][] = $middleware;
    }
}
