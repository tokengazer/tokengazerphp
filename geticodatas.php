<?
include('bootstraps.php');
$sql="select name from ico_Analysis";
$data=MySQLGetData($sql);
foreach($data as $k=>$v){
$url="https://api.coinmarketcap.com/v1/ticker/".$data[$k]['name']."/";
    $results=json_decode(file_get_contents_https($url),true);
    if(isset($results['error'])){
    continue;
    }
    print_r($results);
}

?>