<?php

declare(strict_types=1);

namespace Framework;

class App
{
    private Router $router;

    function __construct()
    {
        $this->router = new Router();
    }
    public function run()
    {
        echo "app is running!";
    }

    public function addGetRout(string $path)
    {
        $this->router->add("GET", $path);
    }

}