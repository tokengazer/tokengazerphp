<?php
include('bootstraps.php');
$sql="select * from ico_Analysis where DataSource='icorating' and id NOT in(1296,1297,1299,1300,1302,1303,1304,1305,1306,1307,138,1309,1310,1311,1312,1314,1315,1316,1319,1320,1321,1322,1324,1325,1326,1327,1328,1329,1330,1331,1332,1333,1334,1335,1336,1337,1338,1339,1340,1341,1342,13431344,1345,1346,1347,1348,1349,1352,1353,1355,1357,1358,1359,1360,1361,1362,1363,1364,1365,1366,1367,1368,1369,1371,1373)";
//$sql="select * from ico_Analysis as a where a.name <>'' and DataSource='icorating' and a.id not in( select pid from TeamMember)";
$data=MySQLGetData($sql);
foreach($data as $k=>$v){
 $url=$data[$k]['icolink'];
    $id=$data[$k]['id'];

//$url="https://icorating.com/ico/crowd-machine/details/";
    
$html1=$html=file_get_contents_https($url.'team/');
MySQLRunSQL($sql);
    $founders=explode("<tbody>",$html1)[1];
   $tmparr=explode("<tr>",$founders);
    unset($tmparr[0]);
    if(count($tmparr)==0){
    continue;
    }
    unset($tmparr[count($tmparr)]);
    foreach($tmparr as $kk=>$vv){
        $data[$k]['member'][$kk]['headimg']="https://icorating.com".explode("\"",explode("src=\"",$tmparr[$kk])[1])[0];
        $data[$k]['member'][$kk]['name']=explode("\"",explode("<a title=\"",$tmparr[$kk])[1])[0];
        $data[$k]['member'][$kk]['linkedin']="https://www.linkedin.com".explode("\"",explode("https://www.linkedin.com",$tmparr[$kk])[1])[0];
        $sql="select * from TeamMember where name='".$data[$k]['member'][$kk]['name']."' and pid=$id";
        if(count(MySQLGetData($sql))>0){
        
        }else{
         $sql="insert into TeamMember values(NULL,'".$data[$k]['member'][$kk]['name']."','".$data[$k]['member'][$kk]['headimg']."',$id,'".$data[$k]['member'][$kk]['linkedin']."','founder')";
            MySQLRunSQL($sql);
        }
    }
    $founders=explode("<tbody>",$html1)[2];
    
   $tmparr=explode("<tr>",$founders);
    unset($tmparr[0]);
    if(count($tmparr)==0){
    continue;
    }
    foreach($tmparr as $k1=>$v1){
    $data[$k]['member'][$k1]['headimg']="https://icorating.com".explode("\"",explode("src=\"",$tmparr[$k1])[1])[0];
        $data[$k]['member'][$k1]['name']=explode("\"",explode("<a title=\"",$tmparr[$k1])[1])[0];
        $data[$k]['member'][$k1]['linkedin']="https://www.linkedin.com".explode("\"",explode("https://www.linkedin.com",$tmparr[$k1])[1])[0];
        $sql="select * from TeamMember where name='".$data[$k]['member'][$k1]['name']."' and pid=$id";
        if(count(MySQLGetData($sql))>0){
        
        }else{
         $sql="insert into TeamMember values(NULL,'".$data[$k]['member'][$k1]['name']."','".$data[$k]['member'][$k1]['headimg']."',$id,'".$data[$k]['member'][$k1]['linkedin']."','Advisors')";
            MySQLRunSQL($sql);
        }
    }
}
?>