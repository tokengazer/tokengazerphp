<?php
$url="https://icorating.com/ico/crowd-machine/details/";
$html=file_get_contents_https($url);
$str =explode("uk-table",$html)[0];
$str=explode("Pre-ICO start date:",$str)[1];
$str=getSonString($str,"<td>","</td>");
echo $str;
?>