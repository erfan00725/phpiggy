<?php

declare(strict_types=1);

namespace Framework;


class App
{
    private Router $router;
    private Container $container;

    function __construct(string $containerDefinitionPath = null)
    {
        $this->router = new Router();
        $this->container = new Container();

        if ($containerDefinitionPath) {
            $containerDefinitions = include $containerDefinitionPath;
            $this->container->addDefinition($containerDefinitions);
        }
    }
    public function run()
    {
        $path = parse_url($_SERVER["REQUEST_URI"], PHP_URL_PATH);
        $method = $_SERVER["REQUEST_METHOD"];

        $this->router->dispatch($path, $method, $this->container);
    }

    public function addRout(string $path, string $method, array $controller)
    {
        $this->router->add($method, $path, $controller);
    }

    public function addMiddleWare(string $middleWare)
    {
        $this->router->addMiddleWare($middleWare);
    }

    public function addRouterMiddleware(string $middleWare)
    {
        $this->router->addRouteMiddleware($middleWare);
    }
}
