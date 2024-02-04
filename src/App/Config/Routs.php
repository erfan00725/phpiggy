<?php

declare(strict_types=1);

namespace App\Config;

use App\Controllers\{AboutController, HomeController, AuthController};

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
        ],
        [
            "path" => "/login",
            "controller" => [AuthController::class, "loginView"],
        ],
        [
            "path" => "/login",
            "controller" => [AuthController::class, "login"],
            "POST" => true,
        ],
        [
            "path" => "/register",
            "controller" => [AuthController::class, "registerView"],
        ],
        [
            "path" => "/register",
            "controller" => [AuthController::class, "register"],
            "POST" => true,
        ]
    ];
}
