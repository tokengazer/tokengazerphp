<?php
function file_get_contents_https($url) {
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_HEADER, false);
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_SSLVERSION,4);
	curl_setopt($ch, CURLOPT_CAINFO, __DIR__ . "/cacert.pem");
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	$content = curl_exec($ch);
	curl_close($ch);
	return $content;
}

function getSonString($parent,$start,$end) {
    $a1 = explode($start, $parent);
    $a2 = explode($end, $a1[1]);
    return $a2[0];
}

function getSonString2($parent,$start,$end) {
    $a1 = explode($start, $parent);
    $a2 = explode($end, $a1[count($a1) - 1]);
    if(trim($a2[0]) == '') {
    	$a2 = explode($end, $a1[count($a1) - 2]);
    }
    return $a2[0];
}

function MySQLGetData($sql) {
	$mysqli = mysqli_connect(SAE_MYSQL_HOST_M,SAE_MYSQL_USER,SAE_MYSQL_PASS,SAE_MYSQL_DB,SAE_MYSQL_PORT);
	if ($mysqli->connect_error) {
	    $mysqli->close();
	    return false;
	} 
	$mysqli->query("SET NAMES utf8");
	$ret = $mysqli->query($sql);
    $data = array();
    if($ret) {
	    while($row = mysqli_fetch_array($ret,MYSQLI_ASSOC)) {
	    	$data[] = $row;
	    }
    }
    $mysqli->close();
	return $data;
}

function MySQLRunSQL($sql) { 
	$link = mysqli_connect(SAE_MYSQL_HOST_M,SAE_MYSQL_USER,SAE_MYSQL_PASS,SAE_MYSQL_DB,SAE_MYSQL_PORT);

	if($link) {
	    //mysqli_select_db('umms',$link);
		$link->query("SET NAMES utf8");
	    $ret = mysqli_query($link, $sql);
	    mysqli_close($link);
		return $ret;
	} else {
		return false;
	}
}

function MySQLRunSQLBatch($sqlArray) { 
	$link = mysqli_connect(SAE_MYSQL_HOST_M,SAE_MYSQL_USER,SAE_MYSQL_PASS,SAE_MYSQL_DB,SAE_MYSQL_PORT);
	if($link) {
	    //mysqli_select_db('umms',$link);
		$link->query("SET NAMES utf8");
	    foreach ($sqlArray as $sql) {
			$ret = mysqli_query($link, $sql);
		}
	    mysqli_close($link);
		return $ret;
	} else {
		return false;
	}
}