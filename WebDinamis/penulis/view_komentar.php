<?php include('../template/header.html');?>
<br>
    <div class="container">
        <div class="card">
            <div class="card-header">Data Komentar</div>
            <div class="card-body">
            <?php 
            session_start();
            if(!isset($_SESSION['id'])){
                header('Location: login.php');
            }
            require_once('../function/db_login.php');
            $id = $_GET['id'];
            $query2= "SELECT * FROM  post WHERE idpost='$id'";
            $query = " SELECT * FROM komentar INNER JOIN penulis ON komentar.idpenulis = penulis.idpenulis WHERE komentar.idpost ='$id' ORDER BY tgl_update DESC";
            $result = $db->query($query);
            $result2 = $db->query($query2)->fetch_object();
            $judul = $result2->judul;
            echo '<h1>'.$judul.'</h1>';
            
            ?>
                
                    
                <br>
                <table class="table table-striped">
                    <tr>
                        <th>No</th>
                        <th>Ditulis oleh</th>
                        <th>Komentar</th>
                        <th>Tanggal update</th>
                        <th>Action</th>
                    </tr>
                    <?php
                    //Include our login information
            
                    //Execute the query
            
                    if(!$result){
                        die ("Could not query the database: <br/>". $db->error ."<br>Query: ".$query);
                    }        
                    // Fetch and display the results
                    $i = 1;
                    while($row = $result->fetch_object()){
                        echo '<tr>';    
                        echo '<td>'.$i.'</td>';
                        echo '<td>'.$row->nama.'</td>';
                        echo '<td>'.$row->isi.'</td>';
                        echo '<td>'.$row->tgl_update.'</td>';
                        echo '<td><a class="btn btn-danger btn-sm" href="confirm_delete_komentar.php?id='.$row
                                ->idkomentar.'">Delete</a></td>';
                        echo'</tr>';
                        $i++;
                    }
                    echo '</table>';
                    echo '<br />';
                    echo 'Total Rows = '.$result->num_rows;
                    $result->free();
                    $db->close();

                    ?>
                </table>
                <hr>
                <a href="dashboard_penulis.php" class = "btn btn-dark">Kembali ke Dashboard</a>
           </div>
        </div>
    </div>
</div>
</body>
</html>