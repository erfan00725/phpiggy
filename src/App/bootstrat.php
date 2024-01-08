<?php

declare(strict_types=1);

require __DIR__ . "/../../vendor/autoload.php";
require __DIR__ . "/Config/MiddleWare.php";

use Framework\App;
use App\Config\{Routs, Paths};

use function App\Config\registerMiddleWare;

$app = new App(Paths::SOURCE . "/App/container-definitions.php");

function registerRouts(App $app)
{
    foreach (Routs::ROUTS as $rout) {
        if (array_key_exists("POST", $rout)) {
            $app->addPostRout($rout["path"], $rout["controller"]);
            return;
        }
        $app->addGetRout($rout["path"], $rout["controller"]);
    }
}

registerRouts($app);
registerMiddleWare($app);

return $app;
