<?php
include('bootstraps.php');
$url="https://www.coingecko.com/zh/ico";
$html=file_get_contents_https($url);
$tophtml=explode("<tr class='asset-content sponsored'>",$html);
foreach($tophtml as $k=>$v)
{
$tophtml[$k]=explode("</tr>",$tophtml[$k][1])[0];
}
print_r($html);
?>