<?php

    

        $arr = Array("name" => "ivo",
                    "password" => "kukesaba",
                    "tere!" => "tere",
                    "tere" => "-sa"
		);
        $filterdArr = preg_grep("/^[a-zA-Z0-9]+$/", $arr, PREG_GREP_INVERT);
        
        foreach ($filterdArr as $key => $value) {      
            echo $filterdArr[$key];
        }
       
        $filterdArr = preg_grep("/^[a-zA-Z]+$/", array_keys($arr), PREG_GREP_INVERT);
        
        foreach ($filterdArr as $value => $key) {      
            echo $filterdArr[$value];
        
        }
        
		

?>