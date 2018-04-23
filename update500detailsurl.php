<?php
include('bootstraps.php');
set_time_limit(0);


$sql="select * from ico_Analysis where id<=499";
$url1=MySQLGetData($sql);

$arr=array();
foreach($url1 as $k=>$v){

echo file_get_contents_httpcode("https://icodrops.com/".$url1[$k]['name']."/");echo "https://icodrops.com/".$url1[$k]['name']."/"die;
}
echo '完成';

function file_get_contents_httpcode($url) {
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_HEADER, 1);
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_SSLVERSION,4);
    curl_setopt($ch, CURLOPT_CAINFO, __DIR__ . "/cacert.pem");
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    $content = curl_exec($ch);
    
    return $httpCode = curl_getinfo($ch,CURLINFO_HTTP_CODE); ;
    curl_close($ch);
}
//header("Location http://tokenworm.applinzi.com/coinmarketcap.php?p=".$page);
// 初始化SaeKV对象
//访问授权应用的数据


