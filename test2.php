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
$res1 = explainTable($str1, $tokenList);

$head2 = '<h2>Unassessed</h2>';
$end2 = '</tbody>';
$str2 = getSonString($content, $head2, $end2);
$str2 = getSonString($str2, '<tbody>', '</tbody>');
$res2 = explainTable($str2, $tokenList);

// echo json_encode($res1);
// echo '<br>';
// echo json_encode($res2);

// echo $str;

function explainTable($str, $tokenList = array()) {
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
		if(!in_array($row[0], $tokenList)) {
			echo $row[0].',';
		}
		$row[1] = substr($row[1], 0, strpos($row[1], ' '));
		$resList[] = $row;
		// break;
	}
	// echo json_encode($resList);
	return $resList;
}
