<?php

declare(strict_types=1);

namespace App\Config;

use Framework\App;
use App\Middleware\{TemplateDataMiddleware, ValidationExeptionMiddleware, SessionMiddleware, FlashMiddleware};

function registerMiddleWare(App $app)
{
    $app->addMiddleWare(TemplateDataMiddleware::class);
    $app->addMiddleWare(ValidationExeptionMiddleware::class);
    $app->addMiddleWare(FlashMiddleware::class);
    $app->addMiddleWare(SessionMiddleware::class);
}
