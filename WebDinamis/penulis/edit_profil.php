<?php

require_once('../function/db_login.php');
$id = isset($_GET['id'])? $_GET['id']:''; //mendapatkan customerid yang dilwatkan ke url


function test_input($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

//mengecek apakah user belum menekan tombol submit
if (!isset($_POST['submit'])){
    $query= "SELECT * FROM penulis WHERE idpenulis='".$id."'";
    //execute the query
    $result = $db->query($query);
    if (!$result){
        die ("Could not query the database: <br>".$db->error);
    }
    else{
        while ($row = $result->fetch_object()){
            $nama = $row->nama;
            $email = $row->email;
            $password = $row->password;
            $kota = $row->kota;
            $alamat = $row->alamat;
            $no_telp = $row->no_telp;
        }
    }
}
else{
    $valid = TRUE; //flag validasi
    $nama = test_input($_POST['nama']);
    if($nama == ''){
        $error_nama = "Nama wajib diisi";
        $valid = FALSE;
    }
    elseif (!preg_match("/^[a-zA-Z ]*$/",$nama)){
        $error_nama = "Hanya alfabet dan spasi yang boleh dimasukkan";
        $valid = FALSE;
    }

    $email = test_input($_POST['email']);

    if ($email == '') {
        $error_email = "Email wajib diisi";
        $valid = FALSE;
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error_email = "Format email salah";
        $valid = FALSE;
    }

    $password = test_input($_POST['password']);
    if($password == ''){
        $error_password = "Password wajib diisi";
        $valid = FALSE;
    }

    $confirm_password = test_input($_POST['confirm_password']);
    if($confirm_password == ''){
        $error_confirm_password = "Tulis ulang password untuk konfirmasi";
        $valid = FALSE;
    }
    elseif($confirm_password != $password){
        $error_confirm_password = "Password tidak sesuai";
        $valid = FALSE;
    }
    $kota = test_input($_POST['kota']);
    if($kota == ''){
        $error_kota = "Kota wajib diisi";
        $valid = FALSE;
    }
    $alamat = test_input($_POST['alamat']);
    if($alamat == ''){
        $error_alamat = "Alamat wajib diisi";
        $valid = FALSE;
    }
    $no_telp = test_input($_POST['no_telp']);
    if($no_telp == ''){
        $error_no_telp = "Nomor telepon wajib diisi";
        $valid = FALSE;
    }

   

    //update data into database
    if ($valid){
        //asign a query
        $query = "UPDATE penulis SET nama='".$nama."',email='".$email."', password='".md5($password)."',
        kota='".$kota."',alamat='".$alamat."',no_telp='".$no_telp."' WHERE idpenulis=".$id."";
        //execute the query
        $result = $db->query($query);
        if (!$result){
            die ("Could not query the database: <br>".$db->error.'<br>Query:' .$query);
        }
        else{
            $db->close();
            header('Location: dashboard_penulis.php');
        }
    }
}
?>


<?php include('../template/header.html');?><br>
<div class="container">
    <div class="card">
        <div class="card-header">Edit Profil</div>
        <div class="card-body">
            <form method="POST" autocomplete="on" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]).'?id='.$id;?>">
                <div class="form-group">
                    <label for="nama">Nama:</label>
                    <input type="text" class="form-control" id="nama" name="nama" value="<?php echo $nama;?>">
                    <div class="error"><?php if(isset($error_nama)) echo $error_nama;?></div>
                </div>
                <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="email" class="form-control" id="email" name="email" value="<?php echo $email;?>">
                    <div class="error"><?php if(isset($error_email)) echo $error_email;?></div>
                </div>
                <div class="form-group">
                    <label for="password">Password:</label>
                    <input type="password"class="form-control" name="password" id="password" >
                    <div class="error"><?php if(isset($error_password)) echo $error_password;?></div>
                </div>
                <div class="form-group">
                    <label for="confirm_password">Konfirmasi Password:</label>
                    <input type="password"class="form-control" name="confirm_password" id="confirm_password" >
                    <div class="error"><?php if(isset($error_confirm_password)) echo $error_confirm_password;?></div>
                </div>
                <div class="form-group">
                    <label for="kota">Kota:</label>
                    <input type="text" class="form-control" id="kota" name="kota" value="<?php echo $kota;?>">
                    <div class="error"><?php if(isset($error_kota)) echo $error_kota;?></div>
                </div>
                <div class="form-group">
                    <label for="alamat">Alamat:</label>
                    <textarea class="form-control" name="alamat" id="alamat" rows="5"><?php echo $alamat;?></textarea>
                    <div class="error"><?php if(isset($error_alamat)) echo $error_alamat;?></div>
                </div>
                <div class="form-group">
                    <label for="no_telp">Nomor Telepon:</label>
                    <input type="text" class="form-control" id="no_telp" name="no_telp" value="<?php echo $no_telp;?>">
                    <div class="error"><?php if(isset($error_no_telp)) echo $error_no_telp;?></div>
                </div>
                <br>
                <button type="submit" class="btn btn-primary" name="submit" value="submit">Submit</button>
                <a href="dashboard_penulis.php" class = "btn btn-dark">Cancel</a>
            </form>
        </div>
    </div> 
</div>
<?php include('../template/footer.html'); ?>
<?php
$db->close();
?> 