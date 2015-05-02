<?php

require ('/SecurityCenter.php');

class SecurityManager extends SecurityCenter{
    
    private $_methodParam = null;
    private $_input = null;
    //on initz set params
    function __construct($methodParam){
        
        //HTTP method
        $this->_methodParam = $methodParam;
        //get ajax input
        $this->_input = file_get_contents("php://input");
        
    }
    /**
     * Check against security functions
     */
    public function initializeSecurity($strickt){
        
        if(!(parent::requestMethodCheck($this->_methodParam))){
            exit('Get - empty or incorrect parameter - Post - forbidden query detected');
        }elseif(!parent::requestHeaderCheck()){
            exit('Malformed header');
        }
        //kui post req
        if($this->_methodParam == null){
            
            if(!(parent::jsonCheck($this->_input))){
                exit('Invalid string structure detected');
            }elseif(!(parent::checkArray($data = json_decode($this->_input, true), $strickt))){
                exit('Invalid parameter or index values detected');
            }
        }

    }
    /**
     * if verification successful, return input
     * @return type PHP array of passed verification cycle
     */
    public function getVerifiedInput(){
        
        return json_decode($this->_input, true);
    }
    /**
     * Validate current or new session
     */
    public function validateSession(){
        
        if(!parent::checkSession()){
            exit('Invalid session');
        }
    }
    
    
}


?>