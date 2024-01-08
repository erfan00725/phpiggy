<?php

declare(strict_types=1);

namespace App\Services;

use Framework\Validator;
use Framework\Rules\RequiredRule;

class ValidatorService
{
    private Validator $validator;
    public function __construct()
    {
        $this->validator = new Validator();
        $this->validator->addRule("required", new RequiredRule);
    }

    public function validateRegister(array $data)
    {
        $this->validator->validate($data, [
            "email" => ["required"],
            "age" => ["required"],
            "country" => ["required"],
            "social" => ["required"],
            "password" => ["required"],
            "passwordConfirm" => ["required"],
            "tos" => ["required"],
        ]);
    }
}
