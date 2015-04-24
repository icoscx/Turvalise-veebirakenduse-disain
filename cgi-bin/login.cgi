#!"C:/Program Files (x86)/Ampps/php/php-cgi.exe" -q
<?php

$mysqli = new mysqli("localhost", "root", "mysql", "kodu");

$data = file_get_contents("php://input");
$data = json_decode($data, true);

if(isset($data['username'], $data['password'])){
   $query = "SELECT * FROM users WHERE username='".$data[username]."'";

   if ($result = $mysqli->query($query)) {
   	while ($row = $result->fetch_assoc()) {
           if($data['password'] === $row['password']){
   			print 200;
   		}else{
   		    print 407;
   		}
     }
   }

}


