<?php
//IPS intrusion Prevention system. IDS tuvastab reeglite abil (antud juhul securityFunctions)
//ebaharilikke ning halvaloomulisi p2ringuid serverisuunal ning logib need. IPS on sama nagu
//IDS kuid koos tuvastamisega blokeerib ka (i.Pure(c))


class IPS{
    
    private $path = "../securitylogs/attacks.log";
    private $top = "../securitylogs/topIPsHitCount.log";
    private $logentry = "";
    
    function __construct(){}
    
    /**
     * Writes the string to file
     * @param type $write String to write
     */
    public function write($threat, $payload){
        
        self::buildLogEntry($threat, $payload);
        file_put_contents($this->path,$this->logentry,FILE_APPEND);
        
    }
    /**
     * Builds logline
     * @param type $threat threat description
     * @param type $payload if payload exitst (post req) write malicious payload to log
     */
    public function buildLogEntry($threat, $payload){
        
        session_start();
        date_default_timezone_set('EET');
        $entry = "\n[***]PREVENTED THREAT TYPE: ";
        $entry .= $threat;
        $entry .="[***]\n";
        $entry .= "Method: ";
        $entry .=(string)$_SERVER['REQUEST_METHOD'];
        $entry .="\n";
        $entry .="ReqTime: ";
        $entry .=(string)date("d.m.Y-[H:i:s] ");
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
        $entry .=(string)$_SESSION['Id'];
        $entry .="\n";

        if($payload){
            $entry .= "*****MALICIOUS PAYLOAD******\n";
            $entry .= $payload;
            $entry .= "\n";
            
        }

        $entry .="********************************************************************\n\n";

        $this->logentry = $entry;
        
        self::statisticsTop();
    }
    
    public function statisticsTop(){
        
        $ip = $_SERVER['REMOTE_ADDR'];
        if(file_exists($this->top)){
            //get and append
            $data = file_get_contents($this->top);
            if(strlen($data) > 0){
                $data = json_decode($data, true);
                if(array_key_exists($ip, $data)){
                    $data[$ip] = $data[$ip] + 1;
                }else{
                    $data[$ip] = 1;
                }
            }
            file_put_contents($this->top,json_encode($data));
        }else{
            //write $_SERVER['REMOTE_ADDR']
            $line = Array();
            $line[$ip] = 1;
            file_put_contents($this->top,json_encode($line));
        }
        
    }
   
    
}

?>