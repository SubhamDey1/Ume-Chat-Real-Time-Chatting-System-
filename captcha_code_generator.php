<?php
    if($_SERVER['REQUEST_METHOD'] == "POST") {
        $sl = "abcdefghijklmnopqrstuvwxyz";
        $su = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
        $no = "1234567890";
        $s = substr(str_shuffle(str_shuffle($su)),0,2).substr(str_shuffle(str_shuffle($sl)),0,2).substr(str_shuffle(str_shuffle($no)),0,2);
    
        echo str_shuffle(str_shuffle($s));
    }
?>