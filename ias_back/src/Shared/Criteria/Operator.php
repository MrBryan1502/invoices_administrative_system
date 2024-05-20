<?php

namespace App\Shared\Criteria;

class Operator
{

  public const EQUAL = "=";
  public const NOT_EQUAL = "!=";
  public const GT = ">";
  public const LT = "<";
  public const CONTAINS = "CONTAINS";
  public const NOT_CONTAINS = "NOT_CONTAINS";

  public static function getConstants()
  {

    $reflect = new \ReflectionClass(__CLASS__);
    return $reflect->getConstants();
  }
}
