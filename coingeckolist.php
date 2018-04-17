<?php
include('bootstraps.php');
$url="https://www.coingecko.com/zh/ico";
$html=file_get_contents_https($url);
$tophtml=getSonString("<tr class='asset-content sponsored'>","</tr>",$html);

print_r($tophtml);
?>