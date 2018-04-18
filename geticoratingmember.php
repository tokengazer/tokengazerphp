<?php
include('bootstraps.php');
$sql="select * from ico_Analysis where name <>'' and DataSource='icorating' and id=1296";
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
    $data[$k]['member'][$k1]['headimg']=explode("\"",explode("src=\"",$tmparr[$k1])[1])[0];
        $data[$k]['member'][$k1]['name']=explode("\"",explode("<a title=\"",$tmparr[$k1])[1])[0];
        $data[$k]['member'][$k1]['linkedin']="https://www.linkedin.com".explode("\"",explode("https://www.linkedin.com",$tmparr[$k1])[1])[0];
        echo $sql="select * from TeamMember where name='".$data[$k]['member'][$k1]['name']."' and pid=$id";
        if(count(MySQLGetData($sql))>0){
        
        }else{
        echo $sql="insert into TeamMember values(NULL,'".$data[$k]['member'][$k1]['name']."','".$data[$k]['member'][$k1]['headimg']."',$id,'".$data[$k]['member'][$k1]['linkedin']."','Advisors')";
            MySQLRunSQL($sql);
        }
    }
}
?>