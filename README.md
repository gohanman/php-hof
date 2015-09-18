# php-hof
PHP wrapper for higher order functions. This package
provides map, fold, and filter methods that:
* Have consistent parameter order
* Accept associative arrays and expose both keys and
  values to the callback function

All inputs - numerically keyed arrays, associative arrays,
and traversable objects - are converted to a list of Tuple
objects with public methods key() and value(). Callback
functions operate on this list of Tuples.

HOF::map($array, $callable)
* Is equivalent to array_map()
* Callback should return a Tuple object

HOF::filter($array, $callable)
* Is equivalent to array_filter
* Callback should return boolean true or false

HOF::fold($array, $callable, $initial_value=null)
* Is equivalent to array_reduce
* Callback can return any type of value

Examples:
```php
$arr = array(
    'one' => 1,
    'two' => 2,
    'three' => 3,
    'four' => 4,
);

HOF::map($arr, 
    function ($item) {
        return new Tuple($item->key(), strlen($item->key()) + $item->value());
    });
/** result:
array(
    'one' => 4,
    'two' => 5,
    'three' => 8,
    'four' => 8,
);
*/

HOF::filter($arr,
    function ($item) {
        if (strlen($item->key()) == 3 && $item->value() % 2 == 0) {
            return true;
        } else {
            return false;
        }
    });
/** result:
array(
    'two' => 2,
);
*/

HOF::fold($arr,
    function ($carry, $item) {
        return $carry . $item->key() . $item->value();
    });
/**
result:
"one1two2three3four4"
*/
```
