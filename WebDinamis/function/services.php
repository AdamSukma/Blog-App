<?php
    $db_host = 'localhost';
    $db_database = 'db_blog';
    $db_username = 'root';
    $db_password = '';

    $db = new mysqli($db_host,$db_username,$db_password,$db_database);
    if($db->connect_errno){
        die ("could not connet to the database: <br/>".$db->connect_error);
    }
    $action = $_POST["action"];
    if("GET_POST" == $action){
        $db_data = array();
        $sql = "SELECT idpost,judul,file_gambar,tgl_insert,isi_post,id_penulis from post ORDER BY tgl_update DESC";
        $result = $db->query($sql);
        if($result->num_rows > 0){
            while($row = $result->fetch_assoc()){
                $db_data[] = $row;
            }
            // Send back the complete records as a json
            echo json_encode($db_data);
        }else{
            echo "error";
        }
        $db->close();
        return;
    }

    if("GET_KATEGORI" == $action){
        $db_data = array();
        $sql = "SELECT * from kategori ORDER BY nama ASC";
        $result = $db->query($sql);
        if($result->num_rows > 0){
            while($row = $result->fetch_assoc()){
                $db_data[] = $row;
            }
            // Send back the complete records as a json
            echo json_encode($db_data);
        }else{
            echo "error";
        }
        $db->close();
        return;
    }

    if("GET_POST_KEYWORD" == $action){
        $keyword = $_POST['keyword'];
        $db_data = array();
        $sql = "SELECT idpost,judul,file_gambar,tgl_insert,isi_post,id_penulis FROM post WHERE judul LIKE '%".$keyword."%' or isi_post LIKE '%".$keyword."%' ORDER BY tgl_update ";
        $result = $db->query($sql);
        if($result->num_rows > 0){
            while($row = $result->fetch_assoc()){
                $db_data[] = $row;
            }
            // Send back the complete records as a json
            echo json_encode($db_data);
        }else{
            echo "error";
        }
        $db->close();
        return;
    }

    if("GET_POST_KATEGORI" == $action){
        $idkategori = $_POST['idkategori'];
        $db_data = array();
        $sql = "SELECT idpost,judul,file_gambar,tgl_insert,isi_post,id_penulis FROM post WHERE idkategori =".$idkategori;
        $result = $db->query($sql);
        if($result->num_rows > 0){
            while($row = $result->fetch_assoc()){
                $db_data[] = $row;
            }
            // Send back the complete records as a json
            echo json_encode($db_data);
        }else{
            echo "error";
        }
        $db->close();
        return;
    }
    if("GET_NAMA_PENULIS" == $action){
        $db_data = array();
        $idpenulis = $_POST['idpenulis'];
        $sql = "SELECT nama FROM `penulis` WHERE idpenulis =".$idpenulis;
        $result = $db->query($sql);
        if($result->num_rows > 0){
            while($row = $result->fetch_assoc()){
                $db_data[] = $row;
            }
            // Send back the complete records as a json
            echo json_encode($db_data);
        }else{
            echo "error";
        }
        $db->close();
        return;
    }
    if("GET_KOMENTAR" == $action){
        $db_data = array();
        $idpost = $_POST['idpost'];
        $sql = "SELECT isi,tgl_update,nama FROM komentar AS K JOIN penulis AS P ON K.idpenulis = P.idpenulis WHERE K.idpost =".$idpost;
        $result = $db->query($sql);
        if($result->num_rows > 0){
            while($row = $result->fetch_assoc()){
                $db_data[] = $row;
            }
            // Send back the complete records as a json
            echo json_encode($db_data);
        }else{
            echo "error";
        }
        $db->close();
        return;
    }
?>