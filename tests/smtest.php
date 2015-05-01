<?php

require('../BackEnd/SecurityCenter.php');

$sc = new SecurityCenter();

if($sc->requestMethodCheck('q')){
    echo "ok";
}
?>