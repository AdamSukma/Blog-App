    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
      <a class="navbar-brand" href="#">Assalamualaikum!</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo02" aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarTogglerDemo02">
        <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
          <li class="nav-item active">
            <a class="nav-link" href="../post/home.php">Home </a>
          </li>

        </ul>
        <form class="form-inline my-2 my-lg-0" method="GET" action="../post/search.php">
          <input class="form-control mr-sm-2" type="text" placeholder="Search" name="search">
          <button class="btn btn-outline-success my-2 my-sm-0" type="submit" name='submit' value="submit">Search</button>

        </form>
        <?php
        if (session_status() == PHP_SESSION_NONE) {
          session_start();
        }
        require_once("../function/db_login.php");
        if (isset($_SESSION['id'])) {
          if($_SESSION['role'] == "admin"){
            $query = "SELECT nama FROM admin WHERE idadmin='".$_SESSION['id']."'";
            $ref = "../admin/dashboard_admin.php";
          }else{
            $query = "SELECT nama FROM penulis WHERE idpenulis='".$_SESSION['id']."'";
            $ref = "../penulis/dashboard_penulis.php";
          }
          $result = $db->query($query);
          if($result->num_rows>0){
            $nama = $result->fetch_object()->nama;
            ?>
            <form class="form-inline my-2 my-lg-0" action= <?php echo $ref?>>
            <button class="btn btn-secondary" style="margin-left: 8px;" type="submit"><?php echo $nama?></button>
            </form>
            <?php

          }
        } else {
        ?>
          <form class="form-inline my-2 my-lg-0" action="../function/login.php">
            <button class="btn btn-primary" style="margin-left: 8px;" type="submit">Login</button>
          </form>
        <?php
        }
        ?>


      </div>
    </nav>