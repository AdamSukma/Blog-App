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
      box-sizing: border-box
    }

    body {
      font-family: "Lato", sans-serif;
    }

    /* Style the tab */
    .tab {
      float: left;
      border: 1px solid #ccc;
      background-color: #f1f1f1;
      width: 15%;
      height: 100%;
    }

    /* Style the buttons inside the tab */
    .tab button {
      display: block;
      background-color: inherit;
      color: black;
      padding: 22px 16px;
      width: 100%;
      border: none;
      outline: none;
      text-align: left;
      cursor: pointer;
      transition: 0.3s;
      font-size: 17px;
    }

    /* Change background color of buttons on hover */
    .tab button:hover {
      background-color: #ddd;
    }

    /* Create an active/current "tab button" class */
    .tab button.active {
      background-color: #ccc;
    }

    /* Style the tab content */
    .tabcontent {
      float: left;
      padding: 0px 12px;
      border: 1px solid #ccc;
      width: 85%;
      border-left: none;
      height: 100%;
    }
  </style>
</head>

<body>

  <?php
  session_start();
  require_once("../function/db_login.php");
  if (!isset($_SESSION['id'])) {
    header("Location: ../function/login.php");
  }
  $id = $_SESSION['id'];
  $query = "SELECT * FROM penulis WHERE idpenulis = '$id'";
  $result = $db->query($query);
  if (!$result) {
    die("Could not query the database:<br/>" . $db->error);
  } else {
    $row = $result->fetch_object();
    $name = $row->nama;
    $email = $row->email;
  }
  ?>

<div class="tab">
<div class="container">
<br>
      <h4><?php if (isset($name)) echo $name ?></h4>
      <p><?php if (isset($email)) echo $email ?></p>
    </div>
  <button class="tablinks" onclick="openTab(event, 'profil')" id="profile">Profile</button>
  <button class="tablinks" onclick="openTab(event, 'data_post')" id="tab_post">Data Post</button>
  <br>
  <div class="container">
  <br>
  <br>
  <br>
  <br>
  <br>
  <br>
  <a href="../post/home.php" class = "btn btn-primary" style="width: 100%;">Homepage</a>
  <br>
  <br>
  <a href="../function/logout.php" class = "btn btn-danger" style="width: 100%;">Logout</a>
  </div>
</div>

</div>

<div id="profil" class="tabcontent">
  <?php 
  include("profile_penulis.php");
  ?>
</div>

<div id="data_post" class="tabcontent">
  <?php 
  include("view_post.php");
  ?>
</div>


<script>
function openTab(evt, tabName) {
  var i, tabcontent, tablinks;
  tabcontent = document.getElementsByClassName("tabcontent");
  for (i = 0; i < tabcontent.length; i++) {
    tabcontent[i].style.display = "none";
  }
  tablinks = document.getElementsByClassName("tablinks");
  for (i = 0; i < tablinks.length; i++) {
    tablinks[i].className = tablinks[i].className.replace(" active", "");
  }
  document.getElementById(tabName).style.display = "block";
  evt.currentTarget.className += " active";
}

// Get the element with id="defaultOpen" and click on it
document.getElementById("<?php echo $_SESSION['tab']?>").click();

  
</script>

</html>