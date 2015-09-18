<?php

namespace gohanman\phphof;

/**
  @class Tuple

  Simple container class to represent
  individual entries in an associative
  array.
*/
class Tuple
{
    private $key;
    private $value;

    public function __construct($key, $value)
    {
        $this->key = $key;
        $this->value = $value;
    }

    public function key()
    {
        return $this->key;
    }

    public function value()
    {
        return $this->value;
    }
}

