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
echo json_encode($resList);