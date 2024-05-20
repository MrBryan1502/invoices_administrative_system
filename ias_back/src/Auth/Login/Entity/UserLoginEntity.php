<?php

namespace App\Auth\Login\Entity;

use App\Auth\Shared\ValueObjects\UserEmail;
use App\Auth\Shared\ValueObjects\UserPassword;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;

class UserLoginEntity implements PasswordAuthenticatedUserInterface
{

  private string $email;
  private ?string $password;

  public function __construct(
    UserEmail $email,
    ?UserPassword $password
  ) {

    $this->email = $email->__toString();
    $this->password = $password->__toString();
  }

  public function getEmail()
  {

    return $this->email;
  }

  public function getPassword(): ?string
  {

    return $this->password;
  }

  public static function fromAssoc(array $assoc)
  {

    $email = new UserEmail($assoc['Email']);
    $password = new UserPassword($assoc['Password']);

    return new self($email, $password);
  }
}
