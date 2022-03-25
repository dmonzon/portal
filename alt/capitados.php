<!DOCTYPE html>
<?php
ini_set('display_errors',1);
ini_set('log_errors',0);
error_reporting(E_ALL & ~E_NOTICE);
session_start();
require_once("cno.php");
require_once("control.php");
require_once("funcs.php");
include('header.php');
/********************************************
 * Danny Monzon
 * 20210909
 ********************************************/

if (!isset($_SESSION['user_name'])) {
    header('location:logout.php');
    exit();
}
$p1 = (@$_POST['periodo']) ? $_POST['periodo'] : date('Y'); 
$decPagos = 2; // numeros decimales a mostrar para los pagos
$decCapi = 0; // numeros decimales a mostrar para # de capitados
?>
<head>
    <title>Capitados</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-modal/0.9.1/jquery.modal.min.css" />
    <link rel="stylesheet" type="text/css" href="w.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-modal/0.9.1/jquery.modal.min.js"></script>
    <script src="https://kit.fontawesome.com/2a9ceb1fca.js" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="capiFunc.js"></script>
    <script src="idle.js"></script>
    <script type="text/javascript"> 
      $(document).ready( function() {
        $('#msg').delay(1000).fadeOut();
      });
    </script>
    <style>
        .msg{
            border-bottom: 2px solid green;
            background-color: green;
            color: white;
            height: 100px;
            line-height: 100px;
            font-size:20px;
            position : fixed;
            width : 100%;
            text-align : center;
            z-index : 999999;
            top : 30%;
            left : 0;
        }
        .mystyle{
            /* border-bottom: 2px solid red; */
            background-color: #F1C2C2;
            border:red; border-style: solid;
            color: black;
            height: 90%;
            /* line-height: 100px; */
            font-size:18px;
            position : fixed;
            width : 98%;
            text-align : center;
            z-index : 99999999;
            top : 8%;
            left : 0;
            display: none;
        }
        .dot {
            height: 17px;
            width: 17px;
            background-color:#C5EDB3;
            border-radius: 50%;
            display: inline-block;
            vertical-align: middle;
        }
