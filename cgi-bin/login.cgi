#!"C:/Program Files (x86)/Ampps/php/php-cgi.exe" -q

<?php

//accept ajax requests only
if(!isset($_SERVER['HTTP_X_REQUESTED_WITH']) AND strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) != 'xmlhttprequest') {
        exit();
}else{
    require('../BackEnd/DB.php');
    $data = file_get_contents("php://input");
}

$data = json_decode($data, true);

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
                "id" => $check[0]['id']
           );
        }else{
            exit("Invalid password");
        }
    }

if(isset($allowSess["username"], $allowSess["id"])){
        require('../BackEnd/User.php');
        $user = new User($allowSess["id"]);
        session_start();
        $UserID = $user->_ID;
        $_SESSION['UserID'] = $UserID;
        exit("1");
    }
?>