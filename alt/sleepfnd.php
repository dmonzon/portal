<!DOCTYPE html>
<?php 
    require_once("cno.php");
    extract($_GET);
    // echo"<pre>";
    // var_dump($_GET);
    // echo "</pre>";
    //if(!@$tb) $tb = $tb;
?>  
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<!-- <link rel="stylesheet" type="text/css" href="w.css"> -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<link href="jquery-ui.css" rel="stylesheet">
<script src="https://kit.fontawesome.com/f95af9be80.js" crossorigin="anonymous"></script>
<script src="sleeplogs.js"></script>
<script src="idle.js"></script>
<script>
    function sortTable(tabla,columnName){
        var sort = $("#sort").val();
        var tsql = $("#tsql").val();
        // alert(tsql);
        $.ajax({
        url:'info_details.php',
        type:'post',
        data:{tabla:tabla,columnName:columnName,sort:sort,tsql:tsql},
        success: function(response){

        $("#empTable tr:not(:first)").remove();
        // $("#empTable tr:gt(1)").remove();


        $("#empTable").append(response);
        if(sort == "asc"){
            $("#sort").val("desc");
        }else{
            $("#sort").val("asc");
        }

        }
        });
    }

    $(document).ready(function(){
        $(".edit").click(function(){
            url = $(this).attr("data-id");
            // alert(url);
            $("#myModal").modal();
            load_page(url);
        });
    });

    function load_page(url){
        $('#modal-body').load(url,function(){});
    }
</script>
<style type = "text/css">
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
    @media screen,print{
        body { font-family: "Open Sans", sans-serif; font-size:12px; }
        .tab {
            tab-size: 4;
            background:#FEE5E5;
            border:none;
        }
        table {
            border-collapse: collapse;
            width: 95%;
            margin-left: auto;
            margin-right: auto;
        }
        span:hover{
            cursor:pointer;
            color:red;
        }
        th, td {
            text-align: left;
            padding: 5px;
            border: 1px solid red; 
        }        
        tr:nth-child(odd) {background-color: #FEE5E5 !important;}
    }
    @media print
        {
        .noprint {display: none !important;}
        }
    }
