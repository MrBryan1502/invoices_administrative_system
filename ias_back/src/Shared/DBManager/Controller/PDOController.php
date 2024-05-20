<?php

namespace App\Shared\DBManager\Controller;

use App\Shared\DBManager\Model\PDOInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class PDOController extends AbstractController
{

  private static $instance = null;

  public function __construct()
  {
  }

  public static function getInstance(PDOInterface $model)
  {

    self::$instance = null;

    if (self::$instance === null) {
      self::$instance = new \PDO(
        $model->getDsn(),
        $model->getUser(),
        $model->getPassword()
      );
    }

    return self::$instance;
  }
}
