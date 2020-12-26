<?php
if (!isset($_POST["submit"])) {
    $new_name = $name;
    $new_email = $email;
} else {
    require_once("../function/db_login.php");
    $valid = TRUE;
    $new_name = test_input($_POST['name']);

    if ($new_name == '') {
        $error_name = "Nama harus diisi";
        $valid = FALSE;
    } elseif (!preg_match("/^[a-zA-Z-' ]*$/", $new_name)) {
        $error_name = "Nama hanya diperbolehkan terdiri dari huruf dan spasi";
        $valid = FALSE;
    }
    $new_email = test_input($_POST['email']);
    if ($new_email == '') {
        $error_email = "Email harus diisi";
        $valid = FALSE;
    } elseif (!filter_var($new_email, FILTER_VALIDATE_EMAIL)) {
        $error_email = "Format email salah";
        $valid = FALSE;
    }
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
        $error_profile = "Password tidak sama dengan Confirm Password";
        $valid = FALSE;
    }
    $_SESSION['tab'] = "tab_profile";
    if ($valid) {
        $query = "UPDATE admin SET nama = '" . $new_name . "',email ='" . $new_email . "',password = '" . md5($new_password) . "' WHERE idadmin='" . $id . "'";
        $result = $db->query($query);
        if (!$result) {
            die("Could not query the database: <br/>" . $db->error . "<br>Query: " . $query);
        } else {
            // header("Location: dashboard_admin.php");
            echo("<script>location.href = 'dashboard_admin.php?msg=$msg';</script>");
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
<div class="card">
    <div class="card-header">Edit Profile</div>
    <div class="card-body">
        <form method="POST" autocomplete="on" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) ?>">
            <div class="form-group">
                <label for="name">Nama:</label>
                <input type="text" class="form-control" id="name" name="name" value="<?php echo $new_name; ?>">
                <div class="text-danger"><?php if (isset($error_name)) echo $error_name; ?></div>
            </div>

            <div class="form-group">
                <label for="email">Email:</label>
                <textarea type="text" class="form-control" id="email" name="email"><?php echo $new_email; ?></textarea>
                <div class="text-danger"><?php if (isset($error_email)) echo $error_email; ?></div>
            </div>
            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" class="form-control" id="password" name="password">
                <div class="text-danger"><?php if (isset($error_password)) echo $error_password; ?></div>
            </div>
            <div class="form-group">
                <label for="repassword">Confirm Password:</label>
                <input type="password" class="form-control" id="repassword" name="repassword">
                <div class="text-danger"><?php if (isset($error_repassword)) echo $error_repassword; ?></div>
            </div>
            <div class="text-danger"><?php if (isset($error_profile)) echo $error_profile; ?></div>
            <br>
            <button type="submit" class="btn btn-primary" name='submit' value="submit">Edit Profile</button>
        </form>
    </div>
</div>
</body>