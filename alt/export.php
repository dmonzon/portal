<?php
session_start();
require_once("cno.php");
if (!isset($_SESSION['username'])) {
    if(isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on')   
        $url = "https://";   
    else  
        $url = "http://";   
    $url.= $_SERVER['HTTP_HOST'];
    
    header('location:'.$url.'logout.php');
    exit();
}
include_once("xlsxwriter.class.php");
date_default_timezone_set('America/Puerto_Rico');
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $period = $_POST['txtDate'].'/'.$_POST['txtYear'];
}elseif ($_SERVER['REQUEST_METHOD'] === 'GET') {
    empty(!$_GET ) ? $period = $_GET['period'] : $period = '12/31/2021';
}
// define col names $ data types
$x = explode('/',$period);
switch ($x[0]) {
    case '3':
        $prev = '12/31/' . $x[2] - 1;
    break;
    case '6':
        $prev = '3/31/' . $x[2];
    break;
    case '9':
        $prev = '6/30/' . $x[2];
    break;
    case '12':
        $prev = '9/30/' . $x[2];
    break;
    default:
        # code...
        break;
}
$colNames = array("DESCRIPTION","C.C.","DIRECT LABOR COST","RCC1","INDIRECT LABOR COST","RCC2","OTHER DIRECT COST","RCC3","INDIRECT COST CAPITAL",
    "RCC4","INDIRECT COST ATRIBUIBLE","RCC5","INDIRECT COST IMPUTADOS","RCC6","OTHER GENERAL COST","RCC7","TOTAL COST","TOTAL CHARGES","RCC TOTAL COST","NOTES");
$headers = array("string","string","#,##0.00###","#,##0.00###","#,##0.00###","#,##0.00###","#,##0.00###","#,##0.00###","#,##0.00###",
    "#,##0.00###","#,##0.00###","#,##0.00###","#,##0.00###","#,##0.00###","#,##0.00###","#,##0.00###","#,##0.00###","#,##0.00###","#,##0.00###","string");
$colNames2 = array("DESCRIPTION","C.C.","TOTAL COST $prev","TOTAL COSTS $period","Comparativa");
$headers2 = array("string","string","#,##0.00###","#,##0.00###","-#,##0.00###");
// in case of error ...
ini_set('display_errors', 0);
ini_set('log_errors', 0);
error_reporting(E_ALL & ~E_NOTICE);
//set filename
$filename = 'Period_'. $period . '_'  .date('Ymdhi').'.xlsx';
header('Content-disposition: attachment; filename="'.XLSXWriter::sanitize_filename($filename).'"');
// set titles
$titles = array(
    array('AUXILIO MUTUO HOSPITAL'),
    array('TOTAL COSTS FOR RCC ALLOCATIONS'),
    array('PERIOD ENDED '.$period),
    array(''),array(''),array('')
);

//begin writing xlsx
$writer = new XLSXWriter();
// formating column names
$formatH = array('font'=>'Arial','font-size'=>11,'font-style'=>'bold','color'=>'#000','border'=>'top,bottom','border-style'=>'medium', 'halign'=>'center','valign'=>'center','wrap_text'=>true);
$formatT = array('font'=>'Arial','font-size'=>12,'font-style'=>'bold','color'=>'#000','border'=>'top,bottom');
$formatH2 = array('font'=>'Arial','font-size'=>11,'font-style'=>'bold','color'=>'#000','border'=>'top,bottom','border-style'=>'medium', 'halign'=>'center','valign'=>'center','wrap_text'=>true);
$formatT2 = array('font'=>'Arial','font-size'=>12,'font-style'=>'bold','color'=>'#000','border'=>'top,bottom');

// set colum data types
$writer->writeSheetHeader('RCCs',$headers,$col_options = ['widths'=>[35,8,15,10,15,10,15,10,15,10,15,10,15,10,15,10,15,15,15,40],'suppress_row' => true]);
$writer->writeSheetHeader('Comparativa',$headers2,$col_options = ['widths'=>[40,10,20,20,20],'suppress_row' => true]);
// writing titles
foreach($titles as $title){
    $writer->writeSheetRow('RCCs',$title,$formatT);
    $writer->writeSheetRow('Comparativa',$title,$formatT);
}

// writing col names
$writer->writeSheetRow('RCCs',$colNames,$formatH);
$writer->writeSheetRow('Comparativa',$colNames2,$formatH2);
$writer->setAuthor('HOSPITAL AUXILIO MUTUO');
// writing data
$db= new ServidorBD;
$conn = $db->Conectar('a');
$tsql = "SELECT (select description from CostCenters where id=c.[CostCenter]) 'Desc'
            ,(select costcenter from CostCenters where id=c.[CostCenter]) 'CC'
            ,[Direct_Labor_Cost],[RCC1],[Indirect_Labor_Cost],[RCC2],[Other_Dirct_Cost]
            ,[RCC3],[Indirect_Cost_Capital],[RCC4],[Indirect_Cost_Atribuible],[RCC5]
            ,[Indirect_Cost_Imputados],[RCC6],[Other_General_Cost],[RCC7],[Total_Cost],[Total_Charges],[RCC_Total_Cost],[Note] 
    from Cost_for_RCC c
    where rccPeriod like '".$period."' order by 2";
$getResults= sqlsrv_query($conn, $tsql);
if( $getResults === false ) {
    echo '<pre>';
    die( print_r( sqlsrv_errors(), true));
}
$i =0;
while ($row = sqlsrv_fetch_array($getResults, SQLSRV_FETCH_ASSOC)){
    if($i == 19){
        $writer->writeSheetRow('RCCs', $row,$row_options = array('wrap_text'=>true,'height'=>15));
    }else{
        $writer->writeSheetRow('RCCs', $row,$row_options = array('height'=>15));
    }
    $i++;
}
sqlsrv_free_stmt($getResults);
$tsql = "SELECT 
    (select [description] from CostCenters where id=t1.[CostCenter])
    ,(select costcenter from CostCenters where id=t1.[CostCenter])
    ,t1.[CostCenter],t1.Total_Cost 'Total Cost $prev'
    ,t2.[CostCenter],t2.Total_Cost 'Total Cost $period'
    ,COALESCE(t2.[CostCenter], 0) AS 'CC'
    ,t2.Total_Cost - t1.Total_Cost
FROM 
(select [CostCenter],Total_Cost from Cost_for_RCC where rccperiod ='$prev') t1
LEFT JOIN
(select [CostCenter],Total_Cost from Cost_for_RCC where rccperiod ='$period') t2
ON (t1.[CostCenter] = t2.[CostCenter]);";
$getResults= sqlsrv_query($conn, $tsql);
if( $getResults === false ) {
    echo '<pre>';
    die( print_r( sqlsrv_errors(), true));
}
while ($row = sqlsrv_fetch_array($getResults, SQLSRV_FETCH_NUMERIC)){
    $totals = array($row[0],$row[1],$row[3],$row[5],$row[7]);
    $writer->writeSheetRow('Comparativa', $totals,$row_options = array('height'=>30));
}
$writer->writeToStdOut();
exit(0);
$db->Desconectar();

