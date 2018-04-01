<?php
$url='https://www.tokendata.io/icos/active?_='.time().'000';
    $data=file_get_contents($url);
$data=json_decode($data,true);
foreach($data as $k=>v){
$sql="INSERT INTO  `app_tokenworm`.`tokendada` (
`id` ,
`description` ,
`end_date` ,
`featured_until` ,
`month` ,
`name` ,
`name_lower` ,
`start_date` ,
`status` ,
`website` ,
`whitepaper` ,
`_id`
)
VALUES (
NULL ,  '".$data[$k]['description']."',  '".$data[$k]['end_date']."',  '".$data[$k]['featured_until']."',  
'".$data[$k]['month']."',  '".$data[$k]['name']."',  
'".$data[$k]['name_lower']."',  '".$data[$k]['start_date']."',  '".$data[$k]['status']."',  '".$data[$k]['website']."',  '".$data[$k]['whitepaper']."',  '".$data[$k]."'
);";
    MySQLRunSQL($sql);
}
?>