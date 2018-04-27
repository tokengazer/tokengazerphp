<?php
/**
 * Created by PhpStorm.
 * User: lybjx
 * Date: 2018/4/27
 * Time: 09:03
 */
include('bootstraps.php');
$sql="select * from ico_Analysis where Current_market_value<>'';";
$list=MySQLGetData($sql);
foreach($list as $kk=>$vv){
    //$url="https://www.feixiaohao.com/currencies/".$list[$kk]['name']."/";
    $url="https://www.feixiaohao.com/currencies/EOS/";
    echo $html=file_get_contents_https($url);
    if(strstr("<table class=\"iCOtable\">",$html)) {echo 1;
        $table = explode("<table class=\"iCOtable\">", $html)[1];
        $tr = explode("<tr>", $table)[2];
        echo $td = explode("<td>", explode("</td>", $tr)[2])[0];

        echo $sql="update ico_Analysis set presale='$td' where id=".$list[$kk]['id'];
        MySQLRunSQL($sql);
    }die;
}