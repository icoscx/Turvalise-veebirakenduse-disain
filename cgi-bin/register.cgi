#!"C:/Program Files (x86)/Ampps/php/php-cgi.exe" -q
<?php

    $mysqli = new mysqli("localhost", "root", "mysql", "kodu");

    $data = file_get_contents("php://input");
    $data = json_decode($data, true);
    //print_r($data);
    if(isset($data['username'], $data['password'], $data['email'])){
        $query = "SELECT * FROM users WHERE username='".$data[username]."'";
        if ($result = $mysqli->query($query)) {
           	while ($row = $result->fetch_assoc()) {
                if($data['username'] === $row['username']){
        			print 0;
        			break;
        		}
           }
           if($row['username'] === NULL){
        	    $query = "INSERT INTO `users`(`username`, `password`, `email`) VALUES ('".$data['username']."','".$data['password']."','".$data['email']."')";
        	    $mysqli->query($query);
        		printf ($mysqli->insert_id);
           }

        }
    }

?>