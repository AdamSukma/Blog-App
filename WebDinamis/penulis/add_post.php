<?php
function test_input($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
session_start();
require_once("../function/db_login.php");
if (!isset($_SESSION['id'])) {
    header("Location: ../function/login.php");
}
$id = $_SESSION['id'];
$query = "SELECT * FROM penulis";
$result = $db->query($query);
if (!$result) {
    die("Could not query the database:<br/>" . $db->error);
} else {
    $row = $result->fetch_object();
    $name = $row->nama;
    $email = $row->email;
}

if (isset($_POST['submit'])) {
    $valid = true;
    $judul = test_input($_POST['judul']);
    if (empty($judul)) {
        $error_judul = 'Judul tidak boleh kosong';
        $valid = false;
    }

    $idkategori = test_input($_POST['idkategori']);
    if (($idkategori) == "" ) {
        $error_kategori = 'idkategori tidak boleh kosong';
        $valid = false;
    }
    $isi_post = test_input($_POST['isi_post']);
    if (empty($isi_post)) {
        $error_isipost = 'Isi Post tidak boleh kosong';
        $valid = false;
    }
    $file_gambar = test_input($_POST['file_gambar']);
    if (empty($file_gambar)) {
        $error_filegambar = 'File Gambar tidak boleh kosong';
        $valid = false;
    }
    $idpenulis = test_input($_SESSION['id']);
    echo $valid;
    if ($valid) {
        //escape inputs data

        $judul = $db->real_escape_string($judul);
        $idkategori = $db->real_escape_string($idkategori);
        $isi_post = $db->real_escape_string($isi_post);
        $file_gambar = $db->real_escape_string($file_gambar);
        $idpenulis = $db->real_escape_string($idpenulis);
        //asign a query
        $query = "INSERT INTO `post`(`idpost`, `judul`, `idkategori`, `isi_post`, `file_gambar`, `tgl_insert`, `tgl_update`, `id_penulis`) VALUES (null,'".$judul."',".$idkategori.",'".$isi_post."','".$file_gambar."',NOW(),NOW(),".$idpenulis.")";
        //execute the query
        echo $query;
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
        <form method="POST" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" autocomplete="on">
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
                            <option value="<?php echo $row->idkategori ?>"><?php echo $row->nama ?></option>>
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

            <button class='btn btn-primary' name='submit'>Submit</button>
            <a href="dashboard_penulis.php" class="btn btn-dark">Cancel</a>
        </form>
    </div>
</div>
<?php include('../template/footer.html'); ?><br>
<?php
$db->close();
?>