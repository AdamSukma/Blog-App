<!DOCTYPE html>
<html>
<head>
	<title>Kategori</title>
</head>
<body>
	<?php
		function getPostsByCategory(){
			global $db;

			require_once('../function/db_login.php');

			$query = "SELECT P.judul, P.isi_post, P.file_gambar, P.tgl_insert, P.tgl_update, PS.nama AS nama_post, K.nama AS nama_kategori
					FROM post P
					JOIN penulis PS
					ON P.idpenulis = PS.idpenulis
					JOIN kategori K
					ON P.idkategori = K.idkategori
					WHERE K.idkategori = {$_GET['idkategori']}";
			$result = $db->query($query);
			if (!$result) {
				die('Could not query the database: <br>' . $db->error . '<br>Query: ' . $query);
			}
			$output = $result;
			return $output;
		}
	?>

	<div class="mr-auto">
		<nav class="site-navigation position-relative text-right" role="navigation">
			<ul class="site-menu main-menu js-clone-nav mr-auto d-none pl-0 d-lg-block">
				<li class="active">
					<a href="home.php" class="nav-link text-left">Home</a>
				</li>

				<?php $result = getPostsByCategory(); ?>
				<?php while ($category = $result->fetch_object()): ?>
					<li>
						<a href="<?= 'kategori.php?idkategori=' . $category->idkategori; ?>" class="nav-link text-left"><?= ucfirst($category->nama_kategori); ?></a>
					</li>
				<?php endwhile; ?>
				<?php $result->close(); ?>
			</ul>
		</nav>
	</div>

	<div class="site-section">
		<div class="container">

				<div class="row">
					<div class="col-lg-9">
						<div class="section-title">
							<span class="caption d-block small">Kategori</span>
							<h2><?= ucfirst($category->nama); ?></h2>
						</div>

						<?php while ($post = $posts->fetch_object()): ?>
							<div class="post-entry-2 d-flex">
								<div class="thumbnail order-md-2" style="background-image: <?= "url('img/" . $post->file_gambar . "')"; ?>"></div>
								<div class="contents order-md-1 pl-4 pl-md-0">
									<h2><a href="<?= 'detailpost.php?idpost=' . $post->idpost; ?>"><?= $post->judul; ?></a></h2>
									<p class="mb-3"><?= substr($post->isi_post, 0, 125); ?> ... </p>
									<div class="post-meta">
										<span class="d-block"><a href="#"><?= $post->nama_post; ?></a> in <a href="<?= 'kategori.php?idkategori=' . $post->idkategori; ?>"><?= ucfirst($post->nama_kategori); ?></a></span>
										<span class="date-read"><?= date('M j, Y', strtotime($post->tgl_insert)); ?></span>
									</div>
								</div>
							</div>
						<?php endwhile; ?>

				</div>
			</div>

			<?php $categories->close(); ?>
			<?php $posts->close(); ?>

		</div>
	</div>
</body>
</html>