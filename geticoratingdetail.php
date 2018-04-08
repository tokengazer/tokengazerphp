<?php
include('bootstraps.php');
$url="https://icorating.com/ico/crowd-machine/details/";
$html=file_get_contents_https($url);
echo $str =explode("uk-table",$html)[0];
echo $str=explode("Pre-ICO start date:",$str)[1];
$str=getSonString($str,"<td>","</td>");
echo $str;
?>