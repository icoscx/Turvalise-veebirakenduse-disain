<?php

$user = 'root';
$pass = 'mysql';
//charset peab olema utf8 v2ltimaks special char injecte
$db = new PDO('mysql:host=localhost;dbname=kodu;charset=utf8', $user, $pass);

?>