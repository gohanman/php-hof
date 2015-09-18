<?php

namespace gohanman\phphof;

/**
  @class HOF

  Higher-order functions that
  can operate on associative arrays

  public functions accept:
  - Numerically keyed arrays
  - Associative arrays
  - Traversable objects

  Callbacks will receive a Tuple object with public
  methods key() and value().

  However, return values are arrays. Traversables
  will become associative arrays with its keys
  and values.
*/
class HOF
{
    /**
      @param $array iterable value
      @param $callable user-defined function
      @return Tuple object
    */
    public static function map($array, $callable)
    {
        $transform = self::toTuple($array);
        $map = array_map($callable, $transform);
        return self::fromTuple($map);
    }

    /**
      @param $array iterable value
      @param $callable user-defined function
      @param $initial_value [optional, default null]
      @return [mixed] whatever you want
    */
    public static function fold($array, $callable, $initial_value=null)
    {
        $transform = self::toTuple($array);
        $fold = array_reduce($transform, $callable, $initial_value);
        return $fold;
    }

    /**
      @param $array iterable value
      @param $callable user-defined function
      @return [boolean]
    */
    public static function filter($array, $callable)
    {
        $transform = self::toTuple($array);
        $filter = array_filter($transform, $callable);
        return self::fromTuple($filter);
    }

    /**
      Convert keyed array to list of tuples
    */
    private static function toTuple($array)
    {
        if (!is_array($array) && !$array instanceof \Traversable) {
            throw new \Exception('Cannot convert non-array value to list of tuples');
        }
        if (!is_array($array)) {
            $array = self::traversableToArray($array);
        }
        return array_map(function ($key) use ($array) {
            return new Tuple($key, $array[$key]);
        }, array_keys($array));
    }

    private static function traversableToArray($obj)
    {
        $ret = array();
        // ugh. foreach...
        foreach ($obj as $key => $val) {
            $ret[$key] = $val;
        }

        return $ret;
    }

    /**
      Convert list of tuples to keyed array
    */
    private static function fromTuple($array)
    {
        if (!is_array($array)) {
            throw new \Exception('Cannot convert non-array value to back to associative array');
        }
        return array_reduce($array, function($carry, $item) {
            $carry[$item->key()] = $item->value();
            return $carry;
        }, array());
    }
}

