<br>
<div class="container">
<div class="card">
    <div class="card-header">Profile Pribadi</div>
    <div class="card-body">
        <br>
        <table class="table table-striped">
        <?php
            $query = "SELECT * FROM penulis WHERE (idpenulis='$id') ";
            $result = $db->query($query);
            if(!$result){
                die("could not query the database: </br>".$db->error."<br>Query".$query);
            }
            $i = 0;
            while($row = $result->fetch_object()){
                $i++;
                echo "<td>";
                    echo "<tr>";
                        echo "<td> Nama </td>";
                        echo "<td>".$row->nama."</td>";
                    echo "</tr>";
                    echo "<tr>";
                        echo "<td> Email </td>";
                        echo "<td>".$row->email."</td>";
                    echo "</tr>";
                    echo "<tr>";
                        echo "<td> Alamat </td>";
                        echo "<td>".$row->alamat."</td>";
                    echo "</tr>";
                    echo "<tr>";
                        echo "<td> Kota </td>";
                        echo "<td>".$row->kota."</td>";
                    echo "</tr>";
                    echo "<tr>";
                        echo "<td> Nomor Telepon </td>";
                        echo "<td>".$row->no_telp."</td>";
                    echo "</tr>";
                echo "</td>";
            
            echo "</table>";
        ?>
        </table>
            
    </div>
    </div>
<hr>
<a class="btn btn-primary" href="edit_profil.php?id=<?php echo $row->idpenulis?>">Edit Profile</a><br /><br />
</div>

            <?php } ?>