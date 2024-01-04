<?php

declare(strict_types=1);

namespace App\Config;

use App\Controllers\{AboutController, HomeController};

class Routs
{
    public const ROUTS = [
        [
            "path" => "/",
            "controller" => [HomeController::class, "home"],
        ],
        [
            "path" => "/about",
            "controller" => [AboutController::class, "about"],
        ]
    ];
}
