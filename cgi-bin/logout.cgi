#!"C:/Program Files (x86)/Ampps/php/php-cgi.exe" -q

<?php

//accept ajax requests only
if(!isset($_SERVER['HTTP_X_REQUESTED_WITH']) AND strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) != 'xmlhttprequest') {
    exit("Bad query [no ajax]");
}else{
    require('../BackEnd/SessionCheck.php');
}

if(checkSession() !== "200" && checkSession() === "403"){
    exit("Bad query [no sess]");
}else{
    require('../BackEnd/DB.php');
}

if(isset($_GET['logout'])){

    print_r(endSession());
}

?>