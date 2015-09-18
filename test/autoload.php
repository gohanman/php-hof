<?php
/** simple bootstrap for phpunit **/

spl_autoload_register(function ($class) {
    if ($class == 'gohanman\\phphof\\HOF') {
        include(__DIR__ . '/../src/HOF.php');
    } elseif ($class == 'gohanman\\phphof\\Tuple') {
        include(__DIR__ . '/../src/Tuple.php');
    }
});

