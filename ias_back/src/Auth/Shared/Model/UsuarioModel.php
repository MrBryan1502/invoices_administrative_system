<?php

namespace App\Auth\Shared\Model;

use App\Auth\Shared\Entity\UserEntity;
use App\Shared\Service\MainPDOService;

class UsuarioModel
{

  private $pdo_service;

  public function __construct()
  {

    $this->pdo_service = new MainPDOService();
  }

  public function findByEmail(string $email)
  {

    $qry = '
      SELECT
        "idUsuario",
        "NombreUsuario",
        "Email",
        "Password"
      FROM "SAS"."Usuario"
      WHERE "Email" = :email;
    ';

    $pdo = $this->pdo_service;

    $stm = $pdo()->prepare($qry);
    $stm->bindParam(':email', $email);
    $stm->execute();

    $result =  $stm->fetch(\PDO::FETCH_ASSOC);

    $pdo->__destruct();

    if (!$result) {


      throw new \Error(
        sprintf(
          'No se encontro al Usuario <%s> en la BD',
          $email
        )
      );
    }

    $user = UserEntity::fromAssoc($result);

    return $user;
  }

  public function save(
    string $nombre_usuario,
    string $email,
    string $password
  ) {

    $qry =
      '
      INSERT INTO "SAS"."Usuario" (
        "NombreUsuario",
        "Email",
        "Password"
      ) VALUES (
        :nombreUsuario,
        :email,
        :password
      );
    ';

    $pdo = $this->pdo_service;

    $stm = $pdo()->prepare($qry);

    $stm->bindParam(':nombreUsuario', $nombre_usuario);
    $stm->bindParam(':email', $email);
    $stm->bindParam(':password', $password);

    $stm->execute();

    $pdo->__destruct();
  }

  public function searchUserByEmail(string $email)
  {

    $qry = '
      SELECT
        "idUsuario",
        "NombreUsuario",
        "Email",
        "Password"
      FROM "SAS"."Usuario"
      WHERE "Email" = :email;
    ';

    $pdo = $this->pdo_service;

    $stm = $pdo()->prepare($qry);

    $stm->bindParam(':email', $email);

    $stm->execute();

    $result = $stm->fetch(\PDO::FETCH_ASSOC);

    if (!$result) {
      return null;
    }

    return UserEntity::fromAssoc($result);
  }
}
