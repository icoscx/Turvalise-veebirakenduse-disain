<?php
$useragent = "Mozilla/5.0 (Macintosh; Intel Mac OS X 10_8_4) AppleWebKit/536.30.1 (KHTML, like Gecko) Version/6.0.5 Safari/536.30.1";
$browsers = Array('msie','chrome','safari','firefox','opera');
echo preg_match("/(?:version\/|(?:msie|chrome|safari|firefox|opera) )([\d.]+)/i", $useragent);

?>