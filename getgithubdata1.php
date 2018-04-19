<?php
include('bootstraps.php');
$sql="select id, Github_url from ico_Analysis where Github_url <> '' and Github_url <>'https://github.com/' ";
$access_tokenlist=array('b26b6fe9c7beaba6edf83661c666d3ad5588b35a','764fca41598e100fb730e919f2c8793e4a0ceecf','e29a49e909d16af8b8585546e30f95ac0d073c7b','4e576749984599118e4d08c60cb671b1fb8b42cd','0bafb53c51a442f703305a6efa89110d9d1cb432','bf36187659ed6a982026b6b98b7b5c29b8c0ce58','000d0b14d5c3679189027db01830f15185acd80a','7fb8e14f38be5e329c5fd91f53500bddaa79c389','3d17e08990a655987ef012323d96781965b5bed8','af3fdfd6abbc63e62f14309883528ae54f3dfe21');
    //echo count($access_tokenlist);die;
//print_r($access_tokenlist);die;
$list=MySQLGetData($sql);

$limit=ceil(count($list)/10);

foreach($list as $k=>$v){
    //$list[$k]['Github_url']=str_replace(",","",$list[$k]['Github_url']);
        $baseurl=str_replace("https://github.com/","",$list[$k]['Github_url']);
        if(strrpos($baseurl,",")==strlen($baseurl)-1){
        $baseurl=substr($baseurl,0,strlen($baseurl)-1); 
        }
        $baseurl="https://api.github.com/users/".explode("/",$baseurl)[0]."/repos";
        for($i=0;$i<10;$i++){
        if($k<=($i+1)*$limit&&$k>$i*$limit){
        $url[$i][$k]['url']=$baseurl;
            $url[$i][$k]['token']=$access_tokenlist[$i];
            if(count($url[$i])==$limit){
            continue;
            }
        }
    }
    
}
$mh = curl_multi_init();  
foreach($url as $kk=>$vv){
    foreach($url[$kk] as $kkk=>$vvv){
	$conn[$kk] = curl_init($url[$kk][$kkk]['url']);   
      curl_setopt($conn[$kk], CURLOPT_USERAGENT, "Mozilla/4.0 (compatible; MSIE 7.0; Windows NT 6.0)");   
      curl_setopt($conn[$kk], CURLOPT_HEADER ,0);   
      curl_setopt($conn[$kk], CURLOPT_CONNECTTIMEOUT,60);   
      curl_multi_add_handle ($mh,$conn[$kk]); 
        $headers = array(
        'Authorization:token  '.$url[$kk][$kkk]['token'].'',
        'Accept:application/vnd.github.hellcat-preview+json',
        'User-Agent: Awesome-Octocat-App',
    );
        curl_setopt($conn[$kk], CURLOPT_HTTPHEADER, $headers);
        
    }
}
     
do {   
  $re=curl_multi_exec($mh,$active); 
    $results=json_decode($re,true);;
    //print_r(curls($baseurl));
    $forks=$watchers=$stars=$commits=0;
    $lastupdatetime="2000-04-10 0:0:0";
    $commits=0;
    
    foreach($results as $kk=>$vv){
        $url=$results[$kk]['url'];
        $re=json_decode(curls($url),true);
    $forks+=$re['network_count'];
        $stars+=$re['stargazers_count'];
    $watchers+=$re['subscribers_count'];
       $lastupdatetime=bijiaotimes($lastupdatetime,$results[$kk]['pushed_at']);
        $commits=0;
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
        
    }}
    echo $sql="update ico_Analysis set GithubForks=".$forks.",GithubStars=".$stars.",GithubWatches=".$watchers.",Github_lastupdatetime='".$lastupdatetime."' where id=".$list[$k]['id'];
    /*if($k==0){
    break;
    }*/
    MySQLRunSQL($sql);
    $forks=$watches=$stars=$commits=0;
    if(strrpos($baseurl,"/")==strlen($baseurl)-1){
    $baseurl=substr($baseurl,0,strlen($baseurl)-1); 
    }
    $data=json_decode(curls($baseurl),true);;
    if(isset($data['message'])){
    //continue;
       // echo $baseurl.",</br>";
    }
} while ($active);  // 执行   
     
foreach($url as $kk=>$vv){
    foreach($url[$kk] as $kkk=>$vvv){
	curl_multi_remove_handle($mh,$conn[$kk]);   
  curl_close($conn[$kk]);   
}} // 结束清理   
     
curl_multi_close($mh);   

/*
    $results=json_decode(curls($baseurl),true);;
    //print_r(curls($baseurl));
    $forks=$watchers=$stars=$commits=0;
    $lastupdatetime="2000-04-10 0:0:0";
    $commits=0;
    
    foreach($results as $kk=>$vv){
        $url=$results[$kk]['url'];
        $re=json_decode(curls($url),true);
    $forks+=$re['network_count'];
        $stars+=$re['stargazers_count'];
    $watchers+=$re['subscribers_count'];
       $lastupdatetime=bijiaotimes($lastupdatetime,$results[$kk]['pushed_at']);
        $commits=0;
    /*for($i=0;$i<5;$i++){
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
   /* }
    
    
    echo $sql="update ico_Analysis set GithubForks=".$forks.",GithubStars=".$stars.",GithubWatches=".$watchers.",Github_lastupdatetime='".$lastupdatetime."' where id=".$list[$k]['id'];
    /*if($k==0){
    break;
    }*/
    /*MySQLRunSQL($sql);
    $forks=$watches=$stars=$commits=0;
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
    
//}
function curls($url,$token){
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
function bijiaotimes($time1,$time2){
if(strtotime($time1)<strtotime($time2)){                   //对两个时间差进行差运算
    return $time2;//time1-time2<0，说明time1的时间在前
}else{
    return $time1;//否则，说明time2的时间在前
}
}
