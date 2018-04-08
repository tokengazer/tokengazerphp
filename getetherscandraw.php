<?php
include('bootstraps.php');
$url="https://etherscan.io/token/tokenholderchart/0x86fa049857e0209aa7d9e616f7eb3b3b78ecfdb0?range=100";
    $html=file_get_contents_https($url);

$json=str_replace("'","\"",str_replace("});","",getSonString($html,"series: ","</script>")));
$json=rtrim($json, ',');

$json=str_replace("\r\n","",str_replace("name","\"name\"",$json));
$json=str_replace(" ","",str_replace("data","\"data\"",$json));
$json=str_replace(",]}]","]}]",$json);

$jsonarr=json_decode($json,true);
print_r($json);
?>