<?php
$useragent = "Mozilla/5.0 (Macintosh; Intel Mac OS X 10_8_4) AppleWebKit/536.30.1 (KHTML, like Gecko) Version/6.0.5 Safari/536.30.1";
$browsers = Array(1 => 'msie',
                    2 => 'chrome',
                    3 => 'safari',
                    4 => 'firefox',
                    5 => 'opera');
foreach ($browsers as $key => $value) {
    
    if(strpos(strtolower($_SERVER['HTTP_USER_AGENT']), $browsers[$key] )){
        echo "allowed";
        break;
    }
}



?>