<?php

declare(strict_types=1);

require __DIR__ . "/../../vendor/autoload.php";
require __DIR__ . "/Config/MiddleWare.php";

use Framework\App;
use App\Config\{Routs, Paths};

use function App\Config\registerMiddleWare;

$app = new App(Paths::SOURCE . "/App/container-definitions.php");

foreach (Routs::ROUTS as $rout) {
    $app->addGetRout($rout["path"], $rout["controller"]);
}

registerMiddleWare($app);

return $app;
