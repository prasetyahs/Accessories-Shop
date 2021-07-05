<?php 
$keyword = $_GET['keyword'];
$url_halaman = $_SERVER["HTTP_REFERER"];
$halaman = parse_str(parse_url($url_halaman, PHP_URL_QUERY), $key);

echo "<script>location='index.php?halaman=$key[halaman]&keyword=$keyword';</script>";
?>