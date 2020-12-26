<?php
session_start();
require_once("../function/db_login.php");
$id = $_GET['id'];
$query = "DELETE FROM `kategori` WHERE  idkategori = '" . $id . "'";
$result = $db->query($query);
if (!$result) {
    die("Could not query the database: <br/>" . $db->error . "<br>Query: " . $query);
} else {
    $query2 = "DELETE FROM `post` WHERE  idkategori = '" . $id . "'";
    $result = $db->query($query2);
    if (!$result) {
        die("Could not query the database: <br/>" . $db->error . "<br>Query: " . $query2);
    } else {
        $_SESSION['tab'] = "tab_kategori";
        echo ("<script>location.href = 'dashboard_admin.php';</script>");
    }
}
