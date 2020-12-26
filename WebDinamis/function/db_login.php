<?php
    $db_host = 'localhost';
    $db_database = 'db_blog';
    $db_username = 'root';
    $db_password = '';

    $db = new mysqli($db_host,$db_username,$db_password,$db_database);
    if($db->connect_errno){
        die ("could not connet to the database: <br/>".$db->connect_error);
    }
?>