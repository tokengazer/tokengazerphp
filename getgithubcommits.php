<?php
include('bootstraps.php');
$sql="select id, Github_url from ico_Analysis where Github_url <> '' and Github_url <>'https://github.com/' ";
$access_tokenlist=array('b26b6fe9c7beaba6edf83661c666d3ad5588b35a','764fca41598e100fb730e919f2c8793e4a0ceecf','e29a49e909d16af8b8585546e30f95ac0d073c7b','4e576749984599118e4d08c60cb671b1fb8b42cd','0bafb53c51a442f703305a6efa89110d9d1cb432','bf36187659ed6a982026b6b98b7b5c29b8c0ce58','000d0b14d5c3679189027db01830f15185acd80a','7fb8e14f38be5e329c5fd91f53500bddaa79c389','3d17e08990a655987ef012323d96781965b5bed8','af3fdfd6abbc63e62f14309883528ae54f3dfe21');
$list=MySQLGetData($sql);
foreach($list as $k=>$v){
    $round=floor(rand(0,9));

$list[$k]['Github_url']=str_replace(",","",$list[$k]['Github_url']);
    $baseurl=str_replace("https://github.com/","",$list[$k]['Github_url']);
        if(strrpos($baseurl,",")==strlen($baseurl)-1){
        $baseurl=substr($baseurl,0,strlen($baseurl)-1); 
        }
        $baseurl="https://api.github.com/users/".explode("/",$baseurl)[0]."/repos";
    print_r(curls($baseurl,$token));
    
    }
}
function curls($url,$token){
    $access_tokenlist=['b26b6fe9c7beaba6edf83661c666d3ad5588b35a','764fca41598e100fb730e919f2c8793e4a0ceecf','e29a49e909d16af8b8585546e30f95ac0d073c7b','4e576749984599118e4d08c60cb671b1fb8b42cd','0bafb53c51a442f703305a6efa89110d9d1cb432','bf36187659ed6a982026b6b98b7b5c29b8c0ce58','000d0b14d5c3679189027db01830f15185acd80a','7fb8e14f38be5e329c5fd91f53500bddaa79c389','3d17e08990a655987ef012323d96781965b5bed8','af3fdfd6abbc63e62f14309883528ae54f3dfe21'];
    $headers = array(
        'Authorization:token  '.$token.'',
        'Accept:application/vnd.github.hellcat-preview+json',
        'User-Agent: Awesome-Octocat-App',
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


?>