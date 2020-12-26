<?php
session_start();
include_once('../function/db_login.php');
function test_input($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
if (!isset($_POST['submit'])) {
    $id = $_GET['id'];
    $query= "SELECT * FROM post WHERE idpost='".$id."'";
    //execute the query
    $result = $db->query($query);
    if (!$result){
        die ("Could not query the database: <br>".$db->error);
    }
    else{
        while ($row = $result->fetch_object()){
            $judul  = $row->judul;
            $idkategori = $row->idkategori;
            $isi_post = $row->isi_post;
            $file_gambar = $row->file_gambar;
        }
    }
} else {

    $valid = true;
    $id = $_GET['id'];
    $judul = test_input($_POST['judul']);
    $idkategori = test_input($_POST['idkategori']);
    $isi_post = test_input($_POST['isi_post']);
    $file_gambar = test_input($_POST['file_gambar']);
    $idpenulis = test_input($_SESSION['id']);

    if (empty($judul)) {
        $error_judul = 'Judul tidak boleh kosong';
        $valid = false;
    }
    if (empty($idkategori)) {
        $error_kategori = 'idkategori tidak boleh kosong';
        $valid = false;
    }
    if (empty($isi_post)) {
        $error_isipost = 'Isi Post tidak boleh kosong';
        $valid = false;
    }
    if (empty($file_gambar)) {
        $error_filegambar = 'File Gambar tidak boleh kosong';
        $valid = false;
    }

    if ($valid) {
        //escape inputs data
        $judul = $db->real_escape_string($judul);
        $idkategori = $db->real_escape_string($idkategori);
        $isi_post = $db->real_escape_string($isi_post);
        $file_gambar = $db->real_escape_string($file_gambar);
        $idpenulis = $db->real_escape_string($idpenulis);
        //asign a query
        $query = "UPDATE `post` SET `judul`='".$judul."',`idkategori`=".$idkategori.",`isi_post`='".$isi_post."',`file_gambar`='".$file_gambar."',`tgl_update`=NOW(),`id_penulis`=".$idpenulis." WHERE idpost = ".$id;
        //execute the query
        $result = $db->query($query);
        if (!$result) {
            die("Could not query the database: <br>" . $db->error . '<br>Query:' . $query);
        } else {
            $db->close();
            header('Location: dashboard_penulis.php');
        }
    }
}
?>

<?php include('../template/header.html'); ?><br>
<div class="card">
    <div class="card-body">
        <form method="POST" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']).'?id='.$id; ?>" autocomplete="on" onsubmit="return confirmaddpost();">
            <div class="form-group">
                <label for="judul">Judul</label>
                <input type="text" class="form-control" id="judul" value="<?php if (isset($judul)) echo $judul; ?>" name="judul">
                <small class="text-danger">
                    <?php if (isset($error_judul)) echo $error_judul; ?>
                </small>
            </div>
            <div class="form-group">
                <label for="idkategori">Kategori</labe l>
                    <select class="form-control" id="idkategori" name="idkategori">
                        <option value="" selected>-- Pilih Kategori --</option>
                        <?php
                        $sql = ("SELECT * FROM kategori");
                        $result2 = $db->query($sql);
                        while ($row = $result2->fetch_object()) { ?>
                            <option value="<?php echo $row->idkategori; ?>"><?php echo $row->nama ?></option>>
                        <?php
                        }
                        ?>
                    </select>
                    <small class="text-danger">
                        <?php if (isset($error_kategori)) echo $error_kategori; ?>
                    </small>
            </div>
            <div class="form-group">
                <label for="isi_post">Isi Post</label>
                <textarea class="form-control" id="isi_post" name="isi_post"><?php if (isset($isi_post)) echo $isi_post; ?></textarea>
                <small class="text-danger">
                    <?php if (isset($error_isipost)) echo $error_isipost; ?>
                </small>
            </div>
            <div class="form-group">
                <label for="file_gambar">File Gambar</label>
                <input type="text" placeholder="<Diisi dengan link gambar>" class="form-control" id="file_gambar" value="<?php if (isset($file_gambar)) echo $file_gambar; ?>" name="file_gambar">
                <small class="text-danger">
                    <?php if (isset($error_filegambar)) echo $error_filegambar; ?>
                </small>
            </div>

            <button class='btn btn-primary' name='submit'>Update</button>
            <a href="dashboard_penulis.php" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
</div>
<?php include('../template/footer.html'); ?><br>
<?php
$db->close();
?>