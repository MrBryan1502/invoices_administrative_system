<?php

namespace App\Shared;

class Criteria
{

  private array $filters;

  public function __construct(
    array $filters
  ) {

    $this->filters = $filters;
  }
}
