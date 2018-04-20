<?php
include('bootstraps.php');
ini_set ('memory_limit', '128M');
if(isset($_GET['name'])) {
    $name=$_GET['name'];
   echo $sql="select * from ico_Analysis where name like '%$name%' ;";die;

}else{
    $name='AllIco';
   $sql="select * from ico_Analysis where id=1;";

}
include("PHPExcel/PHPExcel.php");

$data=MySQLGetData($sql);
$cells="logo,name,ticker,DataSource,Current_market_value,Current_Single_Price,Current_Circulation,Circulation_unit,Total_Count,Twitter_Fanscount,Facebook_Friends,Telegram_fans,Github_url,GithubCommits,GithubStars,GithubWatches,GithubForks,Github_lastupdatetime,Ico_time,ICO_Price_Usd,ICO_Price_ETH,ICO_Distribution_Ratio,Presales,ICO_Total_Amount,ICO_TotalCount,ICO_HardCap,ICO_Raise_money,Business,Technology,Team,Token,Operation,members,origin,whitepaper,website,cannotareas,Platform,icolink,linkedin";
$cell=explode(',',$cells);
$engcells=explode(",","logo,name,ticker,DataSource,Current_market_value,Current_Single_Price,Current_Circulation,Circulation_unit,Total_Count,Twitter_Fanscount,Facebook_Friends,Telegram_fans,Github_url,GithubCommits,GithubStars,GithubWatches,GithubForks,Github_lastupdatetime,Ico_time,ICO_Price_Usd,ICO_Price_ETH,ICO_Distribution_Ratio,Presales,ICO_Total_Amount,ICO_TotalCount,ICO_HardCap,ICO_Raise_money,Business,Technology,Team,Token,Operation,members,origin,whitepaper,website,cannotareas,Platform,icolink,linkedin");
exportExcel($name.date("Y-m-d")."csv",$engcells,$data);
function exportExcel($expTitle,$expCellName,$expTableData,$engcell){
    $xlsTitle = iconv('utf-8', 'gb2312', $expTitle);
    $fileName = date('_YmdHis');
    $objPHPExcel = new PHPExcel();

    /*$cellNum = count($expCellName);
    $dataNum = count($expTableData);
    $objPHPExcel = new PHPExcel();
    $cellName=$engcell;// = array('A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z','AA','AB','AC','AD','AE','AF','AG','AH','AI','AJ','AK','AL','AM','AN','AO','AP','AQ','AR','AS','AT','AU','AV','AW','AX','AY','AZ');

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
    exit;*/
    //定义配置
    $topNumber = 2;//表头有几行占用
    $xlsTitle = iconv('utf-8', 'gb2312', $expTitle);//文件名称
    $fileName = $expTitle.date('_YmdHis');//文件名称
    $cellKey = $expCellName;

    //写在处理的前面（了解表格基本知识，已测试）
//     $objPHPExcel->getActiveSheet()->getDefaultRowDimension()->setRowHeight(20);//所有单元格（行）默认高度
//     $objPHPExcel->getActiveSheet()->getDefaultColumnDimension()->setWidth(20);//所有单元格（列）默认宽度
//     $objPHPExcel->getActiveSheet()->getRowDimension('1')->setRowHeight(30);//设置行高度
//     $objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(30);//设置列宽度
//     $objPHPExcel->getActiveSheet()->getStyle('A1')->getFont()->setSize(18);//设置文字大小
//     $objPHPExcel->getActiveSheet()->getStyle('A1')->getFont()->setBold(true);//设置是否加粗
//     $objPHPExcel->getActiveSheet()->getStyle('A1')->getFont()->getColor()->setARGB(PHPExcel_Style_Color::COLOR_WHITE);// 设置文字颜色
//     $objPHPExcel->getActiveSheet()->getStyle('A1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);//设置文字居左（HORIZONTAL_LEFT，默认值）中（HORIZONTAL_CENTER）右（HORIZONTAL_RIGHT）
//     $objPHPExcel->getActiveSheet()->getStyle('A1')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);//垂直居中
//     $objPHPExcel->getActiveSheet()->getStyle('A1')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);//设置填充颜色
//     $objPHPExcel->getActiveSheet()->getStyle('A1')->getFill()->getStartColor()->setARGB('FF7F24');//设置填充颜色

    //处理表头标题
    $objPHPExcel->getActiveSheet()->mergeCells('A1:'.$cellKey[count($expCellName)-1].'1');//合并单元格（如果要拆分单元格是需要先合并再拆分的，否则程序会报错）
//处理表头
    foreach ($expCellName as $k=>$v)
    {
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue($cellKey[$k].$topNumber, $v[1]);//设置表头数据
        $objPHPExcel->getActiveSheet()->freezePane($cellKey[$k].($topNumber+1));//冻结窗口
        $objPHPExcel->getActiveSheet()->getStyle($cellKey[$k].$topNumber)->getFont()->setBold(true);//设置是否加粗
        $objPHPExcel->getActiveSheet()->getStyle($cellKey[$k].$topNumber)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);//垂直居中
        if($v[3] > 0)//大于0表示需要设置宽度
        {
            $objPHPExcel->getActiveSheet()->getColumnDimension($cellKey[$k])->setWidth($v[3]);//设置列宽度
        }
    }
    //处理数据
    foreach ($expTableData as $k=>$v)
    {
        foreach ($cellName as $k1=>$v1)
        {die;
            $objPHPExcel->getActiveSheet()->setCellValue($cellKey[$k1].($k+1+$topNumber), $v[$v1[0]]);
            if($v['end'] > 0)
            {
                if($v1[2] == 1)//这里表示合并单元格
                {
                    $objPHPExcel->getActiveSheet()->mergeCells($cellKey[$k1].$v['start'].':'.$cellKey[$k1].$v['end']);
                    $objPHPExcel->getActiveSheet()->getStyle($cellKey[$k1].$v['start'])->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
                }
            }
            if($v1[4] != "" && in_array($v1[4], array("LEFT","CENTER","RIGHT")))
            {
                $v1[4] = eval('return PHPExcel_Style_Alignment::HORIZONTAL_'.$v1[4].';');
                //这里也可以直接传常量定义的值，即left,center,right；小写的strtolower
                $objPHPExcel->getActiveSheet()->getStyle($cellKey[$k1].($k+1+$topNumber))->getAlignment()->setHorizontal($v1[4]);
            }
        }
    }
    //导出execl
    header('pragma:public');die;
    header('Content-type:application/vnd.ms-excel;charset=utf-8;name="'.$xlsTitle.'.xls"');
    header("Content-Disposition:attachment;filename=$fileName.xls");//attachment新窗口打印inline本窗口打印
    $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
    $objWriter->save('php://output');
    exit;
}
?>