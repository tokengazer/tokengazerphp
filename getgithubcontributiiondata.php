<?php
include('bootstraps.php');
$sql="select githuburl from project_list where githuburl <> '' limit 0,10";
$list=MySQLGetData($sql);
foreach($list as $k=>$v){
$list[$k]['githuburl']=str_replace(",","",$list[$k]['githuburl']);
    $baseurl=$list[$k]['githuburl'];
    if(strrpos($baseurl,"/")==strlen($baseurl)-1){
    $baseurl=substr($baseurl,0,strlen($baseurl)-1); 
    }
    $data=json_decode(curls($baseurl."/graphs/contributors-data"),true);;
    if(isset($data['message'])){
    //continue;
       // echo $baseurl.",</br>";
    }else{
        echo $baseurl;
    print_r($data);
    $forks=$data['forks_count'];
    $watchers=$data['watchers'];
    }
}
function curls($url){
    $headers = array(
        'Authorization:token  b26b6fe9c7beaba6edf83661c666d3ad5588b35a',
        'Accept:application/json',
    );
    $curl = curl_init();
    //设置抓取的url
    curl_setopt($curl, CURLOPT_URL, $url);
    //curl_setopt($curl, CURLOPT_POST, 1);
    //设置头文件的信息作为数据流输出
    curl_setopt($curl, CURLOPT_HEADER, 0);
    //设置获取的信息以文件流的形式返回，而不是直接输出。
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);

    curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
    //执行命令
    $data = curl_exec($curl);
    //关闭URL请求
    curl_close($curl);
    //显示获得的数据
    if (substr($data, 0,3) == pack("CCC",0xef,0xbb,0xbf)) {
        $data = substr($data, 3);
    }
    return $data;
  }
