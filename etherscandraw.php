<?php
include('bootstraps.php');
$sql="select sum(`money`) as sum,* from etherscan_draw where pid=1";
$data=MySQLGetData($sql);
print_r($data);

?>