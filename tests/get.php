<?php
$parameter = 'list';
$queryRegex = "/^[a-zA-Z0-9]+$/";
if((isset($_GET[$parameter])) && strlen($_GET[$parameter]) > 0 && (preg_match($queryRegex, $_GET[$parameter]))){
    echo 'list set';
    echo $_GET['list'];
    
}

?>