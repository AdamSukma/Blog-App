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

	<div class="row">
		<div class="col">

		</div>
		<div class="col">
			<select name="kategori" id="kategori" class="form-control" onchange="showPost(this.value)">
				<option value="default">--Pilih Kategori--</option>
				<option value="all">Semua Kategori</option>
				<?php
				$query = "SELECT * FROM kategori ORDER BY nama";
				$result = $db->query($query);

				if (!$result) {
					die("Could not query the database: <br/>" . $db->error);
				}
				while ($row = $result->fetch_object()) {
					echo '<option value="' . $row->idkategori . '">' . $row->nama . '</option>';
				}

				?>
			</select>
		</div>
	</div>




	<h4 style="padding-top: 8px;padding-bottom: 8px;">Recent Post</h4>
	<div id="post">
		<?php include("get_post.php") ?>
	</div>

</div>
<br>
<br>
<?php include("../template/footer.html")?>

<script src="../javascript\ajax.js"></script>
</body>

</html>