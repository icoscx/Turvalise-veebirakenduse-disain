#!"C:/Program Files (x86)/Ampps/php/php-cgi.exe" -q

<?php

require('../BackEnd/SecurityManager.php');
//null = post
$expectedGet = 'logout';
$expectedLength = 65;
$security = new SecurityManager($expectedGet,$expectedLength);
//Post: if true = strict check, false = allow whitespace and -.!@
$security->initializeSecurity(true);
//IDEAALSELT peaks olema session check ennem, aga kuna me tahame tuvastada erinevaid
//ryndeid, siis checkime sessi peale inputi
$security->validateSession();

if(isset($_GET[$expectedGet])){

    if($security->endSession()){
        print_r(0);
    }
}

?>