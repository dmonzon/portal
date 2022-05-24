<!DOCTYPE html>
<?php
ini_set('display_errors',1);
ini_set('log_errors',0);
error_reporting(E_ALL & ~E_NOTICE);
session_start();
require_once("cno.php");
require_once("sleepdivs.php");
require_once("control.php");
// require_once("control.php");
// require_once("funcs.php");
include('header.php');
/********************************************
 * Danny Monzon
 * 20210909
 ********************************************/

if (!isset($_SESSION['username'])) {
    header('location:logout.php');
    exit();
}
$p1 = (@$_POST['periodo']) ? $_POST['periodo'] : date('Y'); 
$decPagos = 2; // numeros decimales a mostrar para los pagos
$decCapi = 0; // numeros decimales a mostrar para # de capitados
?>
<head>
    <title>Sleep Logs</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-modal/0.9.1/jquery.modal.min.css" />
    <link rel="stylesheet" type="text/css" href="w.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-modal/0.9.1/jquery.modal.min.js"></script>
    <script src="https://kit.fontawesome.com/2a9ceb1fca.js" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="sleeplogs.js"></script>
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
            width : auto;
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
        .content {
            width:auto;
            display: none;
        }
        .lrequired
        {
            color: red;
        }
        .row
        {
            width:auto;
        }

    </style>
</head>
<body><meta name="viewport" content="width=device-width, initial-scale=1">
<div class="row">
    <div class="column" style="background-color:#FFB695;">
        <ul>
            <h3><span style="color:red;">Listas</span></h3>
            <hr>
            <li><a class="cambia" label="SleepStudies">Sleep Studies Results</li></a>
            <li><a class="cambia" label="lstExpedientes">Listado de Expedientes de la Clínica</a></li>
            <li><a class="cambia" label="lstReferidos">Listado de Referidos</a></li>
            <li><a class="cambia" label="InspeccionVisual">Inspección Visual de Rutina</a></li>
            <li><a class="cambia" label="MaskFitting">Registro de Paciente-Class/Mask Fitting</a></li>
            <li><a class="cambia" label="ValCriticos">Valores Críticos</a></li>
            <hr>
            <h3><span style="color:red;">Logs</span></h3>
            <hr>
            <li><a class="cambia" label="LogCPAP">Log de Auto CPAP Prestados</a></li>
            <li><a class="cambia" label="logComunicacion">Log de Comunicación</a></li>
            <li><a class="cambia" label="logRechazo">Log de Rechazo de Tratamiento</a></li>
            <li><a class="cambia" label="solucionCidex">Registro de la Verificación de la Solución Cidex OPA e Inmersión del Equipo Durante el Proceso de Desinfección de Alto Nivel</a></li>
            <li><a class="cambia" label="frascoCIdex">Registro de Verificación de Frasco de Cidex OPA y Frasco de las Tirillas para las Pruebas Durante el Proceso de Desinfección de Alto Nivel</a></li>
            <hr><h3><span style="color:red;">Logs de DesinfecciónListas</span></h3><hr>
            <li><a class="cambia" label="CPAP">Desinfección CPAP</a></li>
            <li><a class="cambia" label="ETCO2">Desinfección ETCO2 Monitor</a></li>
            <li><a class="cambia" label="DuchasOjos">Duchas de lavado de ojos</a></li>
            <li><a class="cambia" label="UsoManejo">Uso y Manejo de Endozime AW Plus</a></li>
        </ul>
    </div>
    <div class="column" style="background-color:#96D1CD;">
        <?php echo $divs ?>
    </div>
</div>
    <!-- <table>
        <thead class="noprint" style="text-align: left;vertical-align:top;">
            <tr class="noprint">
                <th style="width:20%;text-align: center;" colspan="2">
                <ul>
                    <h3><span style="color:red;">Listas</span></h3>
                    <hr>
                    <li><a class="cambia" label="SleepStudies">Sleep Studies Results</li></a>
                    <li><a class="cambia" label="lstExpedientes">Listado de Expedientes de la Clínica</a></li>
                    <li><a class="cambia" label="lstReferidos">Listado de Referidos</a></li>
                    <li><a class="cambia" label="InspeccionVisual">Inspección Visual de Rutina</a></li>
                    <li><a class="cambia" label="MaskFitting">Registro de Paciente-Class/Mask Fitting</a></li>
                    <li><a class="cambia" label="ValCriticos">Valores Críticos</a></li>
                    <hr>
                    <h3><span style="color:red;">Logs</span></h3>
                    <hr>
                    <li><a class="cambia" label="LogCPAP">Log de Auto CPAP Prestados</a></li>
                    <li><a class="cambia" label="logComunicacion">Log de Comunicación</a></li>
                    <li><a class="cambia" label="logRechazo">Log de Rechazo de Tratamiento</a></li>
                    <li><a class="cambia" label="solucionCidex">Registro de la Verificación de la Solución Cidex OPA e Inmersión del Equipo Durante el Proceso de Desinfección de Alto Nivel</a></li>
                    <li><a class="cambia" label="frascoCIdex">Registro de Verificación de Frasco de Cidex OPA y Frasco de las Tirillas para las Pruebas Durante el Proceso de Desinfección de Alto Nivel</a></li>
                    <hr><h3><span style="color:red;">Logs de DesinfecciónListas</span></h3><hr>
                    <li><a class="cambia" label="CPAP">Desinfección CPAP</a></li>
                    <li><a class="cambia" label="ETCO2">Desinfección ETCO2 Monitor</a></li>
                    <li><a class="cambia" label="DuchasOjos">Duchas de lavado de ojos</a></li>
                    <li><a class="cambia" label="UsoManejo">Uso y Manejo de Endozime AW Plus</a></li>
                </ul>
                </th>
            <td style="width: 80%;text-align: left;vertical-align:top;font: size 18px;" colspan="12">
                < ?php echo $divs ?>
            </td>
        </tr>
        </thead>
        <tbody>
            < ?php getCapitado($p1);?>
        </tbody>
    </table> -->
<div id="msg" class="msg" style="display: none">Successfully created!</div>
</body>
<!-- <script>
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
</script> -->