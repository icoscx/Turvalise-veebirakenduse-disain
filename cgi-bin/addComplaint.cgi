#!"C:/Program Files (x86)/Ampps/php/php-cgi.exe" -q
<?php

    $mysqli = new mysqli("localhost", "root", "mysql", "kodu");

    $data = file_get_contents("php://input");
    $data = json_decode($data, true);
    //print_r($data);

$sumDate = $data['dd'].".".$data['mm'].".".$data['yyyy'];
$sumDatee = $data['yyyy']."-".$data['mm']."-".$data['dd'];
//echo $sumDate;
if(isset($data['fname'], $data['lname'], $data['address'], $data['dd'],
    $data['mm'], $data['yyyy'], $data['type'], $data['description']
    )){
        //print 'All Values set!!!';
		$query = "INSERT INTO `complaints`(`complainer_fname`, `complainer_lname`, `description`, `type`,  `complainer_address`,  `time`, `username`, `date`) VALUES
		('".$data['fname']."','".$data['lname']."','".$data['description']."','".$data['type']."','".$data['address']."','".$sumDate."', '".$data['username']."', '".$sumDatee."')";
		$mysqli->query($query);
		printf ($mysqli->insert_id);
    }else{
        print 0;
    }


?>