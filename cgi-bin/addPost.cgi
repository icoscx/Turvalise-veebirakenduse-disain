#!"C:/Program Files (x86)/Ampps/php/php-cgi.exe" -q

<?php

//accept ajax requests only
if(!isset($_SERVER['HTTP_X_REQUESTED_WITH']) AND strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) != 'xmlhttprequest') {
    exit("Bad query [no ajax]");
}else{
    require('../BackEnd/SessionCheck.php');
}

if(checkSession() !== "200" && checkSession() === "403"){
    exit();
}else{
    require('../BackEnd/DB.php');
    $data = file_get_contents("php://input");
}

$data = json_decode($data, true);

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