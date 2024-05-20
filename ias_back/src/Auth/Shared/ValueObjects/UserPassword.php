<?php

namespace App\Auth\Shared\ValueObjects;

class UserPassword
{

  private string $value;

  public function __construct(string $value)
  {
    $this->isValidPassword($value);
    $this->value = $value;
  }

  private function isValidPassword(string $value)
  {

    $regexp = "/^(?=.*[A-Z])(?=.*[\W_])(?=.*\d).{9,}$/";

    if (!preg_match($regexp, $value)) {

      throw new \Exception(
        sprintf(
          'Este contraseña no es una contraseña valida',
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
