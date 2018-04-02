<?php
include('bootstraps.php');
function curls($url, $data_string) {
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_HEADER, 0);//获取头部
    //curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    /*curl_setopt($ch, CURLOPT_HTTPHEADER, array(
        'X-AjaxPro-Method:ShowList',
        'User-Agent:Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/33.0.1750.154 Safari/537.36',
    ));*/
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
    $data = curl_exec($ch);
    curl_close($ch);
    
    return $data;
                }
$get_url="https://jbmtbl811x-dsn.algolia.net/1/indexes/*/queries?x-algolia-agent=Algolia%20for%20vanilla%20JavaScript%20(lite)%203.21.1%3Binstantsearch.js%201.11.7%3BJS%20Helper%202.19.0&x-algolia-application-id=JBMTBL811X&x-algolia-api-key=bab8508db4e902d54d1603e9d897a285";
$json='{"requests":[{"indexName":"icoalert-production-recent-presale","params":"query=&hitsPerPage=2000&page=0&filters=preSaleEndDate%20%3E%200%20AND%20preSaleEndDate%20%3C%201522294754&facets=%5B%22preSale%22%5D&tagFilters=&facetFilters=%5B%22preSale%3Atrue%22%5D"}]}';
$post_datas = curls($get_url, $json);

$datas=json_decode($post_datas,true)['results'][0];
$tmp=$datas['hits'];

foreach($tmp as $k=>$v){
    
$sql="INSERT INTO `IcoalertData` (`craftEntryId`, `dateCreated`, `description`, `endDate`, `featuredListing`, `icoID`, `kyc`, `objectID`, `preFeaturedListing`, `preSale`, `preSaleEndDate`, `preSaleStartDate`, `preSaleStartDay`, `preSaleStartMonth`, `preSaleStartQuarter`, `preSaleStartYear`, `preSaleTbd`, `reportAvailable`, `reportLink`, `startDate`, `startDay`, `startMonth`, `startQuarter`, `startYear`, `tags`, `tbd`, `title`, `usExcludedOption`, `verified`, `website`) VALUES ('".$tmp[$k]['craftEntryId']."', '".$tmp[$k]['dateCreated']."', '".$tmp[$k]['description']."', '".$tmp[$k]['endDate']."', '".$tmp[$k]['featuredListing']."', '".$tmp[$k]['icoID']."', '".$datas['hits'][$k]['kyc']."', '".$datas['hits'][$k]['objectID']."', '".$tmp[$k]['preFeaturedListing']."', '".$tmp[$k]['preSale']."', '".$tmp[$k]['preSaleEndDate']."', '".$tmp[$k]['preSaleStartDate']."', '".$tmp[$k]['preSaleStartDay']."', '".$tmp[$k]['preSaleStartMonth']."', '".$datas['hits'][$k]['preSaleStartQuarter']."', '".$tmp[$k]['preSaleStartYear']."', '".$tmp[$k]['preSaleTbd']."', '".$tmp[$k]['reportAvailable']."', '".$tmp[$k]['reportLink']."', '".$tmp[$k]['startDate']."', '".$tmp[$k]['startDay']."', '".$tmp[$k]['startMonth']."', '".$tmp[$k]['startQuarter']."', '".$tmp[$k]['startYear']."', '".$tmp[$k]['tags']."', '".$tmp[$k]['tbd']."', '".$tmp['title']."', '".$tmp[$k]['usExcludedOption']."', '".$tmp[$k]['verified']."', '".$tmp[$k]['website']."');";
print_r(MySQLRunSQL($sql));
   
}
?>

