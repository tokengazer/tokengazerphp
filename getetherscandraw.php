<?php
include('bootstraps.php');
$sql="select * from ico_Analysis where DataSource='icorating'";
$list=MySQLGetData($sql);
foreach($list as $k=>$v){
    $name=trim(explode("(",$list[$k]['name'])[0]);
$ticker=explode(")",explode("(",$list[$k]['name'])[1])[0];
    $url="https://etherscan.io/searchHandler?term=".$ticker;echo $url;
    $re=curls($url);
    $re=str_replace("[","",str_replace("]",'',$re));
    $relist=explode(",",$re);
    foreach($relist as $kk=>$vv){
    $tmpname=explode(")",explode("(",$relist[$kk])[1])[0];
        echo $rename=explode(" Token",explode("0x",$relist[$kk])[1])[0];
        if(strtoupper($tmpname)==strtoupper($ticker)&&strtoupper($name)==strtoupper($rename)){
        $token=explode("\\",explode("\\t",$relist[$kk])[1])[0];
            $url1="https://etherscan.io/token/tokenholderchart/".$token."?range=100";
            echo $url1;
        }
    }
    
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