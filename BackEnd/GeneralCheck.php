<?php

function conditions(){
    //accept ajax requests only
    if(!isset($_SERVER['HTTP_X_REQUESTED_WITH']) AND strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) != 'xmlhttprequest') {
        return "Bad query [no ajax]";
    }else

    if(checkSession() !== "200" && checkSession() === "403"){
        return "Bad query [no sess]";
    }

    return true;
}
?>