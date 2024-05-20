<?php

namespace App\Dashboard\Conexion\Entity;

class ConexionEntity
{

  private int $idConexion;
  private string $base;
  private string $usuario;
  private string $password;

  public function __construct(
    int $idConexion,
    string $base,
    string $usuario,
    string $password
  ) {
    $this->idConexion = $idConexion;
    $this->base = $base;
    $this->usuario = $usuario;
    $this->password = $password;
  }

  public static function getInstanceToEncodedData(
    int $idConexion,
    string $usuarioEncoded,
    string $baseEncoded,
    string $passwordEncoded
  ): ConexionEntity {

    $base = base64_decode($baseEncoded);
    $usuario = base64_decode($usuarioEncoded);
    $password = base64_decode($passwordEncoded);

    return new self(
      $idConexion,
      $usuario,
      $base,
      $password
    );
  }

  public function getIdConexion(): int
  {

    return $this->idConexion;
  }

  public function getBase(): string
  {

    return $this->base;
  }

  public function getUsuario(): string
  {

    return $this->usuario;
  }

  public function getPassword(): string
  {

    return $this->password;
  }

  public static function fromAssocDataEncoded(array $assoc): ConexionEntity
  {

    $idConexion = $assoc['idConexion'];
    $base = base64_decode($assoc['Base']);
    $usuario = base64_decode($assoc['Usuario']);
    $password = base64_decode($assoc['Password']);

    return new self(
      $idConexion,
      $base,
      $usuario,
      $password
    );
  }

  public static function fromAssoc(array $assoc): ConexionEntity
  {

    $idConexion = $assoc['idC'];
    $base = $assoc['Base'];
    $usuario = $assoc['Usuario'];
    $password = $assoc['Password'];

    return new self(
      $idConexion,
      $base,
      $usuario,
      $password
    );
  }

  public function toAssoc(): array
  {

    return [
      'idConexion' => $this->idConexion,
      'Base' => $this->base,
      'Usuario' => $this->usuario,
      'Password' => $this->password
    ];
  }

  public function toAssocEncoded(): array
  {

    return [
      'idConexion' => $this->idConexion,
      'Base' => base64_encode($this->base),
      'Usuario' => base64_encode($this->usuario),
      'Password' => base64_encode($this->password)
    ];
  }
}
