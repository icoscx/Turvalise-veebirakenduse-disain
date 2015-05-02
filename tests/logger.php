<?php 

require('../BackEnd/SecurityIDS.php');

$ids = new IDS();

$entry = $ids->buildLogEntry();
$ids->write($entry);


?>