<!DOCTYPE html>
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
			box-sizing: border-box;
		}

		.card-img-top {
			max-height: 10vw;
			object-fit: cover
		}


		#kategori {
			margin: 10px;
		}
	</style>
	<title>Website Dinamis</title>
</head>
<?php

?>
<?php
include("../template/header_post.php");
require_once("../function/db_login.php");
?>

<div class="container" style="background-color: ghostwhite;margin-top: 16px;">
	<h4 style="padding-top: 8px;padding-bottom: 8px;">Keyword: <?php echo $_GET['search'] ?></h4>

	<div class="row">
		<?php
		if (isset($_GET['search'])) {
			$keyword = $_GET['search'];
		} else {
			$keyword = "";
		}
		if ($keyword == '') {
			$query = "SELECT * FROM post ORDER BY tgl_update ";
			$result = $db->query($query);
		} else {
			$query = "SELECT * FROM post WHERE judul LIKE '%".$keyword."%' or isi_post LIKE '%".$keyword."%' ORDER BY tgl_update ";
			$result = $db->query($query);
		}
		if (!$result) {
			die("Could not query the database: <br/>" . $db->error);
		} else {
			$i = 0;
			while ($row = $result->fetch_object()) {
				echo '<div class="col">';
				echo '<a href="detail_post.php?id=' . $row->idpost . '" style="color: black;">';
				echo ' <div class="card">';
				echo '<img src="' . $row->file_gambar . '" class="card-img-top" alt="post">';
				echo '<div class="card-body">';
				echo '<h6 class="card-title">' . $row->judul . '</h6>';
				echo '<p class="card-text">' . substr($row->isi_post, 0, 125) . '</p>';
				echo '</div></div></a></div>';
				echo '<br>';
				echo '<br>';
				$i++;
				if ($i % 3 == 0) {
					echo '<div class="w-100" style="padding: 8px;"></div>';
				}
				echo '<br>';
			}
			echo '<br>';
				
		}
		
		?>


<br>
<br>
<br>
<br>


	</div>

</div>
<br>
<?php include("../template/footer.html") ?>

<script src="../javascript\ajax.js"></script>
</body>

</html>