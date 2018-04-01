<?php
function curls($url, $data_string) {
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array(
        'X-AjaxPro-Method:ShowList',
        'User-Agent:Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/33.0.1750.154 Safari/537.36',
    ));
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
    $data = curl_exec($ch);
    curl_close($ch);
    return $data;
                }
$get_url="http://jbmtbl811x-dsn.algolia.net/1/indexes/*/queries?x-algolia-agent=Algolia%20for%20vanilla%20JavaScript%20(lite)%203.21.1%3Binstantsearch.js%201.11.7%3BJS%20Helper%202.19.0&x-algolia-application-id=JBMTBL811X&x-algolia-api-key=bab8508db4e902d54d1603e9d897a285";
$json='{"requests":[{"indexName":"icoalert-production","params":"query=&hitsPerPage=20000&page=0&filters=startDate%20%3E%201522294754%20OR%20startDate%20%3D%20-1%20OR%20endDate%20%3D%20-1&facets=%5B%5D&tagFilters="}]}';
$post_datas = curls($get_url, $json);

$datas=json_decode($post_datas,true);print_r($dtas);die;
foreach($datas as $k=>$v){
//$sql="INSERT INTO `app_tokenworm`.`IcoalertData` (`craftEntryId`, `dateCreated`, `description`, `endDate`, `featuredListing`, `icoID`, `kyc`, `objectID`, `preFeaturedListing`, `preSale`, `preSaleEndDate`, `preSaleStartDate`, `preSaleStartDay`, `preSaleStartMonth`, `preSaleStartQuarter`, `preSaleStartYear`, `preSaleTbd`, `reportAvailable`, `reportLink`, `startDate`, `startDay`, `startMonth`, `startQuarter`, `startYear`, `tags`, `tbd`, `title`, `usExcludedOption`, `verified`, `website`) VALUES ('".$v['craftEntryId']."', '".$v['dateCreated']."', '".$v['description']."', '".$v['endDate']."', '".$v['featuredListing']."', '".$v['icoID'].."', '".$v['kyc']."', '".$v['objectID']."', '".$v['preFeaturedListing']."', '".$v['preSale']."', '".$v['preSaleEndDate']."', '".$v['preSaleStartDate']."', '".$v['preSaleStartDay']."', '".$v['preSaleStartMonth']."', '".$v['preSaleStartQuarter']."', '".$v['preSaleStartYear']."', '".$v['preSaleTbd']."', '".$v['reportAvailable']."', '".$v['reportLink']."', '".$v['startDate']."', '".$v['startDay']."', '".$v['startMonth']."', '".$v['startQuarter']."', '".$v['startYear']."', '".$v['tags']."', '".$v['tbd']."', '".$v['title']."', '".$v['usExcludedOption']."', '".$v['verified']."', '".$v['website']."');";
 //MySQLRunSQL($sql);
}
?>