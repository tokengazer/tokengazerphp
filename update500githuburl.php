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

$sql="select * from ico_Analysis where id<=499 and Github_url=''";
$url1=MySQLGetData($sql);
    //$content=getSonString($content,"<tbody>","</tbody>");
//$url1 = getSonStrings($content, '<span class="currency-symbol"><a href="','">');
$githuburl=array();
$i=$start;
$arr=array();
foreach($url1 as $k=>$v){
    set_time_limit();
//$contents1=file_get_contents_https("https://coinmarketcap.com".$url1[$k]);
    $contents1=file_get_contents_https("https://coinmarketcap.com/currencies/".$url1[$k]['name'].'/');
    $arr[$i]['name']=$url1[$k]['id'];//echo "https://coinmarketcap.com/currencies/".$url1[$k]['id'];
    //print_r($contents1);die;
    $arr[$i]['githuburl']=$githuburl[$i]=getSonString($contents1,'<span class="glyphicon glyphicon-hdd text-gray" title="Source Code"></span> <a href="','" target="');
    $kv->delete('products:'.$i);
    $kv->add('products:'.$i, json_encode($arr[$i],true));
    $kv->get('products:'.$i);
    $kv->delete('coinmarketproducts:'.$i);
    $kv->add('coinmarketproducts:'.$i, json_encode($arr[$i],true));
    $kv->get('coinmarketproducts:'.$i);
    echo $sql="update set Github_url='".$arr[$i]['githuburl']."' where id=".$url1[$k]['id']."";
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


