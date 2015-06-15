<?php
    require("module/xdbs.php");
    if(isset($_SERVER['PATH_INFO'])){
	$permalink = explode('/',$_SERVER['PATH_INFO']);
        $query_select = mysql_query("SELECT short_url, long_url FROM tb_url WHERE short_url = '$permalink[1]'");
        if(mysql_num_rows($query_select)>0){
            $ambil = mysql_fetch_assoc($query_select);
            $long_url = urldecode($ambil['long_url']);
            require_once("module/input-stats.php");
            header("Location: $long_url");
        }
        else{
            header("Location: 404.php");
        }
    }
    $query_link = mysql_query("SELECT id_url FROM tb_url");
    $query_clicked = mysql_query("SELECT id_stats FROM tb_stats");
    $jml_link = mysql_num_rows($query_link);
    $jml_clicked = mysql_num_rows($query_clicked);
?>
<!DOCTYPE html>
<html>
<head>
    <title>enlink - shorten your long url - everything is linked</title>
	<meta name='description' content='enhalink.tk merupakan sebuah situs yang berguna untuk mempersingkat atau shorten url alamat url yang panjang'/>
	<meta name='keyword' content='shorten url, pendekin url, bit ly, url pendek, shorter url'/>
    <link rel='stylesheet' href='style/style.css'/>
    <link rel='icon' type='image/x-icon' href='images/icon-enlink-crop-very-small.png'/>
    <script type="text/javascript" src="js/jquery-1.2.3.min.js"></script>
    <script type="text/javascript">
    $(document).ready(function() {
    
            $().ajaxStart(function() {
                    $('#loading').show();
                    $('#result').hide();
            }).ajaxStop(function() {
                    $('#urlform').hide();
                    $('#loading').hide();
                    $('#result').fadeIn('slow');
            });
    
            $('#close-button').click(function(){
                    $('#result').hide();
                    $('#urlform').fadeIn('slow');
                });
            $('#edit-button').click(function(){
                    $('#result').hide();
                    $('#edit-form').fadeIn('slow');
                });
            
            $('#urlform').submit(function() {
                    $.ajax({
                            type: 'POST',
                            url: $(this).attr('action'),
                            data: $(this).serialize(),
                            success: function(data) {
                                    $('#url-result').html(data);
                            }
                    })
                    return false;
            });
            $('#edit-form').submit(function() {
                    $.ajax({
                            type: 'POST',
                            url: $(this).attr('action'),
                            data: $(this).serialize(),
                            success: function(data) {
                                    $('#url-result').html(data);
                            }
                    })
                    return false;
            });
    })
    </script>
</head>

<body>
<header>
    <div class='header-container'>
        <img src='images/logo-enlink-crop-200px.png' alt='enlink - shorten your long url - everything is linked'/>
        
        <nav>
            <ul>
                <li><a href='#'>Home</a></li>
                <li><a href='#stats'>Stats</a></li>
                <li><a href='#about'>About</a></li>
            </ul>
        </nav>
    </div>
</header>

<section>
    <img src='images/logo-enlink-crop-200px.png' alt='enlink - shorten your long url - everything is linked'/>
    <article>
        <h2>Shorten Your Long URL Here</h2>
        <div align='center'>
            <form id='urlform' method='post' action='module/shorten.php'>
                <div class='input-container'>
                    <input class='input-text' type='text' name='long_url' placeholder='Paste Long Url Here' required><input class='input-submit' type='submit' value='Shorten URL'/> 
                </div>
            </form>
            <div>
                <div id="loading" style="display:none;"><img src="images/loading.gif" alt="loading..." /></div>
                <div id="result" style="display:none;">
                    <div id='url-result'></div>
                    <input id='close-button' type='button' value='Close'/>
                </div>
            </div>
        </div>
    </article>
    <article>
        <h2 id='introduction'>Introduction</h2>
        <p>enhalink.tk merupakan sebuah situs yang berguna untuk mempersingkat alamat url yang panjang. Cara kerja aplikasi ini akan melakukan redirect dari alamat <a href='http://enlink.tk/NHN' title='http://enlink.tk/NHN'>http://enlink.tk/NHN</a> ke alamat sebenarnya misalkan http://facebook.com/nurhasan.najibullah/about. Lebih pendek bukan? dan gampang dihapalkan tentunya</p>
        <p>Untuk saat ini fitur masih sangat terbatas, pengembangan akan terus kami lakukan</p>
    </article>
    <article>
        <h2 id='about'>About</h2>
        <p>Situs enlink.tk dibuat menggunakan html5, css3, php, mysql, ajax dan jQuery.</p>
        <p>Situs ini dibuat dan dikembangkan oleh Nur Hasan Najibullah. Aplikasi diharapkan mampu membantu teman-teman dalam mempersingkat alamat url yang panjang menjadi lebih pendek. Sehingga mudah dihapal dan tidak memakan banyak ruang misalkan ditampilkan di banner, pamflet, poster, medsos atau yang lainnya.</p>
    </article>
    <article>
        <h2 id='stats'>Stats</h2>
        <div>
            <?php echo $jml_link;?> Links Submitted
        </div>
        <div>
            <?php echo $jml_clicked;?> Links Clicked
        </div>
    </article>
</section>

<footer>
    <div class='footer-container'>
        <span class='footer-content float-left'>Developed by <a href='//enlink.tk/NHN' title='Nur Hasan Najibullah' target='_blank'>Nur Hasan Najibullah</a></span>
        <span class='footer-content float-right'>Copyright 2015. <a href='//www.enlink.tk' title='enlink - shorten your long url - everything is linked' target='_blank'>enlink - shorten your long url here- everything is linked</a></span>
    </div>
</footer>
</body>
</html>