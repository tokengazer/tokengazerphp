<?php
include('bootstraps.php');

if(isset($_GET['p'])){
$p=$_GET['p'];
}
else{
$p='';
}
$kv = new SaeKV();
$ret = $kv->init("xowlw2kmk2");
$sql="select * from ico_Analysis where id<=499  and website=''";
$coinmarketmap=json_decode(file_get_contents_https("https://s2.coinmarketcap.com/generated/search/quick_search.json"),true);
foreach($coinmarketmap as $k=>$v){
$sql="select * from ico_Analysis where name='".$coinmarketmap[$k]['name']."';";
    $re=MySQLGetData($sql);
    if(count($re)==0){
    $sql="insert into ico_Analysis (id,name,ticker,DataSource) value (NULL,'".$coinmarketmap[$k]['name']."','".$coinmarketmap[$k]['tokens'][1]."','coinmarket');";
        $id=MySQLRunSQL($sql);
    }
    else{
    $id=$re[0]['id'];
    }
    echo $sql="insert into coin_rank values(Null,".$id.",".$coinmarkermap[$k]['rank'].");";
    MySQLRunSQL($sql);
}
return;
//print_r($coinmarketmap);die;
//$sql="select * from ico_Analysis where id<=499 and Github_url='' and id>399";
$url1=MySQLGetData($sql);
    //$content=getSonString($content,"<tbody>","</tbody>");
//$url1 = getSonStrings($content, '<span class="currency-symbol"><a href="','">');
$githuburl=array();
$i=$start;
$arr=array();
foreach($url1 as $k=>$v){
    set_time_limit();
    foreach($coinmarketmap as $kk=>$vv){
    if($coinmarketmap[$kk]['name']==$url1[$k]['name']){
    $url1[$k]['name']=$coinmarketmap[$kk]['tokens'][1];
    }
    }
//$contents1=file_get_contents_https("https://coinmarketcap.com".$url1[$k]);
    $contents1=file_get_contents_https("https://coinmarketcap.com/currencies/".strtolower($url1[$k]['name']).'/');
    $arr[$i]['name']=$url1[$k]['id'];//echo "https://coinmarketcap.com/currencies/".$url1[$k]['id'];
    //print_r($contents1);die;
    $arr[$i]['githuburl']=$github[$i]=getSonString($contents1,'<span class="glyphicon glyphicon-hdd text-gray" title="Source Code"></span> <a href="','" target="');
    $arr[$i]['website']=$website=explode("\"",explode("<li><span class=\"glyphicon glyphicon-link text-gray\" title=\"Website\"></span> <a href=\"",$contents1)[1])[0];
    $kv->delete('products:'.$i);
    $kv->add('products:'.$i, json_encode($arr[$i],true));
    $kv->get('products:'.$i);
    $kv->delete('coinmarketproducts:'.$i);
    $kv->add('coinmarketproducts:'.$i, json_encode($arr[$i],true));
    $kv->get('coinmarketproducts:'.$i);
    echo $sql="update ico_Analysis set website='$website',Github_url='".$arr[$i]['githuburl']."' where id=".$url1[$k]['id']."";
        MySQLRunSQL($sql);
    $i++;
}
$page=$p+1;
echo $p.'完成';
if($p==8){
return false;
}
//header("Location http://tokenworm.applinzi.com/coinmarketcap.php?p=".$page);
// 初始化SaeKV对象
//访问授权应用的数据


