<?php
//$token='AQUuBi-GG14B47G3ShahyD7tllisfi6cAe1CoCfE0i6Sk9UmMMtkv_b_vL2BtIHJ7CTv8SOZgFJEtQEKvWf0_2Stu1fEqi-JX550Dk_CjZTktwfNdoxQUciUg-hShXOEuarN81rwGEvKUWBShEQJi4Wzwb7je1olimLgp3ZnkFNLvxw4lA7MLSNo_Nld06HbN4M9oEx-ETHJUnafsP52ICZ3ZBOKDud4-xQ-vX_g7Z1AFC6iPCvnYc4ugp4oKbOdiHwQHyJOX5kea8E4nsdnV0cB1pxyUJZXZFNyVq8zhgLqBUKcaTNviTEgZJKf-XsfG5r9Op_llbhvqoW-pNQuQQZE0FXOYg';

$data['isJsEnabled']=true;
$data['source_app']='';

$data['tryCount']=0;
$data['clickedSuggestion']=false;
$data['session_key']='932563595@qq.com';
$data['session_password-login']='lybjx54709488dh';
$data['signin']='登录';
$data['session_redirect'];

$data['trk']='';
$data['fromEmail']='';
$data['sourceAlias']='0_7r5yezRXCiA_H0CRD8sf6DhOjTKUNps5xGTqeX8EEoi';
$data['csrfToken']='ajax%3A4574782901628969978';
$data['loginCsrfParam']='8b7842d2-2827-4c20-8ee0-2662adece62e';
curls('https://www.linkedin.com/uas/login-submit');
function curls($url){
    $headers = array(
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
    curl_setopt($curl, CURLOPT_POST, 1);
    //设置post数据
    
    curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
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
