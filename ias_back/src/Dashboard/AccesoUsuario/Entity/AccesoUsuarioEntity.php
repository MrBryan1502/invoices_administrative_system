<?php

namespace App\Dashboard\AccesoUsuario\Entity;

class AccesoUsuarioEntity
{

  private int $idConexion;
  private string $base;

  public function __construct(
    int $idConexion,
    string $base
  ) {
    $this->idConexion = $idConexion;
    $this->base = $base;
  }

  public function getIdConexion(): int
  {

    return $this->idConexion;
  }

  public function getBase(): string
  {

    return $this->base;
  }

  public static function fromAssocc(array $assoc): AccesoUsuarioEntity
  {

    $idConexion = $assoc['idConexion'];
    $base = $assoc['Base'];

    return new self(
      $idConexion,
      $base
    );
  }

  public function toAssoc(): array
  {

    return [
      'idConexion' => $this->idConexion,
      'Base' => $this->base
    ];
  }
}
