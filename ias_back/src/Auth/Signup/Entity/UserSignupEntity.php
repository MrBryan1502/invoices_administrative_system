<?php

namespace App\Auth\Signup\Entity\Signup;

use App\Auth\Shared\ValueObjects\UserEmail;
use App\Auth\Shared\ValueObjects\UserPassword;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;

class UserSignupEntity implements PasswordAuthenticatedUserInterface
{

  private string $nombre_usuario;
  private string $email;
  private ?string $password;
  private bool $activo;

  public function __construct(
    string $nombre_usuario,
    UserEmail $email,
    ?UserPassword $password,
    bool $activo = true
  ) {

    $this->nombre_usuario = $nombre_usuario;
    $this->email = $email->__toString();
    $this->password = $password->__toString();
    $this->activo = $activo;
  }

  public function getNombreUsuario()
  {

    return $this->nombre_usuario;
  }

  public function getEmail()
  {

    return $this->email;
  }

  public function getPassword(): ?string
  {

    return $this->password;
  }

  public function getActivo()
  {

    return $this->activo;
  }

  public static function fromAssoc(array $assoc)
  {

    $nombre_usuario = $assoc['NombreUsuario'];
    $email = new UserEmail($assoc['Email']);
    $password = new UserPassword($assoc['Password']);
    $activo = $assoc['Activo'] ?? true;

    return new self($nombre_usuario, $email, $password, $activo);
  }
}
