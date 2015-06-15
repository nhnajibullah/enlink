<?php
	date_default_timezone_set('Asia/Jakarta');
	session_start();
    define('db_host','localhost');
    define('db_usr','root');
    define('db_pwd','');
    define('db','enlink');
    $connect = mysql_connect(db_host,db_usr,db_pwd);
    $sel_db = mysql_select_db(db,$connect);
?>