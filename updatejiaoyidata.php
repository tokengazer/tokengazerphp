<?php
include('bootstraps.php');
$sql="select * from ico_Analysis ";
$list=MySQLGetData($sql);
$i=0;
foreach($list as $k=>$v){
    $name=trim(explode("(",$list[$k]['name'])[0]);
$ticker=explode(")",explode("(",$list[$k]['name'])[1])[0];
    $url2="https://api.coinmarketcap.com/v1/ticker/".$name."/";
    $results=json_decode(curls($url2),true);
    if(isset($results['error'])){
    continue;
    }
    $Current_market_value=$results[0]['market_cap_usd'];
    $Current_Circulation=$results[0]['available_supply'];
    $Current_Single_price=$results[0]['price_usd'];
    $html=file_get_contents_https("https://coinmarketcap.com/currencies/".$data[$k]['name']."/");
    $tmpstr3=explode("<li><span class=\"glyphicon glyphicon-hdd text-gray\" title=\"Source Code\"></span> ",$html)[1];
    $tmpstr2=explode("<a href=\"",$tmpstr3)[1];
    $tmpstr4=explode("\"",$tmpstr2)[0];
    $githuburl=$tmpstr4;
    //echo $sql="update ico_Analysis set Github_url='".$githuburl."' where name='".$data[$k]['name']."'";
    //MySQLRunSQL($sql);
    $sql="update ico_Analysis set Current_market_value='".$Current_market_value."',Current_Circulation='".$Current_Circulation."',Current_Single_price='".$Current_Single_price."'  where id='".$list[$k]['id']."'";
    MySQLRunSQL($sql);
    
}
echo $i;

function curls($url){
    $headers = array(
        'accept: application/json, text/javascript, */*; q=0.01',
       
    );
    $curl = curl_init();
    //设置抓取的url
    curl_setopt($curl, CURLOPT_URL, $url);
    //curl_setopt($curl, CURLOPT_POST, 1);
    //设置头文件的信息作为数据流输出
    curl_setopt($curl, CURLOPT_HEADER, 0);
    //设置获取的信息以文件流的形式返回，而不是直接输出。
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);

    curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
    //执行命令
    $data = curl_exec($curl);
    //关闭URL请求
    curl_close($curl);
    //显示获得的数据
    if (substr($data, 0,3) == pack("CCC",0xef,0xbb,0xbf)) {
        $data = substr($data, 3);
    }
    return $data;
  }
function object_to_array($obj) {
    $obj = (array)$obj;
    foreach ($obj as $k => $v) {
        if (gettype($v) == 'resource') {
            return;
        }
        if (gettype($v) == 'object' || gettype($v) == 'array') {
            $obj[$k] = (array)object_to_array($v);
        }
    }
 
    return $obj;
}
function array_to_object($arr) {
    if (gettype($arr) != 'array') {
        return;
    }
    foreach ($arr as $k => $v) {
        if (gettype($v) == 'array' || getType($v) == 'object') {
            $arr[$k] = (object)array_to_object($v);
        }
    }
 
    return (object)$arr;
}

?>