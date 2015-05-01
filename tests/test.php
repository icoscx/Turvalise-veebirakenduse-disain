<?php

function jsonCheck($string)
{
        return !empty($string) && is_string($string) && !preg_match('/[^,:{}\\[\\]0-9.\\-+Eaeflnr-u \\n\\r\\t]/',
        preg_replace('/"(\\.|[^"\\\\])*"/', '', $string));
}

echo is_json(json_encode(Array("ID" => 1,
								1 => "mees",
								"e-mail" => "ohsindemaili@mal.ee",
								"post" => "-.,!?",
								"ss" => Array("2" => "ssss")
)));

?>