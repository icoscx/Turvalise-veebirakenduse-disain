#!"C:/Program Files (x86)/Ampps/php/php-cgi.exe" -q
<?php

//$mysqli = new mysqli("localhost", "root", "mysql", "kodu");

if(isset($_GET['list'])){
    $mysqli = new mysqli("localhost", "root", "mysql", "kodu");
    if($_GET['list'] == 'case'){
        $query = "SELECT * FROM complaints ORDER BY complaint_id DESC";
    }elseif($_GET['list'] == 'occ'){
        $query = "SELECT * FROM complaints ORDER BY date DESC";
    }elseif($_GET['list'] == 'act'){
        $query = "SELECT * FROM complaints ORDER BY type ASC";
    }elseif($_GET['list'] == 'user'){
        $query = "SELECT * FROM complaints ORDER BY username ASC";
    }else{
        $query = "SELECT * FROM complaints";
    }
    if ($result = $mysqli->query($query)) {
       	while ($row = $result->fetch_assoc()) {
    		$rows[] = $row;
       }

    }

    //print_r($rows);

    $encode = json_encode($rows);

    print_r($encode);
}

if(isset($_GET['listitem'])){
    $mysqli = new mysqli("localhost", "root", "mysql", "kodu");
    $query = "SELECT * FROM complaints WHERE complaint_id='".$_GET['listitem']."'";
    if ($result = $mysqli->query($query)) {
       	while ($row = $result->fetch_assoc()) {
    		$rows[] = $row;
       }

    }

    //print_r($rows);

    $encode = json_encode($rows);

    print_r($encode);
}

if(isset($_GET['search'])){
    $mysqli = new mysqli("localhost", "root", "mysql", "kodu");
    $query = "SELECT * FROM complaints WHERE complaint_id LIKE '".$_GET['search']."' OR type LIKE '".$_GET['search']."' OR date LIKE '".$_GET['search']."'";
    if ($result = $mysqli->query($query)) {
       	while ($row = $result->fetch_assoc()) {
    		$rows[] = $row;
       }

    }

    //print_r($rows);

    $encode = json_encode($rows);

    print_r($encode);
}

?>