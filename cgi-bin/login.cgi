#!"C:/Program Files (x86)/Ampps/php/php-cgi.exe" -q

<?php

require('../BackEnd/SecurityManager.php');
//null = post
$security = new SecurityManager(null, null);
//Post: if true = strict check, false = allow whitespace and -.!@
$security->initializeSecurity(true);
$data = $security->getVerifiedInput();

require('../BackEnd/DB.php');

//check input
if(isset($data["username"], $data["password"])){

    $username = $data["username"];
    $password = $data["password"];
    $query = "SELECT * FROM users WHERE username= :username";
    $query = $db->prepare($query);
        try{
            $query->execute(array(
                     ":username" => $username
                     ));
        } catch (PDOException $e) {
            exit($e);
        } finally {
            if(!empty($check = $query->fetchAll(PDO::FETCH_ASSOC))){
                $getSaltedHash = $check[0]['saltedhash'];
            }else{
                exit("Invalid username");
            }
        }
        if (password_verify($password, $getSaltedHash)) {
           $allowSess = array(
                "username" => $username,
                "uid" => $check[0]['id']
           );
        }else{
            exit("Invalid password");
        }
    }
//Ehitame sessi
if(isset($allowSess["username"], $allowSess["uid"])){
    
    $security->startSession($allowSess['username']);
    
    exit($allowSess["username"]);
}
?>