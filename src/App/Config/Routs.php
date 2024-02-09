<?php

declare(strict_types=1);

namespace App\Config;

use App\Controllers\{AboutController, HomeController, AuthController, TransactionController};
use App\Middleware\{GuestOnlyMiddleware, AuthRequiredMiddleware};


class Routs
{
    public const ROUTS = [
        [
            "path" => "/",
            "controller" => [HomeController::class, "home"],
            "middleware" => [AuthRequiredMiddleware::class]
        ],
        [
            "path" => "/about",
            "controller" => [AboutController::class, "about"],
        ],
        [
            "path" => "/login",
            "controller" => [AuthController::class, "loginView"],
            "middleware" => [GuestOnlyMiddleware::class]
        ],
        [
            "path" => "/login",
            "controller" => [AuthController::class, "login"],
            "POST" => true,
            "middleware" => [GuestOnlyMiddleware::class]
        ],
        [
            "path" => "/register",
            "controller" => [AuthController::class, "registerView"],
            "middleware" => [GuestOnlyMiddleware::class]
        ],
        [
            "path" => "/register",
            "controller" => [AuthController::class, "register"],
            "POST" => true,
            "middleware" => [GuestOnlyMiddleware::class]
        ],
        [
            "path" => "/logout",
            "controller" => [AuthController::class, 'logout'],
            "middleware" => [AuthRequiredMiddleware::class]
        ],
        [
            "path" => "/transaction",
            "controller" => [TransactionController::class, 'createView'],
            "middleware" => [AuthRequiredMiddleware::class]
        ],
        [
            "path" => "/transaction",
            "POST" => true,
            "controller" => [TransactionController::class, 'create'],
            "middleware" => [AuthRequiredMiddleware::class]
        ]
    ];
}
