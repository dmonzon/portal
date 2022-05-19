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
<!-- <script>
    $(document).ready(function() {
        $(".cambia").click(function() {
            //esconder todos DIVs
            $(".content").hide();
            //obtener nombre del enlace
            nombre = $(this).attr("label");
            //mostrar el panel segun el nombre del enlace oprimido
            $("#" + nombre).show();
        });
    });

    function sortTable(columnName){
        //alert("hola");
        var sort = $("#sort").val();
        $.ajax({
        url:'info_details.php',
        type:'post',opt:1,
        data:{tabla:tabla,columnName:columnName,sort:sort,opt:opt},
        success: function(response){

        $("#empTable tr:not(:first)").remove();

        $("#empTable").append(response);
        if(sort == "asc"){
            $("#sort").val("desc");
        }else{
            $("#sort").val("asc");
        }

        }
        });
    }

    function DoNav(){
        m = $("#mySidebar").width();
        if (m > 0){
            document.getElementById("mySidebar").style.width = "0";
            document.getElementById("main").style.marginLeft= "0";
            $("#lnk").show();
        }else{
            document.getElementById("mySidebar").style.width = "350px";
            document.getElementById("main").style.marginLeft = "350px";
            $("#lnk").hide();
        }
    }
    function openNav() {
        // alert($("#mySidebar").width());
        document.getElementById("mySidebar").style.width = "350px";
        document.getElementById("main").style.marginLeft = "350px";
    }

    function closeNav() {
        // alert($("#mySidebar").width());
        document.getElementById("mySidebar").style.width = "0";
        document.getElementById("main").style.marginLeft= "0";
    }
</script> -->
<style>
    body { font-family: "Open Sans", sans-serif; padding-bottom: 100px; }
    span:hover{
        cursor:pointer;
        color:red;
    }
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
        padding:0,0,0,0;
        
    }
    .hd-table {
        border-collapse: collapse;
        width: 95%;
        margin-left: auto;
        margin-right: auto;font-family: "Open Sans", sans-serif; 
        padding: 0,0,0,0;
        
    }
    .hd-table th {
        text-align: left;
        padding: 5px;
        background-color:#FF6F6F;
    }        
    .hd-table tr,td {
        text-align: left;
        padding: 0px;
        background-color:white;
        font-size:12px;
        width:auto;
    }          
    .hd-table tr:nth-child(odd) {
        background-color:#FEE5E5 !important;/*#FEE5E5 */
    }
    /* .hd-table tr:nth-child(even) {
        background-color: white !important;
    } */
    tr {
        border:none;
    }
    td {
        border:none;
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
        /* display:none; */
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
    @media print
	{
	.noprint {
		display: none !important;
	}
	#btnPrint, #lblMain{
		display: none;
	  }
}
</style>
</head>
<body>
<div id="mySidebar" class="sidebar noprint">
    <!-- <a href="javascript:void(0)" class="closebtn" onclick="DoNav()"><i class="fa-solid fa-arrows-left-right-to-line"></i></a> -->
    <!-- <button class="noprint" style="border:none;background:none;" alt="Print" onclick="javascript:window.print();"><i class="fa-solid fa-print fa-lg"></i></button> -->
    <a class="cambia" label="Buscador"><i class="fa-solid fa-magnifying-glass fa-lg"></i></a>
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
  <button class="openbtn noprint" onclick="DoNav()" id="lnk"><i class="fa-solid fa-arrows-left-right-to-line"></i></button><!--☰</button>-->
  <?php echo $divs;?> 
</div>
  
</body>
</html> 
