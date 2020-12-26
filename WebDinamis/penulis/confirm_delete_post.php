<?php

session_start();
if(!isset($_SESSION['id'])){
    header('Location: login.php');
}

require_once('../function/db_login.php');
$id = $_GET['id'];

$query = "SELECT * FROM post WHERE idpost='".$id."'";
$result = $db->query($query)->fetch_object();

include('../template/header.html');
?>

<div class="container">
    <div class="card">
        <div class="card-header">
            Hapus data <?php echo $result->judul ?>?
        </div>
        <div class="card-body">
            <a href="delete_post.php?id=<?php echo $id ?>" class="btn btn-danger">Hapus</a>
            <a href="dashboard_penulis.php" class="btn btn-secondary">Batal</a>
        </div>
    </div>
</div>

<?php include('../template/footer.html')?>