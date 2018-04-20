<?php
include('bootstraps.php');
if(isset($_GET['name'])) {
    $name=$_GET['name'];
    echo $sql="select * from ico_Analysis where name like '%$name%' ;";

}else{
    $name='AllIco';
    $sql="select * from ico_Analysis where id=1; ";

}
include("PHPExcel/PHPExcel.php");

$data=MySQLGetData($sql);
$cells="logo,name,ticker,DataSource,Current_market_value,Current_Single_Price,Current_Circulation,Circulation_unit,Total_Count,Twitter_Fanscount,Facebook_Friends,Telegram_fans,Github_url,GithubCommits,GithubStars,GithubWatches,GithubForks,Github_lastupdatetime,Ico_time,ICO_Price_Usd,ICO_Price_ETH,ICO_Distribution_Ratio,Presales,ICO_Total_Amount,ICO_TotalCount,ICO_HardCap,ICO_Raise_money,Business,Technology,Team,Token,Operation,members,origin,whitepaper,website,cannotareas,Platform,icolink,linkedin";
$cell=explode(',',$cells);
$engcells=explode(",","logo,name,ticker,DataSource,Current_market_value,Current_Single_Price,Current_Circulation,Circulation_unit,Total_Count,Twitter_Fanscount,Facebook_Friends,Telegram_fans,Github_url,GithubCommits,GithubStars,GithubWatches,GithubForks,Github_lastupdatetime,Ico_time,ICO_Price_Usd,ICO_Price_ETH,ICO_Distribution_Ratio,Presales,ICO_Total_Amount,ICO_TotalCount,ICO_HardCap,ICO_Raise_money,Business,Technology,Team,Token,Operation,members,origin,whitepaper,website,cannotareas,Platform,icolink,linkedin");
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
    for ($i = 2;$i <= count($expTableData) + 1;$i++) {
        $j = 0;
        foreach ($expTableData[$i - 2] as $key=>$value) {
            //不是图片时将数据加入到excel，这里数据库存的图片字段是img
            if($key != 'img'){
                $objActSheet->setCellValue("$letter[$j]$i",$value);
            }
            //是图片是加入图片到excel
            if($key == 'img'){
                if($value != ''){
                    $value = iconv("UTF-8","GB2312",$value); //防止中文命名的文件
                    // 图片生成
                    $objDrawing[$key] = new PHPExcel_Worksheet_Drawing();
                    // 图片地址
                    $objDrawing[$key]->setPath('.\Uploads'.$value);
                    // 设置图片宽度高度
                    $objDrawing[$key]->setHeight('80px'); //照片高度
                    $objDrawing[$key]->setWidth('80px'); //照片宽度
                    // 设置图片要插入的单元格
                    $objDrawing[$key]->setCoordinates('D'.$i);
                    // 图片偏移距离
                    $objDrawing[$key]->setOffsetX(12);
                    $objDrawing[$key]->setOffsetY(12);
                    //下边两行不知道对图片单元格的格式有什么作用，有知道的要告诉我哟^_^
                    //$objDrawing[$key]->getShadow()->setVisible(true);
                    //$objDrawing[$key]->getShadow()->setDirection(50);
                    $objDrawing[$key]->setWorksheet($objActSheet);
                }
            }
            $j++;
        }
        //设置单元格高度，暂时没有找到统一设置高度方法
        $objActSheet->getRowDimension($i)->setRowHeight('80px');
    }
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