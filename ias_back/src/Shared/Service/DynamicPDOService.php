<?php

namespace App\Shared\Service;

class DynamicPDOService
{

  private $pdo;

  public function __construct(
    string $dbname,
    string $username,
    string $password
  ) {

    $host = $_ENV['DB_HOST'];
    $dbname = $_ENV['DB_NAME'];
    $username = $_ENV['DB_USERNAME'];
    $password = $_ENV['DB_PASSWORD'];

    $dsn = "pgsql:host=$host;dbname=$dbname";

    $this->pdo = new \PDO($dsn, $username, $password);
    $this->pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
  }

  public function getPdo()
  {
    return $this->pdo;
  }

  public function __destruct()
  {

    $this->pdo = null;
  }
}
