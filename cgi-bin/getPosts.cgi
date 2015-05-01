#!"C:/Program Files (x86)/Ampps/php/php-cgi.exe" -q

<?php
//accept ajax requests only


if(isset($_GET['listItems'])){

    $query = "SELECT * FROM posts";
    $query = $db->prepare($query);
        try{
            $query->execute();
        } catch (PDOException $e) {
            exit($e);
        } finally {
            if(!empty($check = $query->fetchAll(PDO::FETCH_ASSOC))){
                $encode = json_encode($check);
                print_r($encode);
            }else{
                exit("No data found");
            }
        }
}

if(isset($_GET['item'])){
    $itemId = $_GET['item'];
    $query = "SELECT * FROM posts WHERE id= :id";
    $query = $db->prepare($query);
        try{
            $query->execute(array(
                  ":id" => $itemId
            ));
        } catch (PDOException $e) {
            exit($e);
        } finally {
            if(!empty($check = $query->fetchAll(PDO::FETCH_ASSOC))){
                $encode = json_encode($check);
                print_r($encode);
            }else{
                exit("No data found");
            }
        }
    }

?>