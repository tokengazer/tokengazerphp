<?php
include('bootstraps.php');

$url = 'https://coinmarketcap.com/all/views/all/';
$content = file_get_contents($url);

$str = getSonString($content, '<div class="table-responsive compact-name-column">', '<div class="pull-right');
$str = getSonString($str, '<tbody>', '</tbody>');
// echo $str;

$rowList = explode('</tr>', $str);
$resList = array();
foreach ($rowList as $row) {
	$colList = explode('</td>', $row);
	$row = array();
	foreach ($colList as $col) {
		// var_dump($col);
		$colvalue = trim(getSonString2($col, '>', '<'));
		// echo $colvalue.'<br>';
		$row[] = $colvalue;
		// break;
	}
	array_pop($row);
	$resList[] = $row;
	// break;
}

// foreach ($resList as $res) {
// 	$symbol = $res[2];
// 	$name = $res[1];
// 	$sql = "insert into `basic_token_list` (`symbol`,`name`) values ('".$symbol."','".$name."');";
// 	MySQLRunSQL($sql);
// 	echo $symbol.',';
// }
// echo json_encode($resList);

$sql = "select * from `basic_token_list`";
$table = MySQLGetData($sql);
if(count($resList) > count($table)) {
	for($i = count($table); $i < count($resList); $i++) {
		$res = $resList[$i];
		$symbol = $res[2];
		$name = $res[1];
		$sql = "insert into `basic_token_list` (`symbol`,`name`) values ('".$symbol."','".$name."');";
		MySQLRunSQL($sql);
		echo $symbol.',';
	}
}