</style>
</head>
<body><meta name="viewport" content="width=device-width, initial-scale=1">
    <div id="main">
        <div id="forma" class="divx">
            <table>
                <form id="main2" action="capitados.php" target="_self" method="POST">
                <thead class="noprint">
                    <tr class="noprint">
                        <th colspan="14"><h3>Año:  
                            <input type="text" name="periodo" value="<?php //echo date('Y') ; ?>" required></h3>
                        </th>
                    </tr>
                    <tr class="noprint">
                        <th style="text-align: center;"><h4></h4></th>
                        <th style="text-align: center;"><h4>Octubre</h4></th>
                        <th style="text-align: center;"><h4>Noviembre</h4></th>
                        <th style="text-align: center;"><h4>Diciembre</h4></th>
                        <th style="text-align: center;"><h4>Enero</h4></th>
                        <th style="text-align: center;"><h4>Febrero</h4></th>
                        <th style="text-align: center;"><h4>Marzo</h4></h4></th>
                        <th style="text-align: center;"><h4>Abril</h4></th>
                        <th style="text-align: center;"><h4>Mayo</h4></th>
                        <th style="text-align: center;"><h4>Junio</h4></th>
                        <th style="text-align: center;"><h4>Julio</h4></th>
                        <th style="text-align: center;"><h4>Agosto</h4></th>
                        <th style="text-align: center;"><h4>Septiembre</h4></th>
                        <th style="text-align: center;"><h4>TOTAL</h4></th>
                    </th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="noprint">
                        <th><h4>Capitados</h4></th>
                        <td><input type="number" min="0" name="capiOct" class="capi" step="any" style="width: 70px;" ></td>
                        <td><input type="number" min="0" name="capiNov" class="capi" step="any" style="width: 70px;" ></td>
                        <td><input type="number" min="0" name="capiDic" class="capi" step="any" style="width: 70px;" ></td>
                        <td><input type="number" min="0" name="capiEne" class="capi" step="any" style="width: 70px;" ></td>
                        <td><input type="number" min="0" name="capiFeb" class="capi" step="any" style="width: 70px;" ></td>
                        <td><input type="number" min="0" name="capiMar" class="capi" step="any" style="width: 70px;" ></td>
                        <td><input type="number" min="0" name="capiAbr" class="capi" step="any" style="width: 70px;" ></td>
                        <td><input type="number" min="0" name="capiMay" class="capi" step="any" style="width: 70px;" ></td>
                        <td><input type="number" min="0" name="capiJun" class="capi" step="any" style="width: 70px;" ></td>
                        <td><input type="number" min="0" name="capiJul" class="capi" step="any" style="width: 70px;" ></td>
                        <td><input type="number" min="0" name="capiAgo" class="capi" step="any" style="width: 70px;" ></td>
                        <td><input type="number" min="0" name="capiSep" class="capi" step="any" style="width: 70px;" ></td>
                        <td><input type="number" min="0" id="TotalCapitados" name="TotalCapitados" step="any" style="width: 90px;" class="total"></td>
                    </tr>
                    <tr class="noprint">
                        <th><h4>Pagos</h4></th>
                        <td><input type="number" min="0" name="pagosOct" class="pago" step="any" style="width: 70px;" ></td>
                        <td><input type="number" min="0" name="pagosNov" class="pago" step="any" style="width: 70px;" ></td>
                        <td><input type="number" min="0" name="pagosDic" class="pago" step="any" style="width: 70px;" ></td>
                        <td><input type="number" min="0" name="pagosEne" class="pago" step="any" style="width: 70px;" ></td>
                        <td><input type="number" min="0" name="pagosFeb" class="pago" step="any" style="width: 70px;" ></td>
                        <td><input type="number" min="0" name="pagosMar" class="pago" step="any" style="width: 70px;" ></td>
                        <td><input type="number" min="0" name="pagosAbr" class="pago" step="any" style="width: 70px;" ></td>
                        <td><input type="number" min="0" name="pagosMay" class="pago" step="any" style="width: 70px;" ></td>
                        <td><input type="number" min="0" name="pagosJun" class="pago" step="any" style="width: 70px;" ></td>
                        <td><input type="number" min="0" name="pagosJul" class="pago" step="any" style="width: 70px;" ></td>
                        <td><input type="number" min="0" name="pagosAgo" class="pago" step="any" style="width: 70px;" ></td>
                        <td><input type="number" min="0" name="pagosSep" class="pago" step="any" style="width: 70px;" ></td>
                        <td><input type="number" min="0" id="TotalPagos" name="TotalPagos" step="any" style="width: 90px;" class="total"></td>
                    </tr>
                    <tr><td colspan="14"><input type="submit" name="submit" id="btnSometer" value="Someter">
                <input type="hidden" name="option" value="0"></td></form></tr></form>
                <thead>
                    <?php
                    // resultados
                    if($_POST){
                        if($_POST['option']==0){
                            fCapitado($_POST);
                        }elseif($_POST['option']==1){
                        // echo '<pre>';printr($_POST);
                        $p1 = $_POST['periodo'];
                        ($_POST['periodo2']) ? $p2 =  $_POST['periodo2'] : $p2 =  $p1-1;
                        }
                    }else{
                        $p1 =  date('Y');
                        $p2 =  $p1-1;
                    }
                    
                    $print = "<h3>Entries for period $p1 </h3>";
                    echo '<th colspan="21" style="text-align: center;">' . $print . '</th>
                        <tr>
                        <th colspan="21" style="text-align: center;" class="noprint">
                            <form id="form_2" action="capitados.php" target="_self" method="POST">
                                <input type="text" id="periodo2" name="periodo2" class="noprint" style="width: 50px;" value="'.@$p2.'" required> vs 
                                <input type="text" id="periodo" name="periodo" class="noprint" style="width: 50px;" value="'.$p1.'" required>
                                <input type="hidden" name="option" value="1">
                                <input type="submit" name="submit1" value="View period entries" class="noprint">
                                <a href=""><i class="fas fa-print" onclick="javascript:window.print();"></i></a>
                                <a href="exportcapi.php?p1='.$p1.'&p2='.@$p2.'" target="_blank"><i class="far fa-file-excel" id="exp"></i></a>                                    
                            </form>
                        </th>
                        </tr>';
                    ?>
                </thead>
                <tbody>
                    <?php            
                        getCapitado($p1);
                    ?>
                </tbody>
            </table>
        </div>
        <div id="comparativa" class="divx">
            <table>
            <?php            
            $tbl1 = getCapitado($p1);
            if(@$p2 > 2000){
                $tbl2 = getCapitado($p2);
            }else{
                $p2 =  $p1-1;
                $tbl2 = getCapitado($p2);
            }
            $html = '<tr><th>Mes</th><th>Socios Capitados '.$p2.'</th><th>Pago</th><th /><th>Socios Capitados '.$p1.'</th><th>Pago</th>';
            @$html .='<tr><td class="aleft">Octubre</td><td class="right">'.
            number_format($tbl2['CapOct'], $deciCapi, '.', ',').'</td><td class="right">'.number_format($tbl2['PagosOct'], $deciPagos, '.', ',').'</td><td /><td class="right">'.
            number_format($tbl1['CapOct'], $deciCapi, '.', ',').'</td><td class="right">'.number_format($tbl1['PagosOct'], $deciPagos, '.', ',').'</td></tr><tr><td class="aleft">Noviembre</td><td class="right">'.
            number_format($tbl2['CapNov'], $deciCapi, '.', ',').'</td><td class="right">'.number_format($tbl2['PagosNov'], $deciPagos, '.', ',').'</td><td /><td class="right">'.
            number_format($tbl1['CapNov'], $deciCapi, '.', ',').'</td><td class="right">'.number_format($tbl1['PagosNov'], $deciPagos, '.', ',').'</td></tr><tr><td class="aleft">Diciembre</td><td class="right">'.
            number_format($tbl2['CapDic'], $deciCapi, '.', ',').'</td><td class="right">'.number_format($tbl2['PagosDic'], $deciPagos, '.', ',').'</td><td /><td class="right">'.
            number_format($tbl1['CapDic'], $deciCapi, '.', ',').'</td><td class="right">'.number_format($tbl1['PagosDic'], $deciPagos, '.', ',').'</td></tr><tr><td class="aleft">Enero</td><td class="right">'.
            number_format($tbl2['CapEne'], $deciCapi, '.', ',').'</td><td class="right">'.number_format($tbl2['PagosEne'], $deciPagos, '.', ',').'</td><td /><td class="right">'.
            number_format($tbl1['CapEne'], $deciCapi, '.', ',').'</td><td class="right">'.number_format($tbl1['PagosEne'], $deciPagos, '.', ',').'</td></tr><tr><td class="aleft">Febrero</td><td class="right">'.
            number_format($tbl2['CapFeb'], $deciCapi, '.', ',').'</td><td class="right">'.number_format($tbl2['PagosFeb'], $deciPagos, '.', ',').'</td><td /><td class="right">'.
            number_format($tbl1['CapFeb'], $deciCapi, '.', ',').'</td><td class="right">'.number_format($tbl1['PagosFeb'], $deciPagos, '.', ',').'</td></tr><tr><td class="aleft">Marzo</td><td class="right">'.
            number_format($tbl2['CapMar'], $deciCapi, '.', ',').'</td><td class="right">'.number_format($tbl2['PagosMar'], $deciPagos, '.', ',').'</td><td /><td class="right">'.
            number_format($tbl1['CapMar'], $deciCapi, '.', ',').'</td><td class="right">'.number_format($tbl1['PagosMar'], $deciPagos, '.', ',').'</td></tr><tr><td class="aleft">Abril</td><td class="right">'.
            number_format($tbl2['CapAbr'], $deciCapi, '.', ',').'</td><td class="right">'.number_format($tbl2['PagosAbr'], $deciPagos, '.', ',').'</td><td /><td class="right">'.
            number_format($tbl1['CapAbr'], $deciCapi, '.', ',').'</td><td class="right">'.number_format($tbl1['PagosAbr'], $deciPagos, '.', ',').'</td></tr><tr><td class="aleft">Mayo</td><td class="right">'.
            number_format($tbl2['CapMay'], $deciCapi, '.', ',').'</td><td class="right">'.number_format($tbl2['PagosMay'], $deciPagos, '.', ',').'</td><td /><td class="right">'.
            number_format($tbl1['CapMay'], $deciCapi, '.', ',').'</td><td class="right">'.number_format($tbl1['PagosMay'], $deciPagos, '.', ',').'</td></tr><tr><td class="aleft">Junio</td><td class="right">'.
            number_format($tbl2['CapJun'], $deciCapi, '.', ',').'</td><td class="right">'.number_format($tbl2['PagosJun'], $deciPagos, '.', ',').'</td><td /><td class="right">'.
            number_format($tbl1['CapJun'], $deciCapi, '.', ',').'</td><td class="right">'.number_format($tbl1['PagosJun'], $deciPagos, '.', ',').'</td></tr><tr><td class="aleft">Julio</td><td class="right">'.
            number_format($tbl2['CapJul'], $deciCapi, '.', ',').'</td><td class="right">'.number_format($tbl2['PagosJul'], $deciPagos, '.', ',').'</td><td /><td class="right">'.
            number_format($tbl1['CapJul'], $deciCapi, '.', ',').'</td><td class="right">'.number_format($tbl1['PagosJul'], $deciPagos, '.', ',').'</td></tr><tr><td class="aleft">Agosto</td><td class="right">'.
            number_format($tbl2['CapAgo'], $deciCapi, '.', ',').'</td><td class="right">'.number_format($tbl2['PagosAgo'], $deciPagos, '.', ',').'</td><td /><td class="right">'.
            number_format($tbl1['CapAgo'], $deciCapi, '.', ',').'</td><td class="right">'.number_format($tbl1['PagosAgo'], $deciPagos, '.', ',').'</td></tr><tr><td class="aleft">Septiembre</td><td class="right">'.
            number_format($tbl2['CapSep'], $deciCapi, '.', ',').'</td><td class="right">'.number_format($tbl2['PagosSep'], $deciPagos, '.', ',').'</td><td /><td class="right">'.
            number_format($tbl1['CapSep'], $deciCapi, '.', ',').'</td><td class="right">'.number_format($tbl1['PagosSep'], $deciPagos, '.', ',').'</td></tr><tr><th class="aleft">Totales</th><th class="totales">'.
            number_format($tbl2['TotalCapitados'], $deciCap, '.', ',').'</th><th class="totales">'.number_format($tbl2['TotalPagos'], $deciPagos, '.', ',').'</th><th /><th class="totales">'.
            number_format($tbl1['TotalCapitados'], $deciCap, '.', ',').'</th><th class="totales">'.number_format($tbl1['TotalPagos'], $deciPagos, '.', ',').'</th></tr>'; 
            $html .= '</tr></table>';
            echo $html;
            ?>
            </table>
        </div>
    </div>
    </div>
    <div id="msg" class="msg" style="display: none">Successfully created!</div>
</body>
<script>
    $(document).inactivityTimeout();    number_format($tbl2['TotalPagos'], 2, '.', ',')
</script>
<script>
function openDiv(divName){
    var i;
    var x = document.getElementsByClassName("divx");
    for (i = 0; i < x.length; i++) {
        x[i].style.display = "none";  
    }
    document.getElementById(divName).style.display = "block";  
}
</script>