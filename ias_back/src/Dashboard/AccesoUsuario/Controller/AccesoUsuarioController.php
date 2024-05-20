<?php

namespace App\Dashboard\AccesoUsuario\Controller;

use App\Auth\Login\Entity\UserEntity;
use App\Dashboard\AccesoUsuario\Model\AccesoUsuarioModel;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class AccesoUsuarioController extends AbstractController
{

  private AccesoUsuarioModel $conexionModel;
  private $jwt_secret;

  public function __construct()
  {
    $this->conexionModel = new AccesoUsuarioModel();
    $this->jwt_secret = $_ENV['SECRET'];
  }

  /**
   * @Route("/api/conexiones", name="api_conexiones", methods={"GET"})
   */
  public function conexiones(Request $request): JsonResponse
  {

    $authorizationHeader = $request->headers->get('Authorization');
    $token = substr($authorizationHeader, 7);

    try {

      $token_decoded = JWT::decode($token, new Key($this->jwt_secret, 'HS256'));
    } catch (\Throwable $th) {

      $error_message = 'Error: ' . $th->getMessage();

      if ($th->getMessage() === 'Signature verification failed') {

        $error_message = 'Sesión invalida';
      }
      if ($th->getMessage() === 'Expired token') {

        $error_message = 'La sesión expiro';
      }

      return new JsonResponse([
        'status' => false,
        'data' => $error_message
      ], 401);
    }

    $user = UserEntity::fromStdClass($token_decoded->user);

    $conexiones = $this->conexionModel->searchByIdUsuario($user->getIdUsuario());

    foreach ($conexiones as $conexion) {
      $conexionesAssoc[] = [
        'idConexion' => $conexion->getIdConexion(),
        'Base' => $this->decodeBaseToLabel($conexion->getBase())
      ];
    }

    return $this->json($conexionesAssoc, 200);
  }

  private function decodeBaseToLabel(string $baseB64): string
  {

    $base_decoded = base64_decode($baseB64);
    $formated_base = str_replace('_', ' ', $base_decoded);

    return ucwords(strtolower($formated_base));
  }
}
