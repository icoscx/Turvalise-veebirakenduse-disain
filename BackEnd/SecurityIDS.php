<?php
//IDS intrusion detection system. IDS tuvastab reeglite abil (antud juhul securityFunctions)
//ebaharilikke ning halvaloomulisi p2ringuid serverisuunal ning logib need


class IDS{
    
    private $path = "../securitylogs/attacks.log";
    private $timeStamp = "";
    private $logentry = "";
    
    function __construct(){
        
        date_default_timezone_set('EET');
        $this->timeStamp = date("d.m.Y-[H:i:s] ");
        
    }
    
    /**
     * Writes the string to file
     * @param type $write String to write
     */
    public function write(){
        
        self::buildLogEntry();
        file_put_contents($this->path,$this->logentry,FILE_APPEND);
        
    }
    
    public function buildLogEntry(){
        
         $entry = "Method: ";
         $entry .=(string)$_SERVER['REQUEST_METHOD'];
         $entry .="\n";
         $entry .="ReqTime: ";
         $entry .=(string)$this->timeStamp;
         $entry .="\n";
         $entry .="QueryString: ";
         $entry .=(string)$_SERVER['QUERY_STRING'];
         $entry .="\n";
         $entry .="Connection: ";
         $entry .=(string)$_SERVER['HTTP_CONNECTION'];
         $entry .="\n";
         $entry .="Host: ";
         $entry .=(string)$_SERVER['HTTP_HOST'];
         $entry .="\n";
         $entry .="Referer: ";
         $entry .=(string)$_SERVER['HTTP_REFERER'];
         $entry .="\n";
         $entry .="UserAgent: ";
         $entry .=(string)$_SERVER['HTTP_USER_AGENT'];
         $entry .="\n";
         $entry .="RemoteAddress: ";
         $entry .=(string)$_SERVER['REMOTE_ADDR'];
         $entry .="\n";
         $entry .="RequestedURI: ";
         $entry .=(string)$_SERVER['REQUEST_URI'];
         $entry .="\n";
         $entry .="Potential user in danger: ";
         $entry .=(string)$_SESSION['UName']; 
         $entry .="\n";
         $entry .="Potential user Sess ID: ";
         $entry .=$_SESSION['Id'];
         $entry .="\n";
         
         if($payload){
             
         }
         
         if($user){
             
         }

         $entry .="********************************************************************";

         $this->logentry = $entry;
        
    }
   
    
}

?>