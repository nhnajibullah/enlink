<?php
    if(empty($_POST['long_url']) || $_POST['long_url']==''){
        header("Location: ../");
    }
    require('xdbs.php');
    $long_url = urlencode(trim($_POST['long_url']));
    require('acakstring.php');
    $code = acak(3);
    $short_url = $code;
    $query_input = mysql_query("INSERT INTO tb_url(short_url,long_url) VALUES ('$short_url','$long_url')");
    
    if($query_input){
        $query_select = mysql_query("SELECT id_url, short_url FROM tb_url WHERE short_url = '$short_url'");
        $ambil = mysql_fetch_assoc($query_select);
        $id_url = urldecode($ambil['id_url']);
        $_SESSION['id_url'] = $id_url;
        echo "your short url : <input type='text' value='http://enlink.tk/$short_url' readonly>";
    }
    else{
        echo 'Gagal!';
    }
?>