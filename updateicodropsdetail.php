<?php
include('bootstraps.php');
$sql="select * from ico_Analysis where DataSource='icodrops'";
$results=MySQLGetData($sql);
foreach($results as $k=>$v){
$url="https://icodrops.com/".$results[$k]['name']."/";
    $html=file_get_contents_https($url);
    $websitetmpstr=explode("\" target=\"_blank\" rel=\"nofollow\"><div class=\"button\" >WEBSITE",$html)[0];
    echo $website=explode("<a href=\"",$websitetmpstr)[count(explode("<a href=\"",$websitetmpstr))-1];
}
?>