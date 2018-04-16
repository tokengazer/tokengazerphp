<?php
include('bootstraps.php');
$url = 'https://icorating.com/ico/all/';
ignore_user_abort(false);
set_time_limit(0);
$content = file_get_contents_https($url);
$kv = new SaeKV();
$ret = $kv->init("xowlw2kmk2");
// echo json_encode($tokenList);
//echo count($tokenList).'<br>';

$head1 = '<h2>Investment Rating</h2>';
$end1 = '</tbody>';
$str1 = getSonString($content, $head1, $end1);
$str1 = getSonString($str1, '<tbody>', '</tbody>');
//print_r($str1);
$str2=explode('<td>',$str1);
$head2 = '<h2>Unassessed</h2>';
$end2 = '</tbody>';
$str3 = getSonString($content, $head2, $end2);
$str3 = getSonString($str3, '<tbody>', '</tbody>');
$count=count($str2);
$str3=explode('<td>',$str3);
$i=-1;
$arr=array();
foreach($str2 as $k=>$v){
    if($k==0||$k%2==0){
    $name=trim(explode("</td",$str2[$k])[0]);
        if(strstr($name,"'>"))
        {
            echo $arr[$i]['name']=$name=explode(">",$name)[1];
        }else{
        $arr[$i]['name']=$name;
        }
         $url=getSonString($str2[$k],"<tr data-href='","'>",$str2[$k]);
        $sql="update ico_Analysis set icolink='".$url."' where name='".$arr[$i]['name']."'";
        if($name==''){
        continue;
        }
    //echo $sql='insert into ico_Analysis (name,logo,Github_url,DataSource) values("'.$arr[$i]['name'].'","'.trim($logo).'","'.$arr[$i]['githuburl'].'","icorating");';
    MySQLRunSQL($sql);
     $kv->get('products:'.$i);
    $i++;
       
     } 
    else{
        $logo=str_replace("<img src=\"","https://icorating.com",$str2[$k]);
        $logo=str_replace("\" />","",$logo);
        $logo=str_replace("</td>","",$logo);
        $arr[$i]['logo']=$logo;
    
    }
   
}

foreach($str3 as $kk=>$vv){
if($kk==0||$kk%2==0){
    $name=trim(explode("</td",$str3[$kk])[0]);
        if(strstr($name,"'>"))
        {
            echo $arr[$i]['name']=$name=explode(">",$name)[1];
        }else{
        $arr[$i]['name']=$name;
        }
         $url=getSonString($str3[$kk],"<tr data-href='","'>",$str3[$kk]);
        //$con1=file_get_contents_https($url);
        $sql="update ico_Analysis set icolink='".$url."' where name='".$arr[$i]['name']."'";
    //$sql='insert into ico_Analysis (name,logo,Github_url,DataSource) values("'.$arr[$i]['name'].'","'.trim($logo).'","'.$arr[$i]['githuburl'].'","icorating");';
    MySQLRunSQL($sql);
     $kv->get('products:'.$i);
    $i++;
       
     } 
    else{
        $logo=str_replace("<img src=\"","https://icorating.com",$str3[$kk]);
        $logo=str_replace("\" />","",$logo);
        $logo=str_replace("</td>","",$logo);
        $arr[$i]['logo']=$logo;
    
    }
}
echo count($str3);
echo 1;