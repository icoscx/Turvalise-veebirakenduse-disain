<?php

class FunLib{

    public static $urlRegex = "/(^|[\s.:;?\-\]<\(])(https?:\/\/[-\w;\/?:@&=+$\|\_.!~*\|'()\[\]%#,☺]+[\w\/#](\(\))?)(?=$|[\s',\|\(\).:;?\-\[\]>\)])/";
    
    
    public function requestHeaderCheck(){
    //accept ajax requests only
        //clean field if malicious
        if(isset($_SERVER['HTTP_REFERER'])){
            if((preg_match($urlRegex, $_SERVER['HTTP_REFERER'])) !== 1){
                //log
                $_SERVER['HTTP_REFERER'] = null;
            }
        }
        //we use jquery and ajax, therefore this is required
        if(!isset($_SERVER['HTTP_X_REQUESTED_WITH']) AND strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) != 'xmlhttprequest') {
            //log
            return false;
        
        }
        
        
        return true;
    }
    
    /**
     * Check if session is valid
     * @return boolean true if is
     */
    public function checkSession(){

        session_start();
        $username =  $_SESSION['UName'];
        $ip = $_SESSION['UIp'];
        $useragent = $_SESSION['UAgent'];

        if($_SESSION['UIp'] == $_SERVER['REMOTE_ADDR'] &&
           $_SESSION['UAgent'] == $_SERVER['HTTP_USER_AGENT'] &&
           $_SESSION['Id'] == session_id()
           ){
            return true;
        }else{
            session_unset();
            $_SESSION=array();
            session_destroy();
            return false;
        }

    }
    
    /**
     * Terminates the SS session from memory
     * @return boolean true if ended
     */
    public function endSession(){
        
        try {
            session_start();
            session_unset();
            $_SESSION=array();
            session_destroy();
        } catch (Exception $ex) {
            exit("Internal error");
        }

        return true;
        
    }
    
    /**
     * 
     * @param type $string json encoded string
     * @return true if matches, false if error
     */
    public function jsonCheck($string){
        if(!empty($string) && is_string($string) && !preg_match('/[^,:{}\\[\\]0-9.\\-+Eaeflnr-u \\n\\r\\t]/',
        preg_replace('/"(\\.|[^"\\\\])*"/', '', $string))){
            return true;
        }
        return false;
    }
    
    /**
     * 
     * @param type $arr array to validate
     * @return boolean true if array matches regex
     */
    public function checkArray($arr){
        
        $filterdReverse = Array();
        $filterdArray = Array();
        $filterdReverse = preg_grep("/^[a-zA-Z]+$/", array_keys($arr), PREG_GREP_INVERT);
        
        foreach ($filterdArr as $value => $key) {      
            $filterdArr[$value];
            //send to log
        }
        
        $filterdArray = preg_grep("/^[a-zA-Z0-9]+$/", $arr, PREG_GREP_INVERT);
        
        foreach ($filterdArr as $key => $value) {      
            $filterdArr[$key];
            //send to log
        }
        //PREG_GREP_INVERT keep the invalid array elements
        if(empty($filterdReverse) && empty($filterdArray)){
            
            return true;
        }
        return false;
    }
    
    
}

?>