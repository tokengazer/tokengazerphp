<?php
include('bootstraps.php');
ini_set('max_execution_time', '0');
$kv = new SaeKV();
$ret = $kv->init("xowlw2kmk2");
$url = 'https://icodrops.com/category/active-ico/';
$content = file_get_contents_https($url);
$str1 = trim(getSonString($content, "<h3 class=\"col-md-12 col-12 not_rated\">All</h3>", "<div class=\"tabs__content\">"));
$str2=explode("<div class=\"ico-main-info\">",$str1);
unset($str2[0]);
$i=$j=0;
foreach($str2 as $k=>$v){
	$url=explode("\" rel=\"bookmark\">",explode("<h3><a href=\"",$str2[$k])[1])[0];
    $data['logo']=explode("\"",explode("data-src=\"",$str2[$k])[1])[0];
    $data[$k]['Ico_Raise_money']=trim(explode("</div>",explode("<div id='categ_desctop'>",$str2[$k])[1])[0]);
    $arr[$i]['name']=$name=explode("</a>",explode("\" rel=\"bookmark\">",explode("<h3><a href=\"",$str2[$k])[1])[1])[0];
    $contents1=file_get_contents_https($url);
    $arr[$i]['githuburl']=$githuburl="https://github.com/".explode("\"",explode("https://github.com/",$contents1)[1])[0];
    if($arr[$i]['name']!=''){
    $ret = $kv->delete('icodropsproducts:'.$i);
        $kv->add('icodropsproducts:'.$i, json_encode($arr[$i],true));
        if(count(MySQLGetData($sql))>=1){
        $sql="update ico_Analysis set ICO_Raise_money='".$data[$k]['Ico_Raise_money']."' where name='".$name."'";
        }
        else{
    $sql='insert into ico_Analysis (name,logo,Github_url,DataSource) values("'.$arr[$i]['name'].'","'.$data['logo'].'","'.$arr[$i]['githuburl'].'","icodrops");';
    
        }
        MySQLRunSQL($sql);
     $kv->get('icodropsproducts:'.$i);
    }
    $i++;$j++;
    
}

$url = 'https://icodrops.com/category/upcoming-ico/';
$content = file_get_contents_https($url);
$str1 = trim(getSonString($content, "<h3 class=\"col-md-12 col-12 not_rated\">All</h3>", "<div class=\"tabs__content\">"));
$str2=array();
$str2=explode("<div class=\"ico-main-info\">",$str1);
unset($str2[0]);
foreach($str2 as $k=>$v){
	$url=explode("\" rel=\"bookmark\">",explode("<h3><a href=\"",$str2[$k])[1])[0];
    $data['logo']=explode("\"",explode("data-src=\"",$str2[$k])[1])[0];
    $arr[$j]['name']=$name=explode("</a>",explode("\" rel=\"bookmark\">",explode("<h3><a href=\"",$str2[$k])[1])[1])[0];
    $contents1=file_get_contents_https($url);
    $arr[$j]['githuburl']=$githuburl="https://github.com/".explode("\"",explode("https://github.com/",$contents1)[1])[0];
    $i++;
    if($arr[$j]['name']!=''){
        $sql="select * from ico_Analysis where name ='".$arr[$j]['name']."'";
        if(count(MySQLGetData($sql))>=1){
        
        }
        else{
        $sql='insert into ico_Analysis (name,logo,Github_url,DataSource) values("'.$arr[$j]['name'].'","'.$data['logo'].'","'.$arr[$j]['githuburl'].'","icodrops");';
     MySQLRunSQL($sql);
        }
    $ret = $kv->delete('icodropsproducts:'.$i);
        $kv->add('icodropsproducts:'.$i, json_encode($arr[$i],true));
    $sql='insert into ico_Analysis (name,logo,Github_url,DataSource) values("'.$arr[$j]['name'].'","'.$data['logo'].'","'.$arr[$j]['githuburl'].'","icodrops");';
   
     $kv->get('icodropsproducts:'.$j);
        
    }
    $j++;
}
$i=0;
$url = 'https://icodrops.com/category/ended-ico/';
$content = file_get_contents_https($url);
$str1 = trim(getSonString($content, "<h3 class=\"col-md-12 col-12 not_rated\">All</h3>", "<div class=\"tabs__content\">"));
$str2=array();
$str2=explode("<div class=\"ico-main-info\">",$str1);
unset($str2[0]);
foreach($str2 as $k=>$v){
	$url=explode("\" rel=\"bookmark\">",explode("<h3><a href=\"",$str2[$k])[1])[0];
    $data['logo']=explode("\"",explode("data-src=\"",$str2[$k])[1])[0];
    $arr[$j]['name']=$name=explode("</a>",explode("\" rel=\"bookmark\">",explode("<h3><a href=\"",$str2[$k])[1])[1])[0];
    $contents1=file_get_contents_https($url);
    $arr[$j]['githuburl']=$githuburl="https://github.com/".explode("\"",explode("https://github.com/",$contents1)[1])[0];
    $i++;
    if($arr[$j]['name']!=''){
    $ret = $kv->delete('icodropsproducts:'.$i);
        $kv->add('icodropsproducts:'.$i, json_encode($arr[$i],true));
    $sql='insert into ico_Analysis (name,logo,Github_url,DataSource) values("'.$arr[$j]['name'].'","'.$data['logo'].'","'.$arr[$j]['githuburl'].'","icodrops");';
    MySQLRunSQL($sql);
     $kv->get('icodropsproducts:'.$j);
        
    }
    $j++;
}
$ret = $kv->delete('icodropsproducts:all');
        $kv->add('icodropsproducts:all', json_encode($arr,true));
    
     $kv->get('icodropsproducts:all');
