<br>
<div class="card">
    <div class="card-header">Data Penulis</div>
    <div class="card-body">
        <br>
        <table class="table table-striped">
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>Alamat</th>
                <th>Kota</th>
                <th>Email</th>
                <th>No. Telp</th>
                <th>Action</th>
            </tr>
            <?php
            $query = "SELECT * FROM penulis";
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
                echo "<td>" . $row->alamat . "</td>";
                echo "<td>" . $row->kota . "</td>";
                echo "<td>" . $row->email . "</td>";
                echo "<td>" . $row->no_telp . "</td>";
                echo "<td><a href = 'reset_password.php?id=" . $row->idpenulis . "' class = 'btn btn-primary btn-sm'>Reset Password</a></td> ";
                echo "</tr>";
            }
            echo "</table>";
            echo "<br/>";
            echo 'Total Rows = ' . $result->num_rows;
            ?>
        </table>
    </div>
</div>