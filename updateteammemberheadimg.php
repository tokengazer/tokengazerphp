<?php
include('bootstraps.php');
$sql="select id, headimg from TeamMember";
$data=MySQLGetData($sql);
foreach($data as $kk=>$vv){
if(strpos($data[$kk]['headimg'],'https://icorating.com') === false){
echo $sql="update TeamMember set headimg='https://icorating.com".$data[$kk]['headimg']."' where id=".$data[$kk]['id'].";";
    MySQLRunSQL($sql);
}
}
?>