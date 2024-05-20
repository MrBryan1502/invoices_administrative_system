<?php

namespace App\Auth\Shared\ValueObjects;

class UserEmail
{

  private string $value;

  public function __construct(string $value)
  {
    $this->isValidEmail($value);
    $this->value = $value;
  }

  private function isValidEmail(string $value)
  {

    $regexp = "/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/";

    if (!preg_match($regexp, $value)) {

      throw new \Exception(
        sprintf(
          'Este email <%s> no es un email valido',
          $value
        )
      );
    }
  }

  public function __toString(): string
  {
    return $this->value;
  }
}
