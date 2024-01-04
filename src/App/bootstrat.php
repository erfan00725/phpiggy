<?php

declare(strict_types=1);

require __DIR__ . "/../../vendor/autoload.php";

use Framework\App;
use App\Config\{Routs, Paths};

$app = new App(Paths::SOURCE . "/App/container-definitions.php");

foreach (Routs::ROUTS as $rout) {
    $app->addGetRout($rout["path"], $rout["controller"]);
}



return $app;
