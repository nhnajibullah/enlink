<?php
    if(empty($_POST['short_url']) || $_POST['short_url']==''){
        header("Location: ../");
    }
    $short_url = trim($_POST['short_url']);
    $id_url = $_POST['id_url'];
    require('xdbs.php');
    $query_update = mysql_query("UPDATE tb_url SET short_url = $short_url WHERE id_url = $id_url");
    if($query_update){
        echo "your short url : <input type='text' value='http://enlink.tk/$short_url' readonly>";
    }
    else{
        echo 'Gagal!';
    }
?>