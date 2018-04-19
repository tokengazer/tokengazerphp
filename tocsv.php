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
$cells="logo,name,ticker,DataSource,Current_market_value,Current_Single_Price,Current_Circulation,Circulation_unit,Total_Count,Twitter_Fanscount,Facebook_Friends,Telegram_fans,Github_url,GithubCommits,GithubStars,GithubWatches,GithubForks,Github_lastupdatetime,Ico_time,ICO_Price_Usd,ICO_Price_ETH,ICO_Distribution_Ratio,Presales,ICO_Total_Amount,ICO_TotalCount,ICO_HardCap,ICO_Raise_money,Business,Technology,Team,Token,Operation,members,origin,whitepaper,website,cannotareas,Platform,icolink,linkedin";
$cell=explode(',',$cells);
$engcells=explode(",","logo,name,ticker,DataSource,Current_market_value,Current_Single_Price,Current_Circulation,Circulation_unit,Total_Count,Twitter_Fanscount,Facebook_Friends,Telegram_fans,Github_url,GithubCommits,GithubStars,GithubWatches,GithubForks,Github_lastupdatetime,Ico_time,ICO_Price_Usd,ICO_Price_ETH,ICO_Distribution_Ratio,Presales,ICO_Total_Amount,ICO_TotalCount,ICO_HardCap,ICO_Raise_money,Business,Technology,Team,Token,Operation,members,origin,whitepaper,website,cannotareas,Platform,icolink,linkedin");

export($name.date("Y-m-d")."csv",$cell,$data);




//简单过滤
function strFilter($str){
    $str = str_replace('`', '', $str);
    $str = str_replace('·', '', $str);
    $str = str_replace('~', '', $str);
    $str = str_replace('!', '', $str);
    $str = str_replace('！', '', $str);
    $str = str_replace('@', '', $str);
    $str = str_replace('#', '', $str);
    $str = str_replace('$', '', $str);
    $str = str_replace('￥', '', $str);
    $str = str_replace('%', '', $str);
    $str = str_replace('^', '', $str);
    $str = str_replace('……', '', $str);
    $str = str_replace('&', '', $str);
    $str = str_replace('*', '', $str);
    $str = str_replace('(', '', $str);
    $str = str_replace(')', '', $str);
    $str = str_replace('（', '', $str);
    $str = str_replace('）', '', $str);
    $str = str_replace('-', '', $str);
    $str = str_replace('_', '', $str);
    $str = str_replace('——', '', $str);
    $str = str_replace('+', '', $str);
    $str = str_replace('=', '', $str);
    $str = str_replace('|', '', $str);
    $str = str_replace('\\', '', $str);
    $str = str_replace('[', '', $str);
    $str = str_replace(']', '', $str);
    $str = str_replace('【', '', $str);
    $str = str_replace('】', '', $str);
    $str = str_replace('{', '', $str);
    $str = str_replace('}', '', $str);
    $str = str_replace(';', '', $str);
    $str = str_replace('；', '', $str);
    $str = str_replace(':', '', $str);
    $str = str_replace('：', '', $str);
    $str = str_replace('\'', '', $str);
    $str = str_replace('"', '', $str);
    $str = str_replace('“', '', $str);
    $str = str_replace('”', '', $str);
    $str = str_replace(',', '', $str);
    $str = str_replace('，', '', $str);
    $str = str_replace('<', '', $str);
    $str = str_replace('>', '', $str);
    $str = str_replace('《', '', $str);
    $str = str_replace('》', '', $str);
    $str = str_replace('.', '', $str);
    $str = str_replace('。', '', $str);
    $str = str_replace('/', '', $str);
    $str = str_replace('、', '', $str);
    $str = str_replace('?', '', $str);
    $str = str_replace('？', '', $str);
    return trim($str);
}
function exportExcel($expTitle,$expCellName,$expTableData,$cell=''){
    $xlsTitle = iconv('utf-8', 'gb2312', $expTitle);//文件名称
    $fileName = $expTitle.date('_YmdHis');//or $xlsTitle 文件名称可根据自己情况设定
    $cellNum = count($expCellName);
    $dataNum = count($expTableData);



    //print_r($cellNum);die;

    $objPHPExcel = new PHPExcel();
    $cellName = array('A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z','AA','AB','AC','AD','AE','AF','AG','AH','AI','AJ','AK','AL','AM','AN','AO','AP','AQ','AR','AS','AT','AU','AV','AW','AX','AY','AZ');

    $objPHPExcel->getActiveSheet(0)->mergeCells('A1:'.$cellName[$cellNum-1].'1');//合并单元格
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue('A1', $expTitle.'  Export time:'.date('Y-m-d H:i:s'));
    for($i=0;$i<$cellNum;$i++){
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue($cellName[$i].'2', $expCellName[$i]);
    }
    // Miscellaneous glyphs, UTF-8
    for($i=0;$i<$dataNum;$i++){
        for($j=0;$j<$cellNum;$j++){

            $objPHPExcel->getActiveSheet(0)->setCellValue($cellName[$j].($i+3), $expTableData[$i][$cell[$j]]);
        }
    }

    header('pragma:public');
    header('Content-type:application/vnd.ms-excel;charset=utf-8;name="'.$xlsTitle.'.xls"');
    header("Content-Disposition:attachment;filename=$fileName.xls");//attachment新窗口打印inline本窗口打印
    $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
    $objWriter->save('php://output');
    exit;
}
public static function export($title,$map,$data,$firstRow){  
//如果要导出xls而不是xlsx，则改为require_once 'PHPExcel/Writer/Excel5.php';  
  
            $objPHPExcel = new PHPExcel();  
            $objPHPExcel->getProperties()->setCreator('http://www.style.net')  
                ->setLastModifiedBy('http://www.style.net')  
                ->setTitle('Office 2007 XLSX Document')  
                ->setSubject('Office 2007 XLSX Document')  
                ->setDescription('Document for Office 2007 XLSX, generated using PHP classes.')  
                ->setKeywords('office 2007 openxml php')  
                ->setCategory('Result file');  
  
            //设置列的宽度，第一行加粗居中  
            foreach ($map as $k=>$v){  
                $objPHPExcel->getActiveSheet()->getColumnDimension($k)->setWidth(22);  
                $objPHPExcel->getActiveSheet()->getStyle($k.'1')->getFont()->setBold(true);  
                $objPHPExcel->getActiveSheet()->getStyle($k.'1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);  
            }  
  
            //设置列名  
            foreach ($firstRow as $k=>$v){  
                $objPHPExcel->setActiveSheetIndex(0)->setCellValue($k,$v);  
            }  
  
            $i = 2;  
  
            foreach ($data as $k=>$v) {  
                foreach ($map as $col=>$name) {  
                    $objPHPExcel->setActiveSheetIndex(0)->setCellValue($col . $i, $v[$name]);  
                }  
                $i++;  
            }  
  
            $objPHPExcel->getActiveSheet()->setTitle($title);  
  
            $objPHPExcel->setActiveSheetIndex(0);  
            $filename1 = urlencode('导出_'.$title) . '_' . date('Y-m-dHis');  
  
//生成xlsx文件  
  
            header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');  
            header('Content-Disposition: attachment;filename="' . $filename1 . '.xlsx"');  
            header('Cache-Control: max-age=0');  
            $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');  
  
  
//生成xls文件  
            /* 
            header('Content-Type: application/vnd.ms-excel'); 
            header('Content-Disposition: attachment;filename="'.$filename.'.xls"'); 
            header('Cache-Control: max-age=0'); 
            $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5'); 
            */  
            $objWriter->save('php://output');  
        }
?>