<?php
include('bootstraps.php');
$url="https://etherscan.io/token/tokenholderchart/0x86fa049857e0209aa7d9e616f7eb3b3b78ecfdb0?range=100"
    $html=file_get_contents_https($url);
$json=getSonString($html,"series: ","</script>");
echo $json;
?>