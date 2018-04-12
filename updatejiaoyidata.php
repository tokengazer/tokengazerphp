<?php
include('bootstraps.php');
$sql="select * from ico_Analysis ";
$list1=MySQLGetData($sql);
$i=0;
foreach($list1 as $kk=>$vv){
$name=trim(explode("(",$list1[$kk]['name'])[0]);
$data[$kk]['searchname']=str_replace(" ","-",$name);
    $data[$kk]['id']=$list1[$kk]['id'];
}
$kv = new SaeKV();
$ret = $kv->init("xowlw2kmk2");
//$ret = $kv->delete('searchname:all');
  //      $kv->add('searchname:all', json_encode($data,true));
$list=$kv->get("searchname:all");
$list=json_decode($list,true);
foreach($list as $k=>$v){
    //$name=trim(explode("(",$list[$k]['name'])[0]);
//$ticker=explode(")",explode("(",$list[$k]['name'])[1])[0];
    $name=$list[$k]['searchname'];
    echo $url2="https://api.coinmarketcap.com/v1/ticker/".$name."/";
    $results[$k]=json_decode(curls($url2),true);
    if(isset($results[$k]['error'])){
        //print_r($results[$k]);die;
    continue;
    }
    print_r(curls($url2));die;
    $Current_market_value=$results[$k][0]['market_cap_usd'];
    $Current_Circulation=$results[$k][0]['available_supply'];
    $Current_Single_price=$results[$k][0]['price_usd'];
    /*$html=file_get_contents_https("https://coinmarketcap.com/currencies/".$data[$k]['name']."/");
    $tmpstr3=explode("<li><span class=\"glyphicon glyphicon-hdd text-gray\" title=\"Source Code\"></span> ",$html)[1];
    $tmpstr2=explode("<a href=\"",$tmpstr3)[1];
    $tmpstr4=explode("\"",$tmpstr2)[0];
    $githuburl=$tmpstr4;*/
    //echo $sql="update ico_Analysis set Github_url='".$githuburl."' where name='".$data[$k]['name']."'";
    //MySQLRunSQL($sql);
    echo $sql="update ico_Analysis set Current_market_value='".$Current_market_value."',Current_Circulation='".$Current_Circulation."',Current_Single_price='".$Current_Single_price."'  where id='".$list[$k]['id']."'";
    MySQLRunSQL($sql);
    
}
echo $i;

function curls($url){
    $autoFollow=0;
    $post='';
    $ch = curl_init();
        $user_agent = 'Safari Mozilla/5.0 (Macintosh; Intel Mac OS X 10_9_1) AppleWebKit/537.73.11 (KHTML, like Gecko) Version/7.0.1 Safari/5';
        curl_setopt($ch, CURLOPT_USERAGENT, $user_agent);
        // 2. 设置选项，包括URL
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
        curl_setopt($ch, CURLOPT_HEADER, 1); 
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('X-FORWARDED-FOR:61.135.169.125', 'CLIENT-IP:61.135.169.125'));  //构造IP
        curl_setopt($ch, CURLOPT_REFERER, "http://www.baidu.com/");   //构造来路
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');
        if($autoFollow){
            curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);  //启动跳转链接
            curl_setopt($ch, CURLOPT_AUTOREFERER, true);  //多级自动跳转
        }   
        //  
        if($post!=''){
            curl_setopt($ch, CURLOPT_POST, 1);//post提交方式
            curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
        }   
        // 3. 执行并获取HTML文档内容
        $data = curl_exec($ch);
        curl_close($ch);
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