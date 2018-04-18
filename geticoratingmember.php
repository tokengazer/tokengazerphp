<?php
include('bootstraps.php');
$sql="select * from ico_Analysis where name <>'' and DataSource='icorating' and id=1296";
$data=MySQLGetData($sql);
foreach($data as $k=>$v){
 $url=$data[$k]['icolink'];

//$url="https://icorating.com/ico/crowd-machine/details/";
    
$html1=$html=file_get_contents_https($url.'team/');
MySQLRunSQL($sql);
    $founders=explode("<tbody>",$html1)[1];
   $tmparr=explode("<tr>",$founders);
    unset($tmparr[1]);
    foreach($tmparr as $kk=>$vv){
    print_r($tmparr);
    }
}
?>