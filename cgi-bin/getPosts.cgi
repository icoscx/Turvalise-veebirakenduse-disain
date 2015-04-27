#!"C:/Program Files (x86)/Ampps/php/php-cgi.exe" -q

<?php

if(isset($_GET['listItems'])){

    session_start();
    $username =  $_SESSION['UName'];
    $ip = $_SESSION['UIp'];
    $useragent = $_SESSION['UAgent'];

    if($_SESSION['UIp'] == $_SERVER['REMOTE_ADDR'] && $_SESSION['UAgent'] == $_SERVER['HTTP_USER_AGENT']){
        echo "all ok";
    }else{
        session_unset();
        $_SESSION=array();
        session_destroy();
        exit("403");
    }
}

//echo $_SESSION['UName'];

?>