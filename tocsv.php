<?php
include("PHPExcel/PHPExcel.php");
include('bootstraps.php');
if(isset($_GET['name'])) {
    $name=$_GET['name'];
    $sql="select a.* from ico_Analysis as a  where a.name like '%$name%' ;";

}else{
    $name='AllIco';
   $sql="select a.* from ico_Analysis as a  ;";

}
$data=MySQLGetData($sql);
$cells="id,logo,name,ticker,DataSource,Current_market_value,Current_Single_Price,Current_Circulation,Circulation_unit,Total_Count,Twitter_Fanscount,Facebook_Friends,Telegram_fans,Github_url,GithubCommits,GithubStars,GithubWatches,GithubForks,Github_lastupdatetime,Ico_time,ICO_Price_Usd,ICO_Price_ETH,ICO_Distribution_Ratio,Presales,ICO_Total_Amount,ICO_TotalCount,ICO_HardCap,ICO_Raise_money,Business,Technology,Team,Token,Operation,members,origin,whitepaper,website,cannotareas,Platform,icolink,linkedin";
$cell=explode(',',$cells);
$engcells=explode(",","id,logo,name,ticker,DataSource,Current_market_value,Current_Single_Price,Current_Circulation,Circulation_unit,Total_Count,Twitter_Fanscount,Facebook_Friends,Telegram_fans,Github_url,GithubCommits,GithubStars,GithubWatches,GithubForks,Github_lastupdatetime,Ico_time,ICO_Price_Usd,ICO_Price_ETH,ICO_Distribution_Ratio,Presales,ICO_Total_Amount,ICO_TotalCount,ICO_HardCap,ICO_Raise_money,Business,Technology,Team,Token,Operation,members,origin,whitepaper,website,cannotareas,Platform,icolink,linkedin");
exportExcel($name.date("Y-m-d")."csv",$engcells,$data);
function exportExcel($expTitle,$expCellName,$expTableData){
    $xlsTitle = iconv('utf-8', 'gb2312', $expTitle);
    $fileName = $_SESSION['loginAccount'].date('_YmdHis');
    $cellNum = count($expCellName);
    $dataNum = count($expTableData);
    $objPHPExcel = new PHPExcel();
    $cellName = array('A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z','AA','AB','AC','AD','AE','AF','AG','AH','AI','AJ','AK','AL','AM','AN','AO','AP','AQ','AR','AS','AT','AU','AV','AW','AX','AY','AZ');

    $objPHPExcel->getActiveSheet(0)->mergeCells('A1:'.$cellName[$cellNum-1].'1');
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue('A1', $expTitle.'  Export time:'.date('Y-m-d H:i:s'));
    for($i=0;$i<$cellNum;$i++){
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue($cellName[$i].'2', $expCellName[$i][1]);
    }
    for($i=0;$i<$dataNum;$i++){
        for($j=0;$j<$cellNum;$j++){
            $objPHPExcel->getActiveSheet(0)->setCellValue($cellName[$j].($i+3), $expTableData[$i][$expCellName[$j][0]]);
        }
    }
    header('pragma:public');
    header('Content-type:application/vnd.ms-excel;charset=utf-8;name="'.$xlsTitle.'.xls"');
    header("Content-Disposition:attachment;filename=$fileName.xls");
    $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
    $objWriter->save('php://output');
    exit;
}
?>