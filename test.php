<?php
$password = "test";
$saltedhash = password_hash($password, PASSWORD_BCRYPT);
echo $saltedhash;
?>