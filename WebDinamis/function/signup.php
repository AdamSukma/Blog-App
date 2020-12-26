<html>

<head>
</head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

<body>

<?php

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
require_once("../function/db_login.php");
 //mendapatkan customerid yang dilwatkan ke url


function test_input($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

//mengecek apakah user belum menekan tombol submit
if (isset($_POST['submit'])){
    echo "test";
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
        $query = "INSERT INTO `penulis`(`idpenulis`, `nama`, `password`, `alamat`, `kota`, `email`, `no_telp`) VALUES (Null,'".$nama."','".md5($password)."','".$alamat."','".$kota."','".$email."','".$no_telp."')";
        //execute the query
        echo $query;
        $result = $db->query($query);
        if (!$result){
            die ("Could not query the database: <br>".$db->error.'<br>Query:' .$query);
        }
        else{
            $db->close();
            header('Location: login.php');
        }
    }
}
?>

<?php include('../template/header_post.php');?><br>


<div class="container">
    <div class="card">
        <div class="card-header">Sign Up</div>
        <div class="card-body">
            <form method="POST" autocomplete="on" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"])?>">
                <div class="form-group">
                    <label for="nama">Nama:</label>
                    <input type="text" class="form-control" id="nama" name="nama">
                    <div class="text-danger"><?php if(isset($error_nama)) echo $error_nama;?></div>
                </div>
                <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="email" class="form-control" id="email" name="email" >
                    <div class="text-danger"><?php if(isset($error_email)) echo $error_email;?></div>
                </div>
                <div class="form-group">
                    <label for="password">Password:</label>
                    <input type="password"class="form-control" name="password" id="password" >
                    <div class="text-danger"><?php if(isset($error_password)) echo $error_password;?></div>
                </div>
                <div class="form-group">
                    <label for="confirm_password">Konfirmasi Password:</label>
                    <input type="password"class="form-control" name="confirm_password" id="confirm_password" >
                    <div class="text-danger"><?php if(isset($error_confirm_password)) echo $error_confirm_password;?></div>
                </div>
                <div class="form-group">
                    <label for="kota">Kota:</label>
                    <input type="text" class="form-control" id="kota" name="kota" >
                    <div class="text-danger"><?php if(isset($error_kota)) echo $error_kota;?></div>
                </div>
                <div class="form-group">
                    <label for="alamat">Alamat:</label>
                    <textarea class="form-control" name="alamat" id="alamat" rows="5"></textarea>
                    <div class="text-danger"><?php if(isset($error_alamat)) echo $error_alamat;?></div>
                </div>
                <div class="form-group">
                    <label for="no_telp">Nomor Telepon:</label>
                    <input type="text" class="form-control" id="no_telp" name="no_telp" >
                    <div class="text-danger"><?php if(isset($error_no_telp)) echo $error_no_telp;?></div>
                </div>
                <br>
                <button type="submit" class="btn btn-primary" name="submit" value="submit">Sign Up</button>
                <a href="login.php" class="btn btn-secondary">Cancel</a>
            </form>
        </div>
    </div>
</div>
<?php include('../template/footer.html'); ?>
<?php
$db->close();
?>