<?php
    $database= new mysqli("localhost","root","","sdmc");
    if ($database->connect_error){
        die("Connection failed:  ".$database->connect_error);
    }
?>