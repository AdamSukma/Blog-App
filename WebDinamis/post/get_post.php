    <div class="row">
            <?php
            require_once("../function/db_login.php");
            if (isset($_GET['id'])) {
                $id = $_GET['id'];
            } else {
                $id = "default";
            }
            if ($id == 'default' || $id == 'all') {
                $query = "SELECT * FROM post ORDER BY tgl_update ";
                $result = $db->query($query);
            } else {
                $query = "SELECT * FROM post WHERE idkategori = '" . $id . "'ORDER BY tgl_update ";
                $result = $db->query($query);
            }
            if (!$result) {
                die("Could not query the database: <br/>" . $db->error);
            } else {
                $i = 0;
                while ($row = $result->fetch_object()) {
                    echo '<div class="col">';
                    echo '<a href="detail_post.php?id='.$row->idpost.'" style="color: black;">';
                    echo ' <div class="card">';
                    echo '<img src="'.$row->file_gambar.'" class="card-img-top" alt="post">';
                    echo '<div class="card-body">';
                    echo '<h6 class="card-title">'.$row->judul.'</h6>';
                    echo '<p class="card-text">'.substr($row->isi_post, 0, 125).'</p>';
                    echo '</div></div></a></div>';
                    $i++;
                    if($i %3 == 0){
                        echo '<div class="w-100" style="padding: 8px;"></div>';
                    }

                }
            }
            ?>





    </div>