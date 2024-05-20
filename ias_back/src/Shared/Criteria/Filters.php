<?php

namespace App\Shared\Criteria;

class Filters
{

  private array $value;

  /**
   * @param Filter[] $value
   */
  public function __construct(Filter ...$value)
  {

    $this->value = $value;
  }
}
