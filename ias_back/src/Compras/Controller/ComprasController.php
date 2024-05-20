<?php

namespace App\Compras\Controller;

use App\Compras\Model\ComprasModel;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class ComprasController extends AbstractController
{

  private ComprasModel $comprasModel;

  public function __construct()
  {
    $this->comprasModel = new ComprasModel();
  }

  /**
   * @Route("/api/compras/{idConexion}", name="api_compras_idConexion", methods={"GET"})
   */
  public function comprasByIdConexion(int $idConexion): JsonResponse
  {

    try {

      $this->comprasModel->findOne($idConexion);
    } catch (\Throwable $th) {

      return $this->json([
        'error' => $th->getMessage(),
        'code' => $th->getCode()
      ], 500);
    }

    $compras = $this->comprasModel->searchAllByIdConexion($idConexion);

    return $this->json($compras, 200);
  }
}
