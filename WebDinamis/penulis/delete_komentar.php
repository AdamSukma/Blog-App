<?php
session_start();
if (!isset($_SESSION['id'])){
  header('Location: login.php');
}
require_once('../function/db_login.php');
$id = isset($_GET['id'])? $_GET['id']:''; 
$query ="SELECT * FROM komentar WHERE idkomentar='".$id."'";
$result = $db->query($query)->fetch_object();
$idpost = $result->idpost;
$query ="DELETE FROM komentar WHERE idkomentar='".$id."'";
        //execute the query
        $result = $db->query($query);
        if (!$result){
            die ("Could not query the database: <br>".$db->error.'<br>Query:' .$query);
        }
        else{
            $db->close();
            header('Location: view_komentar.php?id='.$idpost.'');
        }
?>