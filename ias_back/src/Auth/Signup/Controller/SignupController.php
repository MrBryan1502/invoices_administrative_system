<?php

namespace App\Auth\Signup\Controller;

use App\Auth\Shared\Model\UsuarioModel;
use App\Auth\Signup\Entity\Signup\UserSignupEntity;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;

class SignupController extends AbstractController
{

  private UsuarioModel $usuario_model;

  public function __construct()
  {

    $this->usuario_model = new UsuarioModel();
  }

  /**
   * @Route("/api/signup", name="api_signup", methods={"POST"})
   */
  public function signup(
    Request $request,
    UserPasswordHasherInterface $uphi
  ): JsonResponse {

    $content = json_decode($request->getContent(), true);

    $user_signup = UserSignupEntity::fromAssoc($content);

    $found_usuario = $this->usuario_model->searchUserByEmail($user_signup->getEmail());

    if ($found_usuario) {

      return $this->json([
        'error' => sprintf(
          'El Usuario <%s> ya existe en la BD',
          $user_signup->getEmail()
        ),
        'code' => 0
      ], 500);
    }

    $hashedPassword = $uphi->hashPassword($user_signup, $user_signup->getPassword());

    try {

      $this->usuario_model->save(
        $user_signup->getNombreUsuario(),
        $user_signup->getEmail(),
        $hashedPassword
      );
    } catch (\Throwable $th) {

      return $this->json([
        'error' => $th->getMessage(),
        'code' => $th->getCode()
      ], 500);
    }

    return $this->json([
      'message' => 'Success'
    ], 200);
  }
}
