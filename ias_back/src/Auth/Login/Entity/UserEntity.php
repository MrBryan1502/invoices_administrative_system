<?php

namespace App\Auth\Login\Entity;

use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;

class UserEntity implements PasswordAuthenticatedUserInterface
{

  private int $idUsuario;
  private string $nombreUsuario;
  private string $email;
  private ?string $password;
  private bool $activo;

  public function __construct(
    int $idUsuario,
    string $nombreUsuario,
    string $email,
    ?string $password
    //bool $activo
  ) {

    $this->idUsuario = $idUsuario;
    $this->nombreUsuario = $nombreUsuario;
    $this->email = $email;
    $this->password = $password;
    //$this->activo = $activo;
  }

  public function getIdUsuario(): int
  {

    return $this->idUsuario;
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

  /* public function getActivo(): bool
  {

    return $this->activo;
  }

  public function setPassword(string $password)
  {

    $this->password = $password;
  } */

  public function toAssoc(): array
  {

    return [
      'idUsuario' => $this->idUsuario,
      'NombreUsuario' => $this->nombreUsuario,
      'Email' => $this->email,
      'Password' => $this->password,
      //'Activo' => $this->activo
    ];
  }



  public static function fromStdClass(\stdClass $stdClass): UserEntity
  {

    $idUsuario = $stdClass->idUsuario;
    $nombreUsuario = $stdClass->NombreUsuario;
    $email = $stdClass->Email;
    $password = $stdClass->Password;
    //$activo = $assoc['Activo'];

    return new self(
      $idUsuario,
      $nombreUsuario,
      $email,
      $password
      //$activo
    );
  }

  public static function fromAssoc(array $assoc): UserEntity
  {

    $idUsuario = $assoc['idUsuario'];
    $nombreUsuario = $assoc['NombreUsuario'];
    $email = $assoc['Email'];
    $password = $assoc['Password'];
    //$activo = $assoc['Activo'];

    return new self(
      $idUsuario,
      $nombreUsuario,
      $email,
      $password
      //$activo
    );
  }
}
