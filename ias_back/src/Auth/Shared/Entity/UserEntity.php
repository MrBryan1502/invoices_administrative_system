<?php

namespace App\Auth\Shared\Entity;

use App\Auth\Shared\ValueObjects\UserEmail;
use App\Auth\Shared\ValueObjects\UserPassword;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;

class UserEntity implements PasswordAuthenticatedUserInterface
{

  private int $id_usuario;
  private string $nombre_usuario;
  private string $email;
  private string $password;
  private bool $activo;

  /**
   * @todo Agregar el campo activo cuando este listo en la BD
   */
  public function __construct(
    int $id_usuario,
    string $nombre_usuario,
    string $email,
    string $password
  ) {

    $this->id_usuario = $id_usuario;
    $this->nombre_usuario = $nombre_usuario;
    $this->email = $email;
    $this->password = $password;
  }

  public function getIdUsuario()
  {

    return $this->id_usuario;
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

  public static function fromAssoc(array $assoc)
  {

    $id_usuario = $assoc['idUsuario'];
    $nombre_usuario = $assoc['NombreUsuario'];
    $email = new UserEmail($assoc['Email']);
    $password = new UserPassword($assoc['Password']);

    return new self($id_usuario, $nombre_usuario, $email, $password);
  }

  public function toAssoc()
  {

    return [
      'idUsuario' => $this->id_usuario,
      'NombreUsuario' => $this->nombre_usuario,
      'Email' => $this->email
    ];
  }
}
