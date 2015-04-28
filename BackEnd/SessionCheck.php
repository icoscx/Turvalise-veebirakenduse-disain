<?php

function checkSession(){

    session_start();
    $username =  $_SESSION['UName'];
    $ip = $_SESSION['UIp'];
    $useragent = $_SESSION['UAgent'];

    if($_SESSION['UIp'] == $_SERVER['REMOTE_ADDR'] &&
       $_SESSION['UAgent'] == $_SERVER['HTTP_USER_AGENT'] &&
       $_SESSION['Id'] == session_id()
       ){
        return "200";
    }else{
        session_unset();
        $_SESSION=array();
        session_destroy();
        return "403";
    }

}

function endSession(){

    session_start();
    session_unset();
    $_SESSION=array();
    session_destroy();
    return 0;
}

?>