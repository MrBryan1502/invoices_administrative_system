<?php

namespace App\Shared\Criteria;

use App\Shared\Criteria\Operator;

class FilterOperator
{

  private array $operators;
  private string $value;

  /**
   * Use a Operator constants to `$value` param
   * @param string $value `Operator::EQUAL`, `Operator::NOT_EQUAL`...
   */
  public function __construct(string $value)
  {

    $this->operators = Operator::getConstants();
    $this->isValidFilterOperator($value);
    $this->value = $value;
  }

  public function isValidFilterOperator(string $value)
  {
    if (!in_array($value, $this->operators)) {

      throw new \Error(
        sprintf(
          'Este operador <%s> no es un operador valido',
          $value
        )
      );
    }
  }

  public function __value(): string
  {

    return $this->value;
  }
}