</style>
</head>
<html>
<body>
    <div id="main">
    <div id="top" style="text-align:center;width=95%;">
        <img src="imgs/ham-logo.png"></br></br>
        <button class="noprint" style="border:none;color:red;background:none;" alt="Back" onclick="window.location.href = 'sleeplogs.php';"><i class="fa-solid fa-house-crack fa-lg"></i></button>
        <!-- <button class="noprint" style="border:none;color:red;background:none;" alt="Back" onclick="javascript:history.back();"><i class="fa-solid fa-arrow-left-long fa-lg"></i></button> -->
        <button class="noprint" style="border:none;color:red;background:none;" alt="Print" onclick="javascript:window.print();"><i class="fa-solid fa-print fa-lg"></i></button>
        <!-- <button class="noprint" style="border:none;color:red;background:none;" alt="search"><i class="fa-solid fa-magnifying-glass fa-lg"></i></button> -->
        <button id="btnf" class="noprint" style="border:none;color:red;background:none;" alt="show/hide" onclick="ShowHideF();"><i class="fa-solid fa-eye-slash fa-lg"></i></button>
        <?php echo '</br><span style="color:red;font-style:oblique;font-size: 30px;font-stretch: expanded;font-weight: bold;">'.getRepTittle($tb).'</span>';?>
    </div>
    <div class="noprint" id="head" style="width=95%;"></br>
        <form id="frmSearch" action="sleepfnd.php" target="_self"><input type="hidden" name="opt" value="2">
            <table style="background:#FEE5E5;margin-left: auto;margin-right: auto;border-collapse: collapse;">
                <tr>
                    <td colspan="2">
                        <b>Buscar en:</b>
                        <select id="tb" name="tb">
                            <option value="">Seleccione</option>
                            <!--<option value="Sleep_Studies_Results">Sleep Studies Results</option>:
                            <option value="Sleep_Listado_Expedientes">Listado de Expedientes de la Clínica</option>
                            <option value="Sleep_Listado_Referidos">Listado de Referidos</option>-->
                            <option value="Sleep_Inspeccion_Rutina">Inspección Visual de Rutina</option>
                            <option value="Sleep_Registro_Paciente">Registro de Paciente-Class/Mask Fitting</option>
                            <option value="Sleep_Valores_Criticos">Valores Críticos</option>
                            <option value="Sleep_CPAP_Prestados">Log de Auto CPAP Prestados</option>
                            <option value="Sleep_Comunicacion">Log de Comunicación</option>
                            <option value="Sleep_Rechazo">Log de Rechazo de Tratamiento</option>
                            <option value="Sleep_Endozime">Uso y Manejo de Endozime AW Plus</option>
                            <option value="Sleep_Ojos">Duchas de lavado de ojos</option>
                            <option value="Sleep_ETCO">Desinfección ETCO2 Monitor</option>
                            <option value="Sleep_Desinfeccion_CPAP">Desinfección CPAP</option>
                            <option value="Sleep_Frasco_Cidex">Registro de Verificación de Frasco de Cidex OPA y Frasco de las Tirillas para las Pruebas Durante el Proceso de Desinfección de Alto Nivel</option>
                            <option value="Sleep_Solucion_Cidex">Registro de la Verificación de la Solución Cidex OPA e Inmersión del Equipo Durante el Proceso de Desinfección de Alto Nivel</option>
                            <option value="Sleep_Mant_Cap">Mantenimiento Preventivo Capnografo</option>
                            <option value="Sleep_Mant_PAP">Mantenimiento Preventivo PAP</option>
                            <option value="Sleep_Mant_HA">Mantenimiento Preventivo Headbox y Amplificadores</option>
                            <option value="Sleep_Mant_Equipos">Mantenimiento Equipos</option>
                            <option value="Sleep_Biomedica_Equipos">Equipos enviados para reparación</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td style="border-right:none;"></td>
                    <td style="border-left:none;">
                        <select id="selField" name="selField"  class="selField">
                        </select>
                        <select id="selOpt1" name="selOpt1">
                            <option value="=">= (igual a)</option>
                            <option value="!=">≠ (no es igual a)</option>
                            <option value=">=">> (mayor que)</option>
                            <option value="<=">< (menor que)</option>
                            <option value=">=">>= (mayor o igual a)</option>
                            <option value="<="><= (menor o igual a)</option>
                            <option value="like">Contiene</option>
                        </select>
                        <input type="text" name="txtValue" id="txtValue">
                        <select id="selOperator" name="selOperator">
                            <option value="n" selected></option>
                            <option value="and">Y</option>
                            <option value="or">O</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td style="border-right:none;"></td>
                    <td style="border-left:none;">
                        <select id="selField2" name="selField2" class="selField">
                        </select>
                        <select id="selOpt2" name="selOpt2">
                            <option value="=">= (igual a)</option>
                            <option value="!=">≠ (no es igual a)</option>
                            <option value=">=">> (mayor que)</option>
                            <option value="<=">< (menor que)</option>
                            <option value=">=">>= (mayor o igual a)</option>
                            <option value="<="><= (menor o igual a)</option>
                            <option value="like">Contiene</option>
                        </select>
                        <input type="text" name="txtValue2" id="txtValue2">
                        <select id="selOperator2" name="selOperator2">
                            <option value="n" selected></option>
                            <option value="and">Y</option>
                            <option value="or">O</option>
                        </select></pre>
                    </td>
                </tr>
                <tr>
                    <td style="border-right:none;"></td>
                    <td style="border-left:none;">
                        <select id="selField3" name="selField3" class="selField">
                        </select>
                        <select id="selOpt3" name="selOpt3">
                            <option value="=">= (igual a)</option>
                            <option value="!=">≠ (no es igual a)</option>
                            <option value=">">> (mayor que)</option>
                            <option value="<">< (menor que)</option>
                            <option value=">=">>= (mayor o igual a)</option>
                            <option value="<="><= (menor o igual a)</option>
                            <option value="like">Contiene</option>
                        </select>
                        <input type="text" name="txtValue3" id="txtValue3">
                    </td>
                </tr>
                <tr>
                    <td style="border-right:none;"></td>
                    <td style="border-left:none;">
                        Ordenar por <select id="selField4" name="selField4" class="selField">
                        </select>
                        <select id="selOrderby" name="selOrderby">
                            <option value="asc">Ascendente</option>
                            <option value="desc">Descendente</option>
                        </select>
                    </td>
                </tr>
                <tr><td style="border-right:none;"></td><td style="border-left:none;"><button type="submit" id="btnBuscar1">Buscar</button></td></tr>
            </table>
        </p>
        </form>
    </div>
    <div id="result"><input type="hidden" id="sort" value="asc">
<?php
require_once('cno.php');
$db = new ServidorBD();
$conn = $db->Conectar('x');
if($_GET){
    // echo"<pre>";
    // var_dump($_GET);
    // if (!@$tb) {
    //$tabla = "$tb";
    $sql = "SELECT * FROM $tb ";
    if(@$opt > 0)
    {
        if($selOpt1 === 'like') {
            $sql .= "WHERE $selField like '%$txtValue%'";
        }else{
            $sql .= "WHERE $selField $selOpt1 '$txtValue'";
        }

        if($selOperator == 'and' || $selOperator == 'or'){
            if($selOpt1 === 'like') {
                $sql .= " $selOperator $selField2 like '%$txtValue2%'";
            }else{
                $sql .= " $selOperator $selField2 $selOpt2 '$txtValue2'";
            }
        }
        
        if($selOperator2 == 'and' || $selOperator2 == 'or'){
            if($selOpt3 === 'like') {
                $sql .= " $selOperator2 $selField3 like '%$txtValue3%'";
            }else{
                $sql .= " $selOperator2 $selField3 $selOpt3 '$txtValue3'";
            }
        }
        $sql .= " order by $selField4 $selOrderby";
    }
    // }else{
    //     echo "<pre>";
    //     var_dump($_GET);
    //     echo "</pre>";

    //     $tabla = $_GET['tb'];
    //     $sql = "SELECT * FROM $tabla order by modified desc";
    // }
        $x=0;
        echo '<input type="hidden" id="tsql" value="'.$sql.'"><table class="hd-table" id="empTable">';//<table width='95%' id='empTable'>
        $stmt = sqlsrv_query($conn, $sql);
        gSleepTable($stmt,$tb,$sql,'0');
        echo '</tr>';
    }

?>
    </div>
</div>
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-body" id="modal-body">
    </div>
</div>
</body>
</html>
