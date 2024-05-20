<?php

namespace App\Shared\DBManager\Model;

class ConexionesPDOModel implements PDOInterface
{

  private string $HOST;
  private string $NAME;
  private string $USER;
  private string $PASSWORD;

  public function __construct(
    string $Base,
    string $Usuario,
    string $Password
  ) {
    $this->HOST = $_ENV['DB_HOST'];
    $this->NAME = $Base;
    $this->USER = $Usuario;
    $this->PASSWORD = $Password;
  }

  public function getUser(): string
  {

    return $this->USER;
  }

  public function getPassword(): string
  {

    return $this->PASSWORD;
  }

  public function getDsn(): string
  {
    $dsn = "pgsql:host=" . $this->HOST .
      ";dbname=" . $this->NAME;

    return $dsn;
  }
}
