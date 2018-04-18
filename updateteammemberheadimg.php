<?php
include('bootstraps.php');
$sql="select headimg from TeamMember";
$data=MySQLGetData($sql);
foreach($data as $kk=>$vv){
if(strpos($data[$kk]['headimg'],'https://icorating.com') === false){
$sql="update TeamMember set headimg='https://icorating.com'".$data[$kk]['headimg']." where id=".$data[$kk]['id'].";";
    MySQLRunSQL($sql);
}
}
?>