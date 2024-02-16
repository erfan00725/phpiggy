<?php

declare(strict_types=1);

namespace App\Config;

use App\Controllers\{AboutController, HomeController, AuthController, TransactionController, ReceiptController};
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
            "method" => "POST",
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
            "method" => "POST",
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
            "method" => "POST",
            "controller" => [TransactionController::class, 'create'],
            "middleware" => [AuthRequiredMiddleware::class]
        ],
        [
            "path" => "/transaction/{transaction}",
            "controller" => [TransactionController::class, 'editView'],
            "middleware" => [AuthRequiredMiddleware::class]
        ],
        [
            "path" => "/transaction/{transaction}",
            "method" => "POST",
            "controller" => [TransactionController::class, 'edit'],
            "middleware" => [AuthRequiredMiddleware::class]
        ],
        [
            "path" => "/transaction/{transaction}",
            "method" => "DELETE",
            "controller" => [TransactionController::class, 'delete'],
            "middleware" => [AuthRequiredMiddleware::class]
        ],
        [
            "path" => "/transaction/{transaction}/receipt",
            "controller" => [ReceiptController::class, 'uploadView'],
            "middleware" => [AuthRequiredMiddleware::class]
        ],
        [
            "path" => "/transaction/{transaction}/receipt",
            "method" => "POST",
            "controller" => [ReceiptController::class, 'upload'],
            "middleware" => [AuthRequiredMiddleware::class]
        ],
        [
            "path" => "/transaction/{transaction}/receipt/{receipt}",
            "controller" => [ReceiptController::class, 'download'],
            "middleware" => [AuthRequiredMiddleware::class]
        ],
        [
            "path" => "/transaction/{transaction}/receipt/{receipt}",
            "method" => "DELETE",
            "controller" => [ReceiptController::class, 'delete'],
            "middleware" => [AuthRequiredMiddleware::class]
        ],
    ];
}
