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
    $id = $_GET["id"];
    $query = "SELECT * FROM penulis where idpenulis = '" . $id . "'";
    $result = $db->query($query);
    if (!$result) {
        die("Could not query the database: <br/>" . $db->error . "<br>Query: " . $query);
    } else {
        $row = $result->fetch_object();
        $name = $row->nama;
        $email = $row->email;
    }
    if (isset($_POST["submit"])) {
        $valid = TRUE;
        $new_password = test_input($_POST['password']);
        if ($new_password == '') {
            $error_password = "Password harus diisi";
            $valid = FALSE;
        }
        $new_repassword = test_input($_POST['repassword']);
        if ($new_repassword == '') {
            $error_repassword = "Confirm password harus diisi";
            $valid = FALSE;
        }
        if ($new_password != $new_repassword) {
            $error_reset = "Password tidak sama dengan Confirm Password";
            $valid = FALSE;
        }
        if ($valid) {
            $query = "UPDATE penulis SET password = '" . md5($new_password) . "' WHERE idpenulis='" . $id . "'";
            $result = $db->query($query);
            if (!$result) {
                die("Could not query the database: <br/>" . $db->error . "<br>Query: " . $query);
            } else {
                $_SESSION['tab'] = "tab_penulis";
                header("Location: dashboard_admin.php");
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
        <div class="card-header">Reset Password</div>
        <div class="card-body">
            <form method="POST" autocomplete="on" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) . '?id=' . $id; ?>">
                <label for="nama"><?php echo "Name: " . $name ?></label><br>
                <label for="email"><?php echo "Email: " . $email ?></label>
                <div class="form-group">
                    <label for="password">Password:</label>
                    <input type="password" class="form-control" id="password" name="password">
                    <div class="text-danger"><?php if (isset($error_password)) echo $error_password ?></div>
                </div>
                <div class="form-group">
                    <label for="repassword">Confirm Password:</label>
                    <input type="password" class="form-control" id="repassword" name="repassword">
                    <div class="text-danger"><?php if (isset($error_repassword)) echo $error_repassword ?></div>
                </div>
                <div class="text-danger"><?php if (isset($error_reset)) echo $error_reset ?></div>
                <br>
                <button type="submit" class="btn btn-primary" name='submit' value="submit">Reset Password</button>
                <a href="dashboard_admin.php" class="btn btn-secondary">Cancel</a>
            </form>
        </div>
    </div>
    </div>
</body>
</html>