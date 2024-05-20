<?php

namespace App\Shared\DBManager\Model;

interface PDOInterface
{
  public function getDsn(): string;
  public function getUser(): string;
  public function getPassword(): string;
}
