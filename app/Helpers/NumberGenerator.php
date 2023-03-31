<?php

namespace App\Helpers;

class NumberGenerator
{
  public function numberGenerator(int $min = 0, int $max = 1000): int
  {
    return mt_rand($min, $max);
  }
}
