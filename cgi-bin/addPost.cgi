#!"C:/Program Files (x86)/Ampps/php/php-cgi.exe" -q

<?php

require('../BackEnd/SecurityManager.php');
//null = post
$security = new SecurityManager(null);
$security->validateSession();
//Post: if true = strict check, false = allow whitespace and -.!@
$security->initializeSecurity(false);
$data = $security->getVerifiedInput();

require('../BackEnd/DB.php');

if(isset($data["sdescription"], $data["description"])){

    date_default_timezone_set('EET');
    $sdescription = $data["sdescription"];
    $description = $data["description"];
    $date = date("d.m.Y");

    //escape SQL injection with prebuilt q
    $query = "INSERT INTO posts(date, sdescription, description) VALUES(:date, :sdescription, :description)";
    $query = $db->prepare($query);
        try{
            $query->execute(array(
                    ":date" => $date,
                    ":sdescription" => $sdescription,
                    ":description" => $description
                ));
        } catch (PDOException $e){
            exit($e);
        } finally {
            $error = $query->errorInfo();
            print_r(1);
            exit($error[2]);
        }


}

?>