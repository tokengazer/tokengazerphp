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
    print_r($founders);
    foreach($founders as $kk=>$vv){
    $tmparr=explode("<tr>",$founders[$kk]);
        unset($tmparr);
        print_r($tmparr);
    }
}
?>