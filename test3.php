<?php
include('bootstraps.php');

// $url = 'https://github.com/ethereum/go-ethereum';
$url = $_GET['url'];
$content = file_get_contents_https($url);

$str = getSonString($content, '<ul class="numbers-summary">', '</ul>');

$watchers = getSonString($content, '/watchers', '/a>');
$watchers = getSonString($watchers, '>', '<');
$watchers = trim($watchers);
$watchers = str_replace(',', '', $watchers);

$stargazers = getSonString($content, '/stargazers', '/a>');
$stargazers = getSonString($stargazers, '>', '<');
$stargazers = trim($stargazers);
$stargazers = str_replace(',', '', $stargazers);

$fork = getSonString($content, '/network', '/a>');
$fork = getSonString($fork, '>', '<');
$fork = trim($fork);
$fork = str_replace(',', '', $fork);

$rowList = explode('<li>', $str);
$resList = array($watchers, $stargazers, $fork);
foreach ($rowList as $row) {
	$res = getSonString($row, '<span', '/span>');
	$res = getSonString($res, '>', '<');
	$res = trim($res);
	$res = str_replace(',', '', $res);
	$resList[] = $res;
}
var_dump($resList);