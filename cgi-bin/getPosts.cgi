#!"C:/Program Files (x86)/Ampps/php/php-cgi.exe" -q

<?php

require('../BackEnd/SessionCheck.php');

if(isset($_GET['listItems'])){

    echo checkSession();

}

if(isset($_GET['logout'])){

    echo endSession();
}

//echo $_SESSION['UName'];

?>