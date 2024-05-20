<?php

namespace App\Auth\Signup\Entity;

use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;

class UserEntity implements PasswordAuthenticatedUserInterface
{

  private string $nombreUsuario;
  private string $email;
  private string $password;
  private bool $activo;

  public function __construct(
    string $nombreUsuario,
    string $email,
    string $password,
    ?bool $activo = true
  ) {

    $this->nombreUsuario = $nombreUsuario;
    $this->email = $email;
    $this->password = $password;
    $this->activo = $activo;
  }

  public function getNombreUsuario(): string
  {

    return $this->nombreUsuario;
  }

  public function getEmail(): string
  {

    return $this->email;
  }

  public function getPassword(): ?string
  {

    return $this->password;
  }

  public function getActivo(): bool
  {

    return $this->activo;
  }

  public function setPassword(string $password)
  {

    $this->password = $password;
  }

  public function toAssoc(): array
  {

    return [
      'NombreUsuario' => $this->nombreUsuario,
      'Email' => $this->email,
      'Password' => $this->password,
      'Activo' => $this->activo
    ];
  }

  public static function fromAssoc(array $assoc): UserEntity
  {

    $nombreUsuario = $assoc['NombreUsuario'];
    $email = $assoc['Email'];
    $password = $assoc['Password'];
    $activo = $assoc['Activo'] ?? true;

    return new self(
      $nombreUsuario,
      $email,
      $password,
      $activo
    );
  }
}
