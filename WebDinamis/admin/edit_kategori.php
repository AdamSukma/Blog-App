<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</head>

<body>
    <?php
    session_start();
    require_once("../function/db_login.php");
    $name = $_GET['nama'];
    if(!isset($_POST["submit"])){
        $new_name = $name;
    }else{
        $valid = TRUE;
        $new_name = $_POST['name'];
        if ($new_name == '') {
            $error_name = "Nama harus diisi";
            $valid = FALSE;
        } elseif (!preg_match("/^[a-zA-Z-' ]*$/", $new_name)) {
            $error_name = "Nama hanya diperbolehkan terdiri dari huruf dan spasi";
            $valid = FALSE;
        }

        if($valid){
            $_SESSION['tab'] = "tab_kategori";
            $query = "SELECT * FROM kategori WHERE nama = '".$new_name."'";
            $result = $db->query($query);
            if($result->num_rows == 0){
                $query2 = 'UPDATE `kategori` SET `nama`= "'.$new_name.'" WHERE nama = "'.$name.'"';
                $result2 = $db->query($query2);
                if (!$result2) {
                    die("Could not query the database: <br/>" . $db->error . "<br>Query: " . $query2);
                } else {
                    header("Location: dashboard_admin.php");
                }

            }else if($new_name == $name){
                header("Location: dashboard_admin.php");
            }else{
                $error_name = "Nama kategori sudah terdapat di database";
            }
        }
    }

    function test_input($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
    ?>
    <br>
    <div class="container">
    <div class="card">
        <div class="card-header">Edit Kategori</div>
        <div class="card-body">
            <form method="POST" autocomplete="on" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]). '?nama=' . $name; ?>">
            <div class="form-group">
                <label for="name">Nama Kategori:</label>
                <input type="text" class="form-control" id="name" name="name" value="<?php echo $new_name; ?>">
                <div class="text-danger"><?php if (isset($error_name)) echo $error_name ?></div>
            </div>
                <br>
                <button type="submit" class="btn btn-primary" name='submit' value="submit">Edit</button>
                <a href="dashboard_admin.php" class="btn btn-secondary">Cancel</a>
            </form>
        </div>
    </div>
    </div>
</body>

</html>