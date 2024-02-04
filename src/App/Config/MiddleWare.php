<?php

declare(strict_types=1);

namespace App\Config;

use Framework\App;
use App\Middleware\{TemplateDataMiddleware, ValidationExeptionMiddleware, SessionMiddleware, FlashMiddleware, CsrfTokenMiddleware, CsrfGuardMiddleware};

function registerMiddleWare(App $app)
{
    $app->addMiddleWare(CsrfGuardMiddleware::class);
    $app->addMiddleWare(CsrfTokenMiddleware::class);
    $app->addMiddleWare(TemplateDataMiddleware::class);
    $app->addMiddleWare(ValidationExeptionMiddleware::class);
    $app->addMiddleWare(FlashMiddleware::class);
    $app->addMiddleWare(SessionMiddleware::class);
}
