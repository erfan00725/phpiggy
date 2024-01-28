<?php

declare(strict_types=1);

namespace App\Middleware;

use Framework\Contracts\MiddlewareInterface;;

use Framework\Exceptions\ValidationException;

class ValidationExeptionMiddleware implements MiddlewareInterface
{
    public function process(callable $next)
    {

        try {
            $next();
        } catch (ValidationException $e) {
            $oldFormData = $_POST;

            $excludedFields = ['password', 'passwordConfirm'];

            $formatedFormData = array_diff_key($oldFormData, array_flip($excludedFields));

            $_SESSION['errors'] = $e->errors;
            $_SESSION['oldFormData'] = $formatedFormData;

            $referer = $_SERVER['HTTP_REFERER'];
            redirectTo($referer);
        }
    }
}
