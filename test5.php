<?php
include('bootstraps.php');

$header = array("X-MBX-APIKEY:".$ak, "Content-Type:application/x-www-form-urlencoded");
$url = 'https://jbmtbl811x-dsn.algolia.net/1/indexes/*/queries?x-algolia-agent=Algolia%20for%20vanilla%20JavaScript%20(lite)%203.21.1%3Binstantsearch.js%201.11.7%3BJS%20Helper%202.19.0&x-algolia-application-id=JBMTBL811X&x-algolia-api-key=5014b83b888fdd4e8a4b9e62da739c96';

$table = '{"requests":[{"indexName":"icoalert-production-active-presale","params":"query=&hitsPerPage=30&page=0&facets=%5B%22title%22%2C%22preSale%22%5D&tagFilters=&facetFilters=%5B%22preSale%3Atrue%22%5D"}]}';

// var_dump($table);

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, $table);
curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
$ret = curl_exec($ch);
var_dump($ret);
curl_close($ch);