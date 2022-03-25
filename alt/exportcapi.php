<!DOCTYPE html>
<head>
<script type="text/javascript">
  function openFile() 
  {  
    var f = 'C:\\Users\\dmonzon\\Downloads\\Capitados2021vs2020_0721.xlsx';
    var Excel = new ActiveXObject("Excel.Application");  
    Excel.Visible = true; 
    Excel.Workbooks.open(f);
    //var excel_sheet = Excel.Worksheets("sheetname_1");  
    //excel_sheet.activate();  
  }   
</script>
</head>
<?php
session_start();
ini_set('display_errors',0);
ini_set('log_errors', 0);
error_reporting(E_ALL & ~E_NOTICE);
require_once("cno.php");
if (!isset($_SESSION['user_name'])) {
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
    $p1 = $_POST['p1'];
    $p2 = $_POST['p2'];
    echo 'post';
}elseif ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $p1 = $_GET['p1'];
    $p2 = $_GET['p2'];
}
$dir = getenv('USERPROFILE') . '\Downloads\Capitados'.$p1.'vs'.$p2.'_'.date('hi').'.xlsx';
//header('Content-disposition: attachment; filename="'.XLSXWriter::sanitize_filename($filename).'"');

$deciPagos = 2; // numeros decimales a mostrar para los pagos
$deciCapi = 0; // numeros decimales a mostrar para # de capitados
$mon = array('Octubre','Noviembre','Diciembre','Enero','Febrero','Marzo','Abril','Mayo','Junio','Julio','Agosto','Septiembre');
// $header = array("string",'string','string', "string", "string",'string','string');
$row1 = array("HOSPITAL AUXILIO MUTUO");
$row2 = array("SOCIOS CAPITADOS");
$row3 = array("PERIODOS $p1 & $p2");
$sheet_name = 'Capitados';
$writer = new XLSXWriter();
$writer->writeSheetHeader($sheet_name, array(), $col_options = ['widths'=>[20,20,20,5,5,20,20,5,5],'suppress_row' => true]);
$format = array('font'=>'Calibri','font-size'=>14,'font-style'=>'bold','color'=>'#000','border'=>'top,bottom');
$writer->writeSheetRow($sheet_name, array(),$format);
$writer->writeSheetRow($sheet_name, $row1,$format);
// $writer->markMergedCell($sheet_name, $start_row = 0, $start_col = 0, $end_row = 0, $end_col = 2);
$writer->writeSheetRow($sheet_name, $row2,$format);
$writer->writeSheetRow($sheet_name, $row3,$format);
$writer->writeSheetRow($sheet_name, array());
$writer->writeSheetRow($sheet_name, array());
$writer->writeSheetRow($sheet_name, array());
$writer->markMergedCell($sheet_name, $start_row = 6, $start_col = 0, $end_row = 6, $end_col = 2);
$writer->markMergedCell($sheet_name, $start_row = 6, $start_col = 3, $end_row = 6, $end_col = 3);
$writer->markMergedCell($sheet_name, $start_row = 6, $start_col = 4, $end_row = 6, $end_col = 4);
$writer->markMergedCell($sheet_name, $start_row = 6, $start_col = 5, $end_row = 6, $end_col = 7);
$format = array('font'=>'Calibri','font-size'=>12,'font-style'=>'bold','color'=>'#000','border'=>'top,bottom','border-style'=>'medium', 'halign'=>'center','valign'=>'center','wrap_text'=>true);
$writer->writeSheetRow($sheet_name, array("FY $p1","","","","","FY $p2",""),$format);
//get data
$tbl1 = getCapitado($p1);
$tbl2 = getCapitado($p2);
$formatT = array(['halign'=>'left','font-style'=>'bold'],['halign'=>'right'],['halign'=>'right'],['halign'=>'none'],['halign'=>'none'],['halign'=>'right'],['halign'=>'right']);
for ($i=0; $i < 12; $i++) {
    // $row = array($mon[$i],$tbl2[$i],$tbl2[$i+12],"",$tbl1[$i],$tbl1[$i+12],"","");
    $row = array($mon[$i],number_format($tbl2[$i], $deciCapi, '.', ','),number_format($tbl2[$i+12], $deciPagos, '.', ','),"","",
        number_format($tbl1[$i], $deciCapi, '.', ','),number_format($tbl1[$i+12], $deciPagos, '.', ','));
    $writer->writeSheetRow($sheet_name, $row,$formatT);
}
$format = array('border-style'=>'medium','border'=>'top');
$writer->writeSheetRow($sheet_name,array("","","","","","",""), $format);
// $header = array("string","integer",'#,##0.00',"string","integer",'#,##0.00',"string","string");
// $row = array("TOTALS",$tbl2[24],$tbl2[25],"","",$tbl1[24],$tbl1[25],"","");
$formatT = array(['halign'=>'left','font-style'=>'bold','border-style'=>'double','border'=>'top,bottom'],
        ['halign'=>'right','font-style'=>'bold','border-style'=>'double','border'=>'top,bottom'],
        ['halign'=>'right','font-style'=>'bold','border-style'=>'double','border'=>'top,bottom'],
        ['halign'=>'none','border-style'=>'double','border'=>'top,bottom'],['halign'=>'none','border-style'=>'double','border'=>'top,bottom'],
        ['halign'=>'right','font-style'=>'bold','border-style'=>'double','border'=>'top,bottom'],
        ['halign'=>'right','font-style'=>'bold','border-style'=>'double','border'=>'top,bottom']);

$row = array("TOTALS",number_format($tbl2[24], $deciCapi, '.', ','),number_format($tbl2[25], $deciPagos, '.', ','),"","",
        number_format($tbl1[24], $deciCapi, '.', ','),number_format($tbl1[25], $deciPagos, '.', ','));
$writer->writeSheetRow($sheet_name, $row,$formatT);

///escribir nota
$writer->writeSheetRow($sheet_name, array());
$writer->writeSheetRow($sheet_name, array());
$writer->writeSheetRow($sheet_name, array());
$row = array("NOTA;");
$writer->writeSheetRow($sheet_name, $row);
$row = array("01) A partir de 1 de octubre de 2019 el pago de Capitación por Socios Primario es de $49.00 debido a la renovación del Contrato");
$writer->writeSheetRow($sheet_name, $row);
$row = array("02) A partir de 15 de enero de 2020, se incluye a la Capitación, la disponibilidad de los Gastroenterólogos, lo que aumenta el pago a $50.00.");
$writer->writeSheetRow($sheet_name, $row);
$row = array("       (La disponibilidad de los Gastroenterologos comenzó el dia 15 de enero de 2020 por lo que se fraccionó el pago a $49.50 por los 16 dias");
$writer->writeSheetRow($sheet_name, $row);
$row = array("       restantes del mes comenzando el 1 de febrero de 2020 el pagó se hará por $50.00)");
$writer->writeSheetRow($sheet_name, $row);


// $writer->writeToStdOut();
$writer->writeToFile($dir);
// exit(0);
// $db->Desconectar();
// echo '<div id="msg" class="msg">'.$dir.' creado!</div>';
echo "</br><h2>Archivo creado en </br> $dir.</h2>";

