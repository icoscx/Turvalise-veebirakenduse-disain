<?php 

require('../BackEnd/SecurityIDS.php');

$ids = new IPS();

$entry = $ids->buildLogEntry();
$ids->write($entry);


?>