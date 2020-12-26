<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

    <style>
        * {
            box-sizing: border-box;
        }

        .card-img-top {
            max-height: 10vw;
            object-fit: cover
        }
        .profileImg {
            width: 5%;
            height: 5%;
        }
        .waktu_komentar{
            color: grey;
        }
    </style>
    <title>Website Dinamis</title>
</head>
<?php

?>
<?php
include("../template/header_post.php");
require_once("../function/db_login.php");
?>
<?php
if (!isset($_GET['id'])) {
    echo "<h2>Post Tidak ditemukan</h2>";
} else {
    $id = ($_GET['id']);
    if ($id == '') {
        echo "<h2>Post Tidak ditemukan</h2>";
    } else {
        $query  = "SELECT * FROM post WHERE idpost = '" . $id . "'";
        $result = $db->query($query);
        if ($result->num_rows == 0) {
            echo "<h2>Post Tidak ditemukan</h2>";
        } else {
            $post = $result->fetch_object();
?>
            <div class="container" style="background-color: ghostwhite;margin-top: 16px;">
                <h1><?php echo $post->judul ?></h1>
                <p><?php echo date('M j, Y', strtotime($post->tgl_insert));?></p>
                <img src=<?php echo $post->file_gambar ?> alt="post" style="width: 50%;margin-top:8px">
                <p style="width:50%;margin-top:8px"><?php echo $post->isi_post; ?></p>
                <h3>Komentar</h3>
                <?php
                if(isset($_SESSION['id'])){
                    if($_SESSION['role'] == "penulis"){
                        ?>
                            <form action="add_komentar.php?id=<?php echo $id?>" method="POST">
                                <div class="form-group">
                                <textarea name="komentar" id="komentar" cols = 50 required></textarea>
                                </div>
                                <button class="btn btn-primary" type="submit" value="submit" name="submit">Tambah Komentar</button>
                            </form>
                            <br>
                        <?php
                    }
                }
                ?>
                <?php
                    $query  = "SELECT * FROM `komentar` AS K JOIN penulis AS P ON P.idpenulis = K.idpenulis WHERE idpost ='" . $id . "'";
                    $result = $db->query($query);
                    while($komentar = $result->fetch_object()){
                        echo '<div class="card" style = "margin:8px;"><div class="card-body">';
                        echo '<div class="row" style="margin-left: 16px;">';
                        echo '<img src="../images/person.png" alt="profile" class="profileImg">';
                        echo '<div class="col">';
                        echo '<label style="font-weight: bold;">'.$komentar->nama.'</label>';
                        echo '<span class = "waktu_komentar">&nbsp;&nbsp;'.date('M j, Y',strtotime($komentar->tgl_update)).'</span>';
                        echo '<p>'.$komentar->isi.'</p>';
                        echo '</div></div></div></div>';
                        echo '<br>';
                    }
                ?>
            </div>
<?php
        }
    }
}

?>

<br>
<?php include("../template/footer.html") ?>

<script src="../javascript\ajax.js"></script>
</body>

</html>