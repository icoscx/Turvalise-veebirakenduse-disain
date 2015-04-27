<?php
class User{
     public $_ID = null;
     function __construct($id) {
         $this->_ID = $id;
    }               
                
     function setID($id) {
         $this->_ID = $id;
     }       
        
     function getID() {           
         return $this->_ID;            
     }              
}
?>

