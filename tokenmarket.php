<?php
include('bootstraps.php');
$url = 'https://tokenmarket.net/blockchain/all-assets';
$content = file_get_contents($url);
$counts=explode("<small>Showing <strong>",$content)[1];
$counts=explode("</strong> assets</small>",$counts)[0];
$pages= ceil($counts/20);
$kv = new SaeKV();
$ret = $kv->init("xowlw2kmk2");

//for($i=0;$i<$pages;$i++){
$contents=file_get_contents_https("https://tokenmarket.net/blockchain/all-assets?batch_num=0&batch_size=".$counts);
    $str=explode("<tbody>",$contents)[1];
$str=explode("</tbody>",$str)[0];
    $tmp=explode("<td class=\"col-asset-name\">",$str);
unset($tmp[0]);$i=1;
	foreach($tmp as $k=>$v){
        $tmp1=$tmp[$k];
        $url=explode('<a href="',$tmp1);
        $name=explode('">',$tmp1)[1];
        $name=trim(explode('</a',$name)[0]);
        $data[$k]['name']=$name;
        $url=explode('"',$url[1])[0];
        $tmp2=file_get_contents_https($url);
        $memberhtml=explode("<th>Members</th>",$tmp2)[1];
        $memberhtml=explode("</td>",$memberhtml)[0];
        $symbol=explode("<th>Symbol</th>",$tmp2)[1];
        
        $symbol=explode("<td>",$symbol)[1];
        $symbol=explode("</td>",$symbol)[0];die;
        $member=strip_tags($memberhtml);
        $icostartdate=explode("Token sale opening date",$tmp2)[1];
        $icostartdate=explode("<td>",$icostartdate)[1];
        $icostartdate=explode("</td>",$icostartdate)[0];
        $icoenddate=explode("Token sale closing date",$tmp2)[1];
        $icoenddate=explode("<td>",$icoenddate)[1];
        echo $icoenddate=explode("</td>",$icoenddate)[0];
        $origin=explode("Country of origin",$tmp2)[1];
        $origin=explode("<td>",$origin)[1];
        $origin=explode("</td>",$origin)[0];
        $websitehtml=explode("<table class=\"table table-asset-data\">",$tmp2)[4];
        $website=explode("<td colspan=\"2\">",$websitehtml)[1];
        $website=explode("<a target=\"_blank\" href=\"",$website)[1];
        $website1=explode("\"",$website)[0];
        $whitepaper=explode("<td colspan=\"2\">",$websitehtml)[3];
        $whitepaper=explode("<a target=\"_blank\" href=\"",$whitepaper)[1];
        $whitepaper=explode("\"",$website)[0];
        $githuburl=explode("https://github.com/",$tmp2)[1];
         if($githuburl!=''){
        $data[$k]['githuburl']=$githuburl="https://github.com/".explode("\"",$githuburl)[0].',';
        }/*
        $ret = $kv->delete('tokenmarketproducts:'.$i);
        $kv->add('tokenmarketproducts:'.$i, json_encode($data[$i],true));
    $sql='insert into project_list (name,githuburl,price,DataSource) values("'.$data[$i]['name'].'","'.$data[$i]['githuburl'].'",0,"tokenmarket");';
    MySQLRunSQL($sql);*/
    //echo $kv->get('tokenmarketproducts:'.$i);
       
        $i++;
    }
   $ret = $kv->delete('tokenmarketproducts:all');
        $kv->add('tokenmarketproducts:all', json_encode($data,true));
    
     $kv->get('tokenmarketproducts:all');
       
die;