<?php

namespace App\Shared\DBManager\Model;

class MainPDOModel implements PDOInterface
{

  private string $HOST;
  private string $NAME;
  private string $USER;
  private string $PASSWORD;

  public function __construct()
  {
    $this->HOST = $_ENV['DB_HOST'];
    $this->NAME = $_ENV['DB_NAME'];
    $this->USER = $_ENV['DB_USERNAME'];
    $this->PASSWORD = $_ENV['DB_PASSWORD'];
  }

  public function getUser(): string
  {

    return $this->USER;
  }

  public function getPassword(): string
  {

    return $this->PASSWORD;
  }

  function getDsn(): string
  {
    $dsn = "pgsql:host=" . $this->HOST .
      ";dbname=" . $this->NAME;

    return $dsn;
  }
}
