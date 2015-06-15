<?php
    require("module/xdbs.php");
	$ip_address = $_SERVER['REMOTE_ADDR'];
    $permalink = explode('/',$_SERVER['PATH_INFO']);
    $query_input = mysql_query("INSERT INTO tb_stats(short_url, ip_address) VALUES ('$permalink[1]','$ip_address')");
?>    