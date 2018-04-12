<?php
include('bootstraps.php');
$sql="select * from ico_Analysis ";
$list=MySQLGetData($sql);
foreach($list as $k=>$v){
$ticker=explode("",explode("(",$list[$k]['name'])[1])[0];
    $url="https://etherscan.io/searchHandler?term=".$ticker;
    $re=file_get_contents_https($url);
    echo var_dump($re);
}
die;
$url="https://etherscan.io/token/tokenholderchart/0x86fa049857e0209aa7d9e616f7eb3b3b78ecfdb0?range=100";
    $html=file_get_contents_https($url);

$json=str_replace("'","\"",str_replace("});","",getSonString($html,"series: ","</script>")));
$json=rtrim($json, ',');

$json=str_replace("\r\n","",str_replace("name","\"name\"",$json));
$json=str_replace(" ","",str_replace("data","\"data\"",$json));
$json=str_replace(",]}]","]}]",$json);

$jsonarr=json_decode($json,true)[0]["data"];
foreach($jsonarr as $k=>$v){
    print_r($v);
echo $sql="insert into etherscan_draw values ('1','".$v[0]."','".addslashes($v[1])."')";
    MySQLRunSQL($sql);
}
?>