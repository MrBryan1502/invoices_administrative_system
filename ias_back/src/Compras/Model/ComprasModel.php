<?php

namespace App\Compras\Model;

use App\Compras\Conexion\Model\ConexionModel;
use App\Compras\Entity\ComprasEntity;
use App\Shared\DBManager\Controller\PDOController;
use App\Shared\DBManager\Model\ConexionesPDOModel;

class ComprasModel
{

  public function searchAllByIdConexion(int $idConexion): array
  {

    $qry = '
      SELECT
        c."idCompra",
        c."idCompraStatus",
        cs."StatusES",
        c."Total",
        c."idFormaPago",
        fp."FormaPagoES",
        c."FechaCreacion",
        c."ReqFactura",
        c."CompraFacturada",
        c."idVisitante",
        v."Nombre",
        v."Email"
      FROM "AE"."Compra" as c
      INNER JOIN "AE"."CompraStatus" as cs ON (
        c."idCompraStatus" = cs."idCompraStatus"
      ) INNER JOIN "AE"."FormaPago" as fp ON (
        c."idFormaPago" = fp."idFormaPago"
      ) INNER JOIN "AE"."Visitante" as v ON (
        c."idVisitante" = v."idVisitante"
      ) LIMIT 10
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

    $response = $stm->fetchAll(\PDO::FETCH_ASSOC);

    foreach ($response as $compra) {
      $compras[] = ComprasEntity::fromAssoc($compra);
    }

    return $compras;
  }

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
