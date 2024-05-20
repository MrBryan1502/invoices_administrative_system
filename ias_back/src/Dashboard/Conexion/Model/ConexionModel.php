<?php

namespace App\Dashboard\Conexion;

use App\Dashboard\Conexion\Entity\ConexionEntity;
use App\Shared\DBManager\Controller\PDOController;
use App\Shared\DBManager\Model\MainPDOModel;

class ConexionModel
{

  public static function searchById(int $idConexion): ConexionEntity
  {

    $qry = '
      SELECT
        "idConexion",
        "Base",
        "Usuario",
        "Password"
      FROM
        "SAS"."Conexion"
      WHERE
        "idConexion" = :idConexion;
    ';

    $pdo = PDOController::getInstance(new MainPDOModel());

    $stm = $pdo->prepare($qry);

    $stm->bindParam(':idConexion', $idConexion);

    if (!$stm->execute()) {
      $errorInfo = $stm->errorInfo();
      throw new \Error(
        sprintf('Error en la consulta SQL: %s', $errorInfo[2])
      );
    }

    $response = $stm->fetch(\PDO::FETCH_ASSOC);

    $conexion = ConexionEntity::fromAssocDataEncoded($response);

    return $conexion;
  }
}
