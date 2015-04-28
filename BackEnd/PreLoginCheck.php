<?php

function pre_conditions(){
    //accept ajax requests only
    if(!isset($_SERVER['HTTP_X_REQUESTED_WITH']) AND strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) != 'xmlhttprequest') {
        return "Bad query [no ajax]";
    }
    return true;
}
?>