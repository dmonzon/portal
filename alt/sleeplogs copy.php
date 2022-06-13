<!DOCTYPE html>
<?php
ini_set('display_errors',1);
ini_set('log_errors',0);
error_reporting(E_ALL & ~E_NOTICE);
session_start();
require_once("cno.php");
require_once("sleepdivs.php");
?>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-modal/0.9.1/jquery.modal.min.css" />
<!-- <link rel="stylesheet" type="text/css" href="w.css"> -->
<script src="https://kit.fontawesome.com/f95af9be80.js" crossorigin="anonymous"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="sleeplogs.js"></script>

<style>    
    a:link {
	    color: red;
	}
	
	/* visited link */
	a:visited {
	    color: red;
	}
	
	/* mouse over link */
	a:hover {
	    color:darkred;
	}
	
	/* selected link */
	a:active {
	    color: chocolate;
    }
    table{
        border:none !important;
    }
    tr {
        border:none !important;
    }
    td {
        border:none !important;
        background-color:#FFF7F9;
        padding: 5px;
    } 
    body {
        font-family: "Lato", sans-serif;
        font-size: 13px;
        background-color:#FFF7F9;
    }

    .content {
        display: none;
        width:50%;
        background-color:#FFF7F9;
        /* border:none; */
    }
    content {
        border:none;
    }
    .sidebar {
        height: 100%;
        width: 350px;
        position: fixed;
        z-index: 1;
        top: 0;
        left: 0;
        background-color:#FFF7F9;
        overflow-x: hidden;
        transition: 0.5s;
        padding-top: 10px;
    }
    .lrequired
    {
        color: red;
    }
    .sidebar a {
        padding: 3px 3px 3px 32px;
        text-decoration: none;
        font-size: 15px;
        /* color: #818181; */
        color: #000;
        display: fixed;
        transition: 0.3s;
    }

    .sidebar a:hover {
        color: red;
    }

    .sidebar .closebtn {
        position: absolute;
        top: 0;
        right: 25px;
        font-size: 30px;
        margin-left: 50px;
    }

    .openbtn {
        font-size: 20px;
        cursor: pointer;
        background-color: #111;
        color: white;
        padding: 5px 10px;
        border: none;
        display:none;
    }

    .openbtn:hover {
        background-color: red;
    }

    #main {
        transition: margin-left .5s;
        /* padding: px; */
        margin-left:350px;
        background-color:#FFF7F9;
    }

    /* On smaller screens, where height is less than 450px, change the style of the sidenav (less padding and a smaller font size) */
    @media screen and (max-height: 450px) {
    .sidebar {padding-top: 15px;}
    .sidebar a {font-size: 18px;}
    }
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
    li:hover {
        cursor: pointer;
    }
</style>
</head>
<body>
<div id="mySidebar" class="sidebar">
    <a href="javascript:void(0)" class="closebtn" onclick="DoNav()"><!--<i class="fa-solid fa-bars mnu">--><i class="fa-solid fa-arrows-left-right-to-line"></i></a>
    <ul>
        <h3><span style="color:red;">Listas</span></h3>
        <hr>
        <li><a class="cambia" label="lstExpedientes">Listado de Expedientes de la Clínica</a></li></br>
        <li><a class="cambia" label="lstReferidos">Listado de Referidos</a></li></br>
        <li><a class="cambia" label="SleepStudies">Sleep Studies Results</li></a></br>
        <hr><h3><span style="color:red;">Logs</span></h3><hr>
        <li><a class="cambia" label="InspeccionVisual">Inspección Visual de Rutina</a></li></br>
        <li><a class="cambia" label="MaskFitting">Registro de Paciente-Class/Mask Fitting</a></li></br>
        <li><a class="cambia" label="ValCriticos">Valores Críticos</a></li></br>
        <li><a class="cambia" label="LogCPAP">Log de Auto CPAP Prestados</a></li></br>
        <li><a class="cambia" label="logComunicacion">Log de Comunicación</a></li></br>
        <li><a class="cambia" label="logRechazo">Log de Rechazo de Tratamiento</a></li></br>
        <hr><h3><span style="color:red;">Logs de Desinfección</span></h3><hr>
        <li><a class="cambia" label="solucionCidex">Registro de la Verificación de la Solución Cidex OPA e Inmersión del Equipo Durante el Proceso de Desinfección de Alto Nivel</a></li></br>
        <li><a class="cambia" label="frascoCIdex">Registro de Verificación de Frasco de Cidex OPA y Frasco de las Tirillas para las Pruebas Durante el Proceso de Desinfección de Alto Nivel</a></li></br>
        <li><a class="cambia" label="CPAP">Desinfección CPAP</a></li></br>
        <li><a class="cambia" label="ETCO2">Desinfección ETCO2 Monitor</a></li></br>
        <li><a class="cambia" label="DuchasOjos">Duchas de lavado de ojos</a></li></br>
        <li><a class="cambia" label="UsoManejo">Uso y Manejo de Endozime AW Plus</a></li></br>
    </ul>
</div>

<div id="main">
  <button class="openbtn" onclick="DoNav()" id="lnk">☰</button>
  <?php echo $divs;?> 
</div>
  
</body>
</html> 
