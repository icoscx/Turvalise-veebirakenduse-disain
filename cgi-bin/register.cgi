#!"C:/Program Files (x86)/Ampps/php/php-cgi.exe" -q

<?php
//accept ajax requests only
if(!isset($_SERVER['HTTP_X_REQUESTED_WITH']) AND strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) != 'xmlhttprequest') {
        die();
}else{
    require('../BackEnd/DB.php');
    $data = file_get_contents("php://input");
}

$data = json_decode($data, true);

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
            print_r(1);
            exit($error[2]);
        }


}

?>