<?php

declare(strict_types=1);

require __DIR__ . "/../../vendor/autoload.php";
require __DIR__ . "/Config/MiddleWare.php";

use Framework\App;
use App\Config\{Routs, Paths};
use Dotenv\Dotenv;

use function App\Config\registerMiddleWare;

$dotenv = Dotenv::createImmutable(Paths::ROOT);
$dotenv->load();

$app = new App(Paths::SOURCE . "/App/container-definitions.php");

function registerRouts(App $app)
{
    foreach (Routs::ROUTS as $rout) {
        if (array_key_exists("POST", $rout)) {
            $app->addPostRout($rout["path"], $rout["controller"]);
            continue;
        }
        $app->addGetRout($rout["path"], $rout["controller"]);
        foreach ($rout["middleware"] ?? [] as $middleware) {
            $app->addRouterMiddleware($middleware);
        }
    }
}

registerRouts($app);
registerMiddleWare($app);

return $app;
