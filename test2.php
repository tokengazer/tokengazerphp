<?php
include('bootstraps.php');

$url = 'https://icorating.com/ico/?filter=all';
$content = file_get_contents_https($url);

$tokenList = getToeknListFromDB();
// echo json_encode($tokenList);
echo count($tokenList).'<br>';

$head1 = '<h2>Investment Rating</h2>';
$end1 = '</tbody>';
$str1 = getSonString($content, $head1, $end1);
$str1 = getSonString($str1, '<tbody>', '</tbody>');
list($res1, $res12) = explainTable($str1);

$head2 = '<h2>Unassessed</h2>';
$end2 = '</tbody>';
$str2 = getSonString($content, $head2, $end2);
$str2 = getSonString($str2, '<tbody>', '</tbody>');
list($res2, $res22) = explainTable($str2);

$res13 = array_intersect($tokenList, $res12);
$res23 = array_intersect($tokenList, $res22);
echo json_encode($res13);
echo json_encode($res23);

// echo json_encode($res1);
// echo '<br>';
// echo json_encode($res2);

// echo $str;

function explainTable($str) {
	$res = array();
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
		$row[0] = getSonString2($row[1], ' (', ')');
		$row[1] = substr($row[1], 0, strpos($row[1], ' '));
		$resList[] = $row;
		$res[] = $row[0];
		// break;
	}
	// echo json_encode($resList);
	return array($resList, $res);
}
