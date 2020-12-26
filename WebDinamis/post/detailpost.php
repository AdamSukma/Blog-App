<!DOCTYPE html>
<html>
<head>
	<title>Detail Post</title>
</head>
<body data-spy="scroll" data-target=".site-navbar-target" data-offset="300">

	<?php 
		function getPost(){
			global $db;

			require_once('../functions/db_blog.php');

			$query = "SELECT P.judul, P.isi_post, P.file_gambar, P.tgl_insert, P.tgl_update, PS.nama, K.nama
						FROM post P
						JOIN penulis PS
						ON P.idpenulis = PS.idpenulis
						JOIN kategori K
						ON P.idkategori = K.idkategori
						WHERE P.idpost = {$_GET['idpost']}";
			$result = $db->query($query);

			if (!$result) {
				die('Could not query the database: <br>' . $db->error . '<br>Query: ' . $query);
			}

			return $output;
		}

		function createComment(){
			global $db;

			$message = $error = '';

			if (isset($_POST['submit_comment'])) {
				$valid = TRUE;

				$updatedAt = date('Y-m-d H:i:s', time());
				$postId = $_GET['idpost'];
				$writerId = $_SESSION['user']->idpenulis;

				if (empty($_POST['message'])) {
					$error = 'Please provide a message';
					$valid = FALSE;
				}else{
					$message = $_POST['message'];
				}
				if ($valid) {
					$query = "INSERT INTO komentar VALUES(NULL, '$message', '$updatedAt', '$postId', '$writerId')";
					$result = $db->query($query);

					if (!$result) {
						die('Could not post the data: <br>' . $db->error . '<br>Query: ' . $query);
					}else{
						$path = "Location: detailpost.php?idpost=$postId";
						header($path);
						return;
					}
				}	
			}

			return $error;
		}
	?>

	<div class="site-wrap">
		<?php 
			if (isset($_GET['idpost'])) {
				$posts = getPost($_GET['idpost']);
				$post = $posts->fetch_object();
			}
		?>

		<?php $error = createComment(); ?>

	</div>

	<div class="site-section">
		<div class="container">
		
			<div class="row">
				<div class="col-lg-8 single-content">

					<p class="mb-5"><img src="<?= 'img/' . $post->file_gambar; ?>" alt="Image" class="img-fluid"></p>
					<h1 class="mb-4"><?= $post->judul; ?>-></h1>
					<div class="post-meta d-flex mb-5">
						<div class="vcard">
							<span class="d-block"><a href="#"><?= $post->nama; ?></a> in <a href="<?= 'kategori.php?idkategori=' . $post->idkategori; ?>"><?= ucfirst($post->nama); ?></span>
							<span class="date-read"><?= date('M j, Y', strtotime($post->tgl_insert)); ?></span> 
						</div>
					</div>

					<p><?= $post->isi_post; ?></p>

					<div class="pt-5">
						<p>Kategori: <a href="<?= 'kategori.php?idkategori=' . $post->idkategori; ?>"><?= ucfirst($post->nama); ?></a></p>
					</div>
					<?php $posts->close(); ?>

			</div>
		</div>

		<?php $categories->close(); ?>
		<?php $posts->close(); ?>

		</div>
	</div>
</body>
</html>
	