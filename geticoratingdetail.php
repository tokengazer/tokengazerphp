<?php
include('bootstraps.php');
$url="https://icorating.com/ico/crowd-machine/details/";
$html=file_get_contents_https($url);
$str =explode("uk-table",$html)[1];
$str=explode("Pre-ICO start date:",$str)[1];
$PreICOstartdate=getSonString($str,"<td>","</td>");
echo $PreICOstartdate;
$str =explode("uk-table",$html)[2];
$str=explode("ICO start date:",$str)[1];
$ICOstartdate=getSonString($str,"<td>","</td>");
echo $ICOstartdate;
?>