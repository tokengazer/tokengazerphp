<?
include('bootstraps.php');
$sql="select name from ico_Analysis";
$data=MySQLGetData($sql);
foreach($data as $k=>$v){
/*$url="https://api.coinmarketcap.com/v1/ticker/".$data[$k]['name']."/";
    $results=json_decode(file_get_contents_https($url),true);
    if(isset($results['error'])){
    continue;
    }
    $Current_market_value=$results[0]['market_cap_usd'];
    $Current_Circulation=$results[0]['available_supply'];
    $Current_Single_price=$results[0]['price_usd'];*/
    $html=file_get_contents_https("https://coinmarketcap.com/currencies/".$data[$k]['name']."/");
    $tmpstr3=explode("<li><span class=\"glyphicon glyphicon-hdd text-gray\" title=\"Source Code\"></span> ",$html)[1];
    $tmpstr2=explode("<a href=\"",$tmpstr3)[1];
    $tmpstr4=explode("\"",$tmpstr2)[0];
    $githuburl=$tmpstr4;
    echo $sql="update ico_Analysis set Github_url='".$githuburl."' where name='".$data[$k]['name']."'";
    MySQLRunSQL($sql);
    //echo $sql="update ico_Analysis set Current_market_value='".$Current_market_value."',Current_Circulation='".$Current_Circulation."',Current_Single_price='".$Current_Single_price."',Github_url='".$githuburl."' where name='".$data[$k]['name']."'";
    //MySQLRunSQL($sql);
}

?>