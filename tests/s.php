<?php 

$ip = "1.1.1.1.";
$count = 4;
$ip2 = "2.2.2.2";
$count2=5;

$line = Array(
	$ip => $count,
	$ip2 => $count2
);


if(array_key_exists($ip,$line)){
	
	echo 'yes';
}

print_r($line);
?>