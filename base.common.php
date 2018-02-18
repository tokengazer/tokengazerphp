<?php
function getToeknListFromDB() {
	$sql = "select `symbol` from `basic_token_list`;";
	$data = MySQLGetData($sql);
	$res = array();
	foreach ($data as $row) {
		$res[] = $row['symbol'];
	}
	return $res;
}