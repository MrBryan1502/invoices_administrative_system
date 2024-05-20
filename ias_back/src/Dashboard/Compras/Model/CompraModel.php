<?php

namespace App\Dashboard\Compras\Model;

use App\Dashboard\Conexion\ConexionModel;
use App\Shared\DBManager\Controller\PDOController;
use App\Shared\DBManager\Model\ConexionesPDOModel;

class CompraModel
{

  public function findOne($idConexion)
  {

    $qry = '
      SELECT *
      FROM "AE"."Compra"
      LIMIT 1
    ';

    $conexion = ConexionModel::searchById($idConexion);

    $pdoModel = new ConexionesPDOModel(
      $conexion->getBase(),
      $conexion->getUsuario(),
      $conexion->getPassword()
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

    if (!$response) {
      throw new \Error(
        sprintf('No se encontraron compras en la BD')
      );
    }
  }
}
