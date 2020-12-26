<?php
    session_start();
    if (!isset($_SESSION['id'])){
      header('Location: login.php');
    }
    require_once('../function/db_login.php');
    $idpost = $_GET['id'];
    $komentar = isset($_POST['komentar'])? $_POST['komentar']:'';
    $query = "INSERT INTO `komentar`(`idkomentar`, `idpost`, `idpenulis`, `isi`, `tgl_update`) VALUES (Null,".$idpost.",".$_SESSION['id'].",'".$_POST['komentar']."',NOW())";
    $result = $db->query($query);
    if(!$result){
        die ("Could not query the database: <br>".$db->error.'<br>Query:' .$query);
    }else{
        $db->close();
        echo $idpost;
        header('Location: detail_post.php?id='.$idpost);
    }
?>