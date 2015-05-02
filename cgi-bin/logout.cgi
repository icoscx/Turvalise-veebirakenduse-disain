#!"C:/Program Files (x86)/Ampps/php/php-cgi.exe" -q

<?php

require('../BackEnd/SecurityManager.php');
//null = post
$expectedGet = 'logout';
$security = new SecurityManager($expectedGet);
$security->validateSession();
//Post: if true = strict check, false = allow whitespace and -.!@
$security->initializeSecurity(true);

if(isset($_GET[$expectedGet])){

    if($security->endSession()){
        print_r(0);
    }
}

?>