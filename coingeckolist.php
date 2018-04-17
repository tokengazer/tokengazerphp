<?php
include('bootstraps.php');
$url="https://www.coingecko.com/zh/ico";
$html=file_get_contents_https($url);
echo $html;
?>