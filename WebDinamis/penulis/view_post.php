<br>
<a class="btn btn-primary" href="add_post.php">+ Buat Postingan Baru</a><br /><br />
<div class="card">
    <div class="card-header">Data Post</div>
        <br>
        <table class="table table-striped">
        <tr>
            <th>No</th>
            <th>Judul</th>
            <th>Kategori</th>
            <th>Isi Post</th>
            <th>File Gambar</th>
            <th>Tanggal Pembuatan Postingan</th>
            <th>Tanggal Update Postingan</th>
            <th>Action</th>
        </tr>
        <?php
            require_once('../function/db_login.php');
            $query = "SELECT * FROM post INNER JOIN kategori ON post.idkategori=kategori.idkategori WHERE post.id_penulis='$id'";
            $result = $db->query($query);
            if(!$result){
                die("could not query the database: </br>".$db->error."<br>Query".$query);
            }
            $i = 0;
            while($row = $result->fetch_object()){
                $i++;
                echo "<tr>";
                echo "<td>".$i."</td>";
                echo "<td>".$row->judul."</td>";
                echo "<td>".$row->nama."</td>";
                echo "<td>".substr($row->isi_post, 0, 100)."</td>";
                ?>
                <td><img src="<?php echo $row->file_gambar?>" width="100px"></td>
                <?php
                echo "<td>".$row->tgl_insert."</td>";
                echo "<td>".$row->tgl_update."</td>";
                echo "<td>
                    <a href = 'view_komentar.php?id=".$row->idpost."' class = 'btn btn-secondary btn-sm' style=\"width: 100px; height:50px\">Lihat <br> Komentar</a> &nbsp;&nbsp;
                    <br>
                    <a href = 'edit_post.php?id=".$row->idpost."' class = 'btn btn-warning btn-sm' style=\"width: 100px\">Edit</a> &nbsp;&nbsp;
                <br>
                    <a href = 'confirm_delete_post.php?id=".$row->idpost."' class = 'btn btn-danger btn-sm' style=\"width: 100px\">Delete</a>
                </td> ";
                echo "</tr>";
            }
            echo "</table>";
            echo "<br/>";
            ?>
<div class="container">
            <?php
            echo 'Total Rows = '.$result->num_rows;
        ?>
        </div>
        </table>
            
    </div>
    </div>
    <br>
    <br>
