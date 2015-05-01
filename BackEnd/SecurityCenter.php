<?php
//    static  //self
//    private  //$this->
class SecurityCenter{

    //urlcheck
    private static $urlRegex = "/^(http(?:s)?\\:\\/\\/[a-zA-Z0-9]+(?:(?:\\.|\\-)[a-zA-Z0-9]+)+(?:\\:\\d+)?(?:\\/[\\w\\-]+)*(?:\\/?|\\/\\w+\\.[a-zA-Z]{2,4}(?:\\?[\\w]+\\=[\\w\\-]+)?)?(?:\\&[\\w]+\\=[\\w\\-]+)*)$/";
    //simple user-agent check
    private static $browsers = Array(1 => 'msie',
                2 => 'chrome',
                3 => 'safari',
                4 => 'firefox',
                5 => 'opera'
        );
    //for post, whitelisted static paths
    private static $allowedQueries = Array(
            1 => '/cgi-bin/login.cgi',
            2 => '/cgi-bin/register.cgi',
            3 => '/cgi-bin/logout.cgi',
            4 => '',
            5 => '',
            6 => '',
        );
    //get parameter filter
    private static $queryRegex = "/^[a-zA-Z0-9]+$/";
    
    /**
     * Verify http header from client (covers most used vectors 70%)
     * @return boolean true if header's inject free
     */
    public function requestHeaderCheck(){

        //check for potential inject
        if(isset($_SERVER['HTTP_REFERER'])){
            if((preg_match(self::$urlRegex, $_SERVER['HTTP_REFERER'])) !== 1){
                //log
                return false;
            }
        }
        //we use jquery and ajax, therefore this is required
        if(!isset($_SERVER['HTTP_X_REQUESTED_WITH']) AND strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) != 'xmlhttprequest') {
            //log
            return false;
        
        }
        //we allow whitelisted browsers and are safe from user-agent injects
        if(!isset($_SERVER['HTTP_USER_AGENT'])){
            //log
            return false;
        }else{
            foreach (self::$browsers as $key => $value) {

                if(!strpos(strtolower($_SERVER['HTTP_USER_AGENT']), self::$browsers[$key] )){
                    //log
                    return false;
                }
            }
        }

        return true;
    }
    
    public function requestMethodCheck($parameter){
        //filter invalid paramater values
        if ($_SERVER['REQUEST_METHOD'] === 'GET'){

            if(!((isset($_GET[$parameter])) && strlen($_GET[$parameter]) > 0 && (preg_match(self::$queryRegex, $_GET[$parameter])))){
                return false;
            }
            //same for posts, but allow whitelisted requests only
        }elseif($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_SERVER['REQUEST_URI'])){
                    //whitelisted uris only
                foreach (self::$allowedQueries as $key => $value) {
                    if(!strcmp(self::$allowedQueries[$key], $_SERVER['REQUEST_URI'])){
                        //log
                        return false;
                    }
                }
        }
        return true;
    }
    
    /**
     * Check if session is valid (antiHiJack)
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