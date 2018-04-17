<?php
include('bootstraps.php');
$url="https://www.coingecko.com/zh/ico";
$html1=file_get_contents_https($url);
$tophtml=explode('<tr class=\'asset-content sponsored\'>',$html1);

print_r($tophtml);
?>