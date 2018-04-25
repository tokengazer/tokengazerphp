<?php
include('bootstraps.php');
/*if(isset($_GET['name'])) {
    $name=$_GET['name'];
    $sql="select * from ico_Analysis where name like '%$name%' ;";

}else{
    $name='AllIco';
    $sql="select * from ico_Analysis ";

}*/
include("PHPExcel/PHPExcel.php");

//$data=MySQLGetData($sql);
$cells="pid,totalcount,foundercount,advisorcount";
$data=MySQLGetData("select * from TeamMember");
$idlist=MySQLGetData("select pid from TeamMember group by pid");
$arr=array();
$i=0;
foreach($idlist as $kk=>$vv){
    $totalcount=$foundercount=$advisorcount=0;
    foreach($data as $k=>$v){
        if($idlist[$kk]['pid']==$data[$k]['pid']){
            $arr[$kk]['pid']=$idlist[$kk]['pid'];
        $idlist[$kk]['totalcount']+=1;
            $arr[$kk]['totalcount']=$idlist[$kk]['totalcount'];
            if($data[$k]['role']=='founder'){
            $idlist[$kk]['foundercount']+=1;
                $arr[$kk]['foundercount']=$idlist[$kk]['foundercount'];
            }else{
            $idlist[$kk]['advisorcount']+=1;
                $arr[$kk]['advisorcount']=$idlist[$kk]['advisorcount'];
            }
        }
    }
}

$cell=explode(',',$cells);
$engcells=$cell;
exportExcel($name.date("Y-m-d"),$engcells,$arr,$engcells);
function exportExcel($expTitle,$expCellName,$expTableData,$engcell){
    $excel = new PHPExcel();

    //设置excel属性
    $objActSheet = $excel->getActiveSheet();
    //根据有生成的excel多少列，$letter长度要大于等于这个值
    $letter =array('A','B','C','D','E');
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
    echo count($expTabelData);die;
    for ($i =2;$i <= count($expTabelData);$i++) {
       $j = 0;echo count($expTabelData);die;
        foreach ($expTableData[$i - 2] as $key=>$value) {
            $objActSheet->setCellValue("$letter[$j]$i",$expTableData[$i -2][$key]);
            unset($value);
            $j++;
        	}
            unset($expTableData[$i -2][$key]);
        
        
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