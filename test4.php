<?php
include('bootstraps.php');

$url = "http://www.icocountdown.com/";
$content = file_get_contents($url);

$parts = explode('content_countdown', $content);
$res = array();
foreach ($parts as $part) {
	$res[] = array(getSonString2($part, '>', '<'));
}

$parts = explode('end:', $content);
for ($i = 1; $i < count($parts) ; $i++) { 
	$part = $parts[$i];
	$vals = explode("'", $part);
	$vals2 = explode('<a', $part);
	$res[$i - 1][] = $vals[1];
	// echo $vals2[1].'<br>';
	$res[$i - 1][] = getSonString($vals2[1], '="', '"');
}
echo json_encode($res);