<?php
function curls($url, $data_string) {}$get_url="http://jbmtbl811x-dsn.algolia.net/1/indexes/*/queries?x-algolia-agent=Algolia%20for%20vanilla%20JavaScript%20(lite)%203.21.1%3Binstantsearch.js%201.11.7%3BJS%20Helper%202.19.0&x-algolia-application-id=JBMTBL811X&x-algolia-api-key=bab8508db4e902d54d1603e9d897a285";
$json='{"requests":[{"indexName":"icoalert-production","params":"query=&hitsPerPage=50&page=0&filters=startDate%20%3E%201522294754%20OR%20startDate%20%3D%20-1%20OR%20endDate%20%3D%20-1&facets=%5B%5D&tagFilters="}]}';
$post_datas = curls($get_url, json);

 echo $post_datas;
?>