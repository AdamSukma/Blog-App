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

    if (isset($_POST['submit'])) {
        $valid = TRUE;

        $email = test_input($_POST['email']);

        if ($email == '') {
            $error_email = "Email is required";
            $valid = FALSE;
        } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $error_email = "Invalid email format";
            $valid = FALSE;
        }
        $password = test_input($_POST['password']);
        if ($password == '') {
            $error_password = "Password is required";
            $valid = FALSE;
        }

        if ($valid) {
            $query = "SELECT * FROM admin WHERE email = '" . $email . "' AND password = '" . md5($password) . "'";
            $result = $db->query($query);
            if (!$result) {
                die("Could not query the database:<br/>" . $db->error);
            } else {
                if ($result->num_rows > 0) {
                    $row = $result->fetch_object();
                    $_SESSION['id'] = $row->idadmin;
                    $_SESSION['tab'] = "tab_kategori";
                    $_SESSION['role'] = "admin";
                    header("Location: ../admin/dashboard_admin.php");
                    exit;
                } else {
                    $query = "SELECT * FROM penulis WHERE email = '" . $email . "' AND password = '" . md5($password) . "'";
                    $result = $db->query($query);
                    if (!$result) {
                        die("Could not query the database:<br/>" . $db->error);
                    } else {
                        if ($result->num_rows > 0) {
                            $row = $result->fetch_object();
                            $_SESSION['id'] = $row->idpenulis;
                            $_SESSION['tab'] = "profile";
                            $_SESSION['role'] = "penulis";
                            header("Location: ../penulis/dashboard_penulis.php");
                            exit;
                        } else {
                            $error_login =  '<span class = "error">Combination of username and password are not correct.</span>';
                        }
                    }

                }
            }
            $db->close();
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
    <?php include("../template/header_post.php"); ?>
    <br>
    <div class="container">
    <div class="card">
        <div class="card-header">Login Form</div>
        <div class="card-body">
            <form method="POST" autocomplete="on" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) ?>">
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" class="form-control" id="email" name="email" size="30" value='<?php if (isset($email)) echo $email; ?>'>
                    <div class="text-danger"><?php if (isset($error_email)) echo $error_email; ?></div>
                </div>

                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" class="form-control" id="password" name="password" value=''>
                    <div class="text-danger"><?php if (isset($error_password)) echo $error_password; ?></div>
                </div>
                <div class="text-danger"><?php if (isset($error_login)) echo $error_login; ?></div>
                <button type="submit" class='btn btn-primary' name='submit' value="submit">Login</button>

            </form>
            <a href="../function/signup.php">Create an account</a>
        </div>
    </div>
    </div>
</body>
</html>