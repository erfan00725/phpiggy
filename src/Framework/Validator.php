<?php

declare(strict_types=1);

namespace Framework;

use Framework\Contracts\RuleInterface;
use Framework\Exceptions\ValidationExeption;

class Validator
{
    private $rules = [];

    public function addRule(string $alias, RuleInterface $rule)
    {
        $this->rules[$alias] = $rule;
    }


    public function validate(array $data, array $fields)
    {
        $errors = [];

        foreach ($fields as $fieldName => $rules) {
            foreach ($rules as $rule) {
                $ruleValidator = $this->rules[$rule];

                if ($ruleValidator->validate($data, $fieldName, [])) {
                    continue;
                }

                $errors[$fieldName][] = $ruleValidator->getMessage($data, $fieldName, []);
            }
        }

        if (count($errors)) {
            throw new ValidationExeption();
        }
    }
}
