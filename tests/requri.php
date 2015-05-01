<?php

$allowedQueries = Array(
    1 => '',
    2 => '',
    3 => '',
    4 => '/tests/requri.php',
    5 => '',
    6 => '',
);
foreach ($allowedQueries as $key => $value) {
    if(strcmp($allowedQueries[$key], $_SERVER['REQUEST_URI']) || strcmp($allowedQueries[$key], $_SERVER['REQUEST_URI'] + '/')){
        echo 'ok';
        break;
    }
}


?>