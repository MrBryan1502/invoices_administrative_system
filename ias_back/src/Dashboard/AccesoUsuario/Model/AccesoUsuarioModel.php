<?php

namespace App\Dashboard\AccesoUsuario\Model;

use App\Dashboard\AccesoUsuario\Entity\AccesoUsuarioEntity;
use App\Dashboard\Conexion\ConexionModel;
use App\Shared\DBManager\Controller\PDOController;
use App\Shared\DBManager\Model\ConexionesPDOModel;
use App\Shared\DBManager\Model\MainPDOModel;

class AccesoUsuarioModel
{

  public function searchByIdUsuario(int $idUsuario): array
  {

    $qry = '
      SELECT
        au."idConexion",
        c."Base",
        au."idUsuario"
      FROM
        "SAS"."AccesoUsuario" as au
      INNER JOIN "SAS"."Conexion" as c on (
        au."idConexion" = c."idConexion"
      ) WHERE au."idUsuario" = :idUsuario
    ';

    $pdo = PDOController::getInstance(new MainPDOModel());
    $stm = $pdo->prepare($qry);

    $stm->bindParam(':idUsuario', $idUsuario);

    if (!$stm->execute()) {
      $errorInfo = $stm->errorInfo();
      throw new \Error(
        sprintf('Error en la consulta SQL: %s', $errorInfo[2])
      );
    }

    $response = $stm->fetchAll();

    foreach ($response as $conexion) {

      $qry = '
      SELECT *
      FROM "AE"."Compra"
      LIMIT 1
    ';

      $con = ConexionModel::searchById($conexion['idConexion']);

      $pdoModel = new ConexionesPDOModel(
        $con->getBase(),
        $con->getUsuario(),
        $con->getPassword()
      );

      $pdo = PDOController::getInstance($pdoModel);

      $stm = $pdo->prepare($qry);

      if (!$stm->execute()) {
        $errorInfo = $stm->errorInfo();
        throw new \Error(
          sprintf('Error en la consulta SQL: %s', $errorInfo[2])
        );
      }

      $response = $stm->fetch(\PDO::FETCH_ASSOC);

      if ($response) {
        $conexiones[] = AccesoUsuarioEntity::fromAssocc($conexion);
      }
    }

    return $conexiones;
  }
}
