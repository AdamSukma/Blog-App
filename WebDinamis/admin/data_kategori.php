<div class="card">
    <div class="card-header">Data Kategori</div>
    <div class="card-body">
        <a class="btn btn-primary" href="add_kategori.php">+ Add Kategori</a><br><br>
        <table class="table table-striped">
            <tr>
                <th>No</th>
                <th>Nama Kategori</th>
                <th>Jumlah Post</th>
                <th>Action</th>
            </tr>
            <?php
            $query = "SELECT K.idkategori,K.nama,COUNT(P.judul) AS jumlah_post FROM `post` AS P RIGHT OUTER JOIN `kategori` AS K ON P.idkategori = K.idkategori GROUP BY K.idkategori,K.nama";
            $result = $db->query($query);
            if (!$result) {
                die("could not query the database: </br>" . $db->error . "<br>Query" . $query);
            }
            $i = 0;
            while ($row = $result->fetch_object()) {
                $i++;
                echo "<tr>";
                echo "<td>" . $i . "</td>";
                echo "<td>" . $row->nama . "</td>";
                echo "<td>" . $row->jumlah_post . "</td>";
                echo '<td> <a class = "btn btn-warning btn-sm" href = "edit_kategori.php?nama=' . $row->nama . '">Edit</a>&nbsp;&nbsp; <button onclick="deletePost(' . $row->idkategori . ')" class = "btn btn-danger btn-sm">Delete</button></td>';

                echo "</tr>";
            }
            echo "</table>";
            echo "<br/>";
            echo 'Total Rows = ' . $result->num_rows;
            ?>
        </table>

    </div>
    <script>
        function deletePost(id) {
            var ask = window.confirm("Apakah anda yakin untuk menghapus kategori?");
            if (ask) {
                window.alert("Kategori berhasil dihapus");
                window.location = "delete_kategori.php?id=" + id;

            }
        }
    </script>
</div>