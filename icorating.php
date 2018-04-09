<?php
include('bootstraps.php');
$url = 'https://icorating.com/ico/?filter=all';
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
array_push($str2,$str3);
$i=0;
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
        //$con1=file_get_contents_https($url);
        $str3=explode("github.com/",$con1)[1];
        $str4=explode("\"",$str3)[0];
        $arr[$i]['githuburl']="https://github.com/".$str4;
       
     } 
    else{
        $logo=str_replace("<img src=\"","https://icorating.com",$str2[$k]);
        $logo=str_replace("\" />","",$logo);
        $logo=str_replace("</td>","",$logo);
        $arr[$i]['logo']=$logo;
    
    }
    $ret = $kv->delete('products:'.$i);
        $kv->add('products:'.$i, json_encode($arr[$i],true));
    $sql='insert into project_list (name,logo,githuburl,price,DataSource) values("'.$arr[$i]['name'].'","'.$logo.'","'.$arr[$i]['githuburl'].'",0,"icorating");';
    MySQLRunSQL($sql);
     $kv->get('products:'.$i);
    $i++;
}
echo 1;