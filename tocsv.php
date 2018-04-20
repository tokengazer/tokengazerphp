<?php
include('bootstraps.php');
if(isset($_GET['name'])) {
    $name=$_GET['name'];
    $sql="select * from ico_Analysis where name like '%$name%' ;";

}else{
    $name='AllIco';
    $sql="select * from ico_Analysis ";

}
include("PHPExcel/PHPExcel.php");

$data=MySQLGetData($sql);
$cells="id,name,logo,ticker,DataSource,Current_market_value,Current_Single_Price,Current_Circulation,Circulation_unit,Total_Count,Twitter_Fanscount,Facebook_Friends,Telegram_fans,Github_url,GithubCommits,GithubStars,GithubWatches,GithubForks,Github_lastupdatetime,Ico_time,ICO_Price_Usd,ICO_Price_ETH,ICO_Distribution_Ratio,Presales,ICO_Total_Amount,ICO_TotalCount,ICO_HardCap,ICO_Raise_money,Business,Technology,Team,Token,Operation,members,origin,whitepaper,website,cannotareas,Platform,icolink,linkedin";
$cell=explode(',',$cells);
$engcells=explode(",","id,name,logo,ticker,DataSource,Current_market_value,Current_Single_Price,Current_Circulation,Circulation_unit,Total_Count,Twitter_Fanscount,Facebook_Friends,Telegram_fans,Github_url,GithubCommits,GithubStars,GithubWatches,GithubForks,Github_lastupdatetime,Ico_time,ICO_Price_Usd,ICO_Price_ETH,ICO_Distribution_Ratio,Presales,ICO_Total_Amount,ICO_TotalCount,ICO_HardCap,ICO_Raise_money,Business,Technology,Team,Token,Operation,members,origin,whitepaper,website,cannotareas,Platform,icolink,linkedin");
exportExcel($name.date("Y-m-d")."csv",$engcells,$data,$engcells);
function exportExcel($expTitle,$expCellName,$expTableData,$engcell){
    $excel = new PHPExcel();

    //设置excel属性
    $objActSheet = $excel->getActiveSheet();
    //根据有生成的excel多少列，$letter长度要大于等于这个值
    $letter = array('A','B','C','D','E','F','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z','AA','AB','AC','AD','AE','AF','AG','AH','AI','AJ','AK','AL','AM','AN');
    //设置当前的sheet
    $excel->setActiveSheetIndex(0);
    //设置sheet的name
    $objActSheet->setTitle('TEST');
    //设置表头
    for($i = 0;$i < count($expCellName);$i++) {
        //单元宽度自适应,1.8.1版本phpexcel中文支持勉强可以，自适应后单独设置宽度无效
        //$objActSheet->getColumnDimension("$letter[$i]")->setAutoSize(true);
        //设置表头值，这里的setCellValue第二个参数不能使用iconv，否则excel中显示false
        $objActSheet->setCellValue("$letter[$i]1",$expCellName[$i]);
        //设置表头字体样式
        $objActSheet->getStyle("$letter[$i]1")->getFont()->setName('微软雅黑');
        //设置表头字体大小
        $objActSheet->getStyle("$letter[$i]1")->getFont()->setSize(12);
        //设置表头字体是否加粗
        $objActSheet->getStyle("$letter[$i]1")->getFont()->setBold(true);
        //设置表头文字垂直居中
        $objActSheet->getStyle("$letter[$i]1")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        //设置文字上下居中
        $objActSheet->getStyle($letter[$i])->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
        //设置表头外的文字垂直居中
        $excel->setActiveSheetIndex(0)->getStyle($letter[$i])->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
    }
    //单独设置D列宽度为15
    $objActSheet->getColumnDimension('D')->setWidth(15);
    //这里$i初始值设置为2，$j初始值设置为0，自己体会原因
    $pages=floor(count($expTableData)/1000);
    //echo $pages;die;
    for($k=0;$k<$pages;$k++){
        if($k==$pages-1){
        $limit=count($expTableData);
        }else{
        $limit=($k+1)*1000+1;
        } 
        if($k==0){
        $start=2;
            $c=2;
        }else{
        $start=$k*1000;
            $c=0;
        }
         ob_flush();
    for ($i =$start;$i <= $limit+2;$i++) {
       $j = 0;
        foreach ($expTableData[$i - $c] as $key=>$value) {
            $objActSheet->setCellValue("$letter[$j]$i",$expTableData[$i - 2][$key]);
            $j++;
        }
        unset($expTableData[$i-2]);
    }
    
    }
        //echo $i,",";continue;
        //设置单元格高度，暂时没有找到统一设置高度方法
        $objActSheet->getRowDimension($i)->setRowHeight('80px');
        header('Content-Type: application/vnd.ms-excel');
    //下载的excel文件名称，为Excel5，后缀为xls，不过影响似乎不大
    $savefile=$expTitle;
    header('Content-Disposition: attachment;filename="' . $savefile . '.CSV"');
    header('Cache-Control: max-age=0');
    // 用户下载excel
    $objWriter = PHPExcel_IOFactory::createWriter($excel, 'CSV');
    $objWriter->save('php://output');
    
    // 保存excel在服务器上
    //$objWriter = new PHPExcel_Writer_Excel2007($excel);
    //或者$objWriter = new PHPExcel_Writer_Excel5($excel);
    //$objWriter->save("保存的文件地址/".$savefile);
}
?>