<?php
include('bootstraps.php');

$sql="select id ,name,icolink from ico_Analysis where name <>'' and DataSource='icorating'";
$data=MySQLGetData($sql);

foreach($data as $k=>$v){
    $url=$data[$k]['icolink'];
//$url="https://icorating.com/ico/crowd-machine/details/";
    $handle=@fopen('datas/'.$data[$k]['name'].'_mainpage.txt', "r");
    if(!$handle){
        $html1=$html=file_get_contents_https($url);
        $myfile = @fopen('datas/'.$data[$k]['name'].'_mainpage.txt', "w");
        fwrite($myfile, $html1);
        fclose($myfile);

    }else{
        $html1=$html=file_get_contents_https($url);
        $myfile = @fopen('datas/'.$data[$k]['name'].'_mainpage.txt', "w");
        fwrite($myfile, $html1);
        fclose($myfile);
        $html1=$html=fread($handle,filesize('datas/'.$data[$k]['name'].'_mainpage.txt'));
        fclose($handle);

    }
}
?>