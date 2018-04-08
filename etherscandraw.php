<?php
include('bootstraps.php');
$sql="select * from etherscan_draw where pid=1";
$data=MySQLGetData($sql);
$total=0;
foreach($data as $k=>$v){
$total+=$data[$k]['money'];
}
foreach($data as $k=>$v){
$data[$k]['per']=$data[$k]/$total*100;
}

print_r($data);
?>