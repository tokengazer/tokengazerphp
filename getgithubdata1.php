55<?php
include('bootstraps.php');
$sql="select id, Github_url from ico_Analysis where Github_url <> '' and Github_url <>'https://github.com/' and GithubWatches=0 ";
$list=MySQLGetData($sql);
foreach($list as $k=>$v){
//$list[$k]['Github_url']=str_replace(",","",$list[$k]['Github_url']);
    $baseurl=str_replace("https://github.com/","https://api.github.com/user/",$list[$k]['Github_url']);
    $baseurl=$list[$k]['Github_url'];
    if(strrpos($baseurl,",")==strlen($baseurl)-1){
    $baseurl=substr($baseurl,0,strlen($baseurl)-1); 
    }
    echo $baseurl;
    $results=json_decode(curls($baseurl."/repos"),true);;
    //print_r(curls($baseurl));
    $forks=$watches=$stars=$commits=0;
    $lastupdatetime="2000-04-10 0:0:0";
    $commits=0;
    
    foreach($results as $kk=>$vv){
    $forks+=$results[$kk]['forks_count'];
        $stars+=$results[$kk]['stargazers_count'];
    $watchers+=$results[$kk]['watchers'];
       $lastupdatetime=bijiaotimes($lastupdatetime,$results[$kk]['pushed_at']);
       /* $commits=0;
    for($i=0;$i<5;$i++){
      $url="https://api.github.com/repos/bitcoin/bitcoin/contributors?page=".$i."&per_page=100";
        $res=json_decode(curls($url),true);
        foreach($res as $kkk=>$vvv){
        $commits+=$res[$kkk]['contributions'];
             $res[$kkk]['contributions']."<br/>";
        }
        if(count($res)==0){
            echo $commits;
        break 1;
        }
        
    }*/
    }
    
    echo $sql="update ico_Analysis set GithubForks=".$forks.",GithubStars=".$stars.",GithubWatches=".$watchers.",Github_lastupdatetime='".$lastupdatetime."' where id=".$list[$k]['id'];
    /*if($k==0){
    break;
    }*/
    MySQLRunSQL($sql);
    /*if(strrpos($baseurl,"/")==strlen($baseurl)-1){
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
    }*/
    
}
function curls($url){
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
function bijiaotimes($time1,$time2){
if(strtotime($time1)<strtotime($time2)){                   //对两个时间差进行差运算
    return $time2;//time1-time2<0，说明time1的时间在前
}else{
    return $time1;//否则，说明time2的时间在前
}
}
