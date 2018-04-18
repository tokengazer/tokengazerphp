<?php
include('bootstraps.php');
$sql="select * from ico_Analysis where name <>'' and DataSource='icorating'";
$data=MySQLGetData($sql);
foreach($data as $k=>$v){
 $name=explode(" (",$data[$k]['name'])[0];
    if(strstr($name," ")){
    $name=str_replace(" ","-",$name);
    }
    $url=$data[$k]['icolink'];

//$url="https://icorating.com/ico/crowd-machine/details/";
    
$html1=$html=file_get_contents_https($url.'details/');
$str =explode("uk-table",$html)[1];
$str=explode("Pre-ICO start date:",$str)[1];
$PreICOstartdate=getSonString($str,"<td>","</td>");
 $PreICOstartdate;
    $str =explode("uk-table",$html)[1];
$str=explode("Pre-ICO end date:",$str)[1];
$PreICOenddate=getSonString($str,"<td>","</td>");
 $PreICOenddate;
$str =explode("uk-table",$html)[2];
$str=explode("ICO start date:",$str)[1];
$ICOstartdate=getSonString($str,"<td>","</td>");
 $ICOstartdate;
$str =explode("uk-table",$html)[2];
$str=explode("ICO end date:",$str)[1];
$ICOenddate=getSonString($str,"<td>","</td>");
 $ICOenddate;
$str =explode("uk-table",$html)[2];
$str=explode("ICO Token Supply:",$str)[1];
$ICOTokenSupply=(int)getSonString($str,"<td>","</td>");
    $str =explode("uk-table",$html)[2];
$str=explode("Soft cap size:",$str)[1];
$SoftCap=getSonString($str,"<td>","</td>");
    $str =explode("uk-table",$html)[2];
$str=explode("Hard cap size:",$str)[1];
    
$HardCap=explode("</td>",explode("<td>",$str)[1])[0];
 $ICOTokenSupply;
$str =explode("uk-table",$html)[3];
$str=explode("Ticker",$str)[1];
$Ticker=trim(str_replace("<td>","",explode("</td>",explode("<td>Ticker:</td>",$html)[1])[0]));
 $ICOTokenSupply;
$str =explode("uk-table",$html)[3];
$str=explode("Ticker:",$str)[1];
$Ticker=getSonString($str,"<td>","</td>");
 $Ticker;
$str =explode("uk-table",$html)[3];
$str=explode("Type:",$str)[1];
$Type=getSonString($str,"<td>","</td>");
 $Type;
$str =explode("uk-table",$html)[3];
$str=explode("Token Standard:",$str)[1];
$TokenStandard=getSonString($str,"<td>","</td>");
    
    $str =explode("uk-table",$html)[3];
$str=explode("Token price in ETH:",$str)[1];
$tokenprice=getSonString($str,"<td>","</td>");
 $TokenStandard;
$str =explode("uk-table",$html)[3];
$str=explode("AdditionalTokenEmission:",$str)[1];
$AdditionalTokenEmission=getSonString($str,"<td>","</td>");
 $AdditionalTokenEmission;
$str =explode("uk-table",$html)[3];
$str=explode("Accepted Currencies:",$str)[1];
$AcceptedCurrencies=getSonString($str,"<td>","</td>");
 $AcceptedCurrencies;
$str =explode("uk-table",$html)[3];
$str=explode("Bonus Program:",$str)[1];
$BonusProgram=getSonString($str,"<td>","</td>");
 $BonusProgram;
$str =explode("uk-table",$html)[3];
$str=explode("Token distribution:",$str)[1];
$Tokendistribution=getSonString($str,"<td>","</td>");
 $Tokendistribution;
$str =explode("uk-table",$html)[4];
$str=explode("ICO Platform:",$str)[1];
$ICOPlatform=getSonString($str,"<td>","</td>");
    
$str1=explode("<td>Registration Country:</td>",$html1)[1];
    $str =explode("uk-table",$html)[4];
$regin=explode("</td>",explode("<td>",$str1)[1])[0];
    $str =explode("uk-table",$html)[4];
$str1=explode("<td>Registration Year:</td>",$html1)[1];
$regyear=explode("</td>",explode("<td>",$str1)[1])[0];
    $str =explode("uk-table",$html)[4];
$str1=explode("<td>Office adress:</td>",$html1)[1];
$regin.=".".explode("</td>",explode("<td>",$str1)[1])[0];;
 $ICOPlatform;
$str =explode("uk-table",$html)[5];
$str=explode("Bug Detection:",$str)[1];
$BugDetection=getSonString($str,"<td>","</td>");
 $BugDetection;
$str =explode("uk-table",$html)[5];
$str=explode("Bitcointalk Signature Campaign:",$str)[1];
$BitcointalkSignatureCampaign=getSonString($str,"<td>","</td>");
 $BitcointalkSignatureCampaign;
$str =explode("uk-table",$html)[5];
$str=explode("Bounty:",$str)[1];
$Bounty=getSonString($str,"<td>","</td>");
 $Bounty;
$str =explode("uk-table",$html)[5];
$str=explode("Translation:",$str)[1];
$Translation=getSonString($str,"<td>","</td>");
$Translation;
$str =explode("uk-table",$html)[5];
$str=explode("Social Media:",$str)[1];
$SocialMedia=explode("</div>",explode("<div class=\"uk-child-width-expand uk-grid-small uk-text-center\" uk-grid>",$html1)[1])[0];
    //$detailhtml=file_get_contents_https("https://icorating.com/ico/".strtolower($name)."/");
    $tmparr=explode("</span></a>",$SocialMedia);
    foreach($tmparr as $kk=>$vv){

        if(strpos($vv,'Website')!==false){
            $website=explode("\"",explode("<a target=\"_blank\" rel=\"nofollow\" href=\"",$vv)[1])[0];
        }else if(strpos($vv,'Linkedin')!==false){
            $linkedin=explode("\"",explode("<a target=\"_blank\" rel=\"nofollow\" href=\"",$vv)[1])[0];
        }
    }
    $html2=file_get_contents_https($url);
    $tmparr2=explode("whitepaper",$html2);
    print_r($tmparr2);die;
    $whitepaper="https://icorating.com/upload/whitepaper/".explode("\"",explode("whitepaper",$html2)[2])[0];
    //$sql="INSERT INTO `app_tokenworm`.`icoratingdetail` (`id`, `pid`, `website`,`whitepaper`,`createtime`, `PreICOstartdate`,`PreICOenddate`, `ICOstartdate`, `ICOenddate`, `ICOTokenSupply`, `Ticker`, `Type`, `TokenStandard`, `AdditionalTokenEmission`, `AcceptedCurrencies`, `BonusProgram`, `Tokendistribution`, `ICOPlatform`, `BugDetection`, `BitcointalkSignatureCampaign`, `Bounty`, `Translation`, `SocialMedia`) VALUES (NULL, ".$data[$k]['id'].",'".$website."','".$whitepaper."', '".date("Y-m-d H:i:s")."', '".$PreICOstartdate."','".$PreICOenddate."', '".$ICOstartdate."', '".$ICOenddate."', '".$ICOTokenSupply."', '".$Ticker."', '".$Type."', '".$TokenStandard."', '".$AdditionalTokenEmission."','".$AcceptedCurrencies."', '".$BonusProgram."', '".$Tokendistribution."', '".$ICOPlatform."', '".$BugDetection."', '".$BitcointalkSignatureCampaign."', '".$Bounty."', '".$Translation."', '".$SocialMedia."');";
    $sql="update ico_Analysis set website='".$website."',whitepaper='".$whitepaper."',Ico_time='".$ICOstartdate."',ticker='".$Ticker."',ICO_HardCap='".$HardCap."',origin='".$regin."',Platform='".$ICOPlatform."',linkedin='".$linkedin."',Ico_Total_Amount=".$ICOTokenSupply." where id=".$data[$k]['id']." and DataSource='icorating';";
    MySQLRunSQL($sql);
}
?>