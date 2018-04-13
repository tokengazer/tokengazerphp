<?php
include('bootstraps.php');
$sql="select * from ico_Analysis where DataSource='icodrops'";
$results=MySQLGetData($sql);
foreach($results as $k=>$v){
    if($results[$k]['icolink']!=''){
    $url=$results[$k]['icolink'];
    }else{
    
$url="https://icodrops.com/".str_replace(" ","-",trim($results[$k]['name']))."/";
    }
    $html=file_get_contents_https($url);
    $websitetmpstr=explode("\" target=\"_blank\" rel=\"nofollow\"><div class=\"button\" >WEBSITE",$html)[0];
    $website=explode("<a href=\"",$websitetmpstr)[count(explode("<a href=\"",$websitetmpstr))-1];
    $whitepapertmpstr=explode("\" target=\"_blank\" rel=\"nofollow\"><div class=\"button\" >WHITEPAPER",$html)[0];
    echo $whitepaper=explode("<a href=\"",$whitepapertmpstr)[count(explode("<a href=\"",$whitepapertmpstr))-1];
    $saletime=explode("<i class=\"fa fa-calendar\" aria-hidden=\"true\"></i>",$html)[1];
    $saletime=trim(explode("</h4>",explode("</h4>",$saletme)[0])[1]);
    $saletime=trim(str_replace("Token Sale:","",$saletime));
    $icostartdate=explode("-",$saletime)[0];
    $icoenddate=explode("-",$saletime)[1];
    $ticker=explode("</li>",explode("Ticker: </span>",$html)[1])[0];
    $whitelist=explode(",",explode("Whitelist: </span>",$html)[1])[0];
    $cannotareas=explode("</li>",explode("Сan't participate: </span>",$html)[1])[0];
    $platform=explode("</li>",explode("Accepts: </span>",$html)[1])[0];
    $sql="update icco_Analysis set whitepaper='".$whitepaper."',ticker='".$ticker."',whitelist='".$whitelist."',Ico_time='".$icostartdate."',Platform='".$platform."',cannotareas='".$cannotareas."',website='".$website."' where id=".$$results[$k]['id']."";
    MySQLRunSQL($sql);
}
?>