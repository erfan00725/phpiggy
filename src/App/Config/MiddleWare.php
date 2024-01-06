<?php

declare(strict_types=1);

namespace App\Config;

use Framework\App;
use App\Middleware\TemplateDataMiddleware;

function registerMiddleWare(App $app)
{
    $app->addMiddleWare(TemplateDataMiddleware::class);
}
