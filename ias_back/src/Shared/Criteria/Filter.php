<?php

namespace App\Shared\Criteria;

class Filter
{

  private string $field;
  private FilterOperator $operator;
  private string $value;

  /**
   * Use a Operator constants to `$operator` param
   * @param FilterOperator $operator `Operator::EQUAL`, `Operator::NOT_EQUAL`...
   */
  public function __construct(
    string $field,
    FilterOperator $operator,
    string $value
  ) {

    $this->field = $field;
    $this->operator = $operator;
    $this->value = $value;
  }
}
