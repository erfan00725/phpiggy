<?php

declare(strict_types=1);

namespace Framework\Rules;

use Framework\Contracts\RuleInterface;
use InvalidArgumentException;

class LengthMaxRule implements RuleInterface
{
  public function validate(array $data, string $field, array $params): bool
  {
    if (empty($params[0])) {
        throw new InvalidArgumentException('maximum lenght no specified');
    }

    $lenght = (int) $params[0];

    return strlen($data[$field]) < $lenght;
  }

  public function getMessage(array $data, string $field, array $params): string
  {
    return "Exceeds maximum character limit of {$params[0]} characers";
  }
}