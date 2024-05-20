<?php

namespace App\Auth\Login\Controller;

use App\Auth\Login\Entity\UserLoginEntity;
use App\Auth\Shared\Model\UsuarioModel;
use Firebase\JWT\JWT;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;

class LoginController extends AbstractController
{

  private UsuarioModel $usuario_model;
  private $jwt_secret;

  public function __construct()
  {

    $this->usuario_model = new UsuarioModel();
    $this->jwt_secret = $_ENV['SECRET'];
  }

  /**
   * @Route("/api/login", name="api_login", methods={"POST"})
   */
  public function loginUser(
    Request $request,
    UserPasswordHasherInterface $uphi
  ): JsonResponse {

    $content = json_decode($request->getContent(), true);

    try {

      $user = UserLoginEntity::fromAssoc($content);
      $finded_user = $this->usuario_model->findByEmail($user->getEmail());
    } catch (\Throwable $th) {

      return $this->json([
        'error' => $th->getMessage(),
        'code' => $th->getCode()
      ], 500);
    }

    $passwordIsValid = $uphi->isPasswordValid($finded_user, $user->getPassword());

    if (!$passwordIsValid) {

      return $this->json([
        'error' => 'La contraseña es incorrecta',
        'code' => 401
      ], 401);
    }

    $user = $finded_user->toAssoc();

    $jwt_payload = [
      'user' => $user,
      'exp' => time() + 60
    ];

    $jwt = JWT::encode($jwt_payload, $this->jwt_secret, 'HS256');

    return $this->json([
      'message' => 'Success',
      'token' => $jwt
    ], 200);
  }
}
