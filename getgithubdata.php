<?php
include('bootstraps.php');
$sql="select githuburl from project_list where githuburl <> '' ";
$list=MySQLGetData($sql);
foreach($list as $k=>$v){
$list[$k]['githuburl']=str_replace(",","",$list[$k]['githuburl']);
    $baseurl=str_replace("github.com","api.github.com/repos",$list[$k]['githuburl']);
    
    if(strrpos($baseurl,"/")==strlen($baseurl)-1){
    $baseurl=substr($baseurl,0,strlen($baseurl)-1); 
    }
    $data=json_decode(curls($baseurl),true);;
    if(isset($data['message'])){
    //continue;
       // echo $baseurl.",</br>";
    }else{
     echo $baseurl.",</br>";
    $forks=$data['forks_count'];
        $stars=$data['stargazers_count'];
    $watchers=$data['watchers'];
        $lastupdatetime=$data['updated_at'];
        $createtime=date("Y-m-d H:i:s");
    echo $sql="insert into github_data (name,fork,stars,watches,lastupdatetime,createtime) values ('".$baseurl."',".$forks.",".$stars.",".$watchers.",'".$lastupdatetime."','".$createtime."')";
    MySQLRunSQL($sql);
    }
}
function curls($url){
    $access_tokenlist=['80856b3c3c77107e184db763c9198242b814406e','babb77ef878d082ade36adb15cb23d4ac47d0a36','7ead54b12490c8f18c6bc3b7b77f8710f6fc45b0','4c18b27fc9bdbceb0e81865e829dfc7fcfc7ff68','94d25a5f6df38694be6ef8e770beb32b9d76dd52','aec5f39c839cabf8889c24f9587dd0156532ef71','21edef773aeaf7c2784fd0b91394437198220075','fe947f928280c8cc78a784fb53fbb5409b36699e','a68b6711a04bd1e94ce1f61c850041043cadcdb5','358743267e9c6c4d0983e33f7ca9115792a2b85f'];
$headers = array(
        'Authorization:token  b26b6fe9c7beaba6edf83661c666d3ad5588b35a',
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
