#!"C:/Program Files (x86)/Ampps/php/php-cgi.exe" -q

<?php

require('../BackEnd/SecurityManager.php');
//null = post
$security = new SecurityManager(null, null);
//Post: if true = strict check, false = allow whitespace and -.!@
$security->initializeSecurity(false);
$data = $security->getVerifiedInput();

require('../BackEnd/DB.php');

//check input
if(isset($data["username"], $data["password"], $data["email"])){
    $username = $data["username"];
    $password = $data["password"];
    $email = $data["email"];
    $saltedhash = password_hash($password, PASSWORD_BCRYPT);
    //escape SQL injection with prebuilt q
    $query = "INSERT INTO users(username, email, saltedhash) VALUES(:username, :email, :saltedhash)";
    $query = $db->prepare($query);
        try{
            $query->execute(array(
                    ":username" => $username,
                    ":email" => $email,
                    ":saltedhash" => $saltedhash
                ));
        } catch (PDOException $e){
            exit($e);
        } finally {
            $error = $query->errorInfo();
            print_r(200);
            exit($error[2]);
        }


}

?>