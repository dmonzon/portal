<!DOCTYPE html>
<head>
    <title></title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="sleeplogs.js"></script>
    <script src="https://kit.fontawesome.com/f95af9be80.js" crossorigin="anonymous"></script>
    <style type = "text/css">
        @media screen,print{
            .tab {
                tab-size: 4;
                background:#FEE5E5;
                border:none;
            }
            span:hover{
                cursor:pointer;
                color:red;
            }
            .hd-table {
                border-collapse: collapse;
                width: 95%;
                margin-left: auto;
                margin-right: auto;
            }
            .hd-table th, td {
                text-align: left;
                padding: 5px;
            }        
            .hd-table tr:nth-child(odd) {background-color: #FEE5E5 !important;}
            /* tr:nth-child(odd) {background-color: white !important;} */
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
        <button class="noprint" style="border:none;color:red;background:none;" alt="Back" onclick="javascript:history.back();"><i class="fa-solid fa-arrow-left-long fa-lg"></i></button>
        <button class="noprint" style="border:none;color:red;background:none;" alt="Print" onclick="javascript:window.print();"><i class="fa-solid fa-print fa-lg"></i></button>
        <!-- <button class="noprint" style="border:none;color:red;background:none;" alt="search"><i class="fa-solid fa-magnifying-glass fa-lg"></i></button> -->
        <button id="btnf" class="noprint" style="border:none;color:red;background:none;" alt="show/hide" onclick="ShowHideF();"><i class="fa-solid fa-eye-slash fa-lg"></i></button>
    </div>
    <div class="noprint" id="head" style="width=95%;"></br>
        <form id="frmSearch" action="sleepfnd.php" target="_self"><input type="hidden" name="opt" value="2">
            <table style="background:#FEE5E5;margin-left: auto;margin-right: auto;border-collapse: collapse;">
                <tr>
                    <td colspan="2">
                        <b>Buscar en:</b>
                        <select id="selTable" name="selTable">
                            <option value="" selected>Seleccione</option>
                            <option value="Sleep_Studies_Results">Sleep Studies Results</option>:
                            <option value="Sleep_Listado_Expedientes">Listado de Expedientes de la Clínica</option>
                            <option value="Sleep_Listado_Referidos">Listado de Referidos</option>
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
                            <option value="Sleep_Solucion_Cidex">Registro de la Verificación de la Solución Cidex OPA e Inmersión del Equipo Durante el Proceso de Desinfección de Alto Nivel"</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td></td>
                    <td>
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
                    <td></td>
                    <td>
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
                    <td></td>
                    <td>
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
                    <td></td>
                    <td>
                        Ordenar por <select id="selField4" name="selField4" class="selField">
                        </select>
                        <select id="selOrderby" name="selOrderby">
                            <option value="asc">Ascendente</option>
                            <option value="desc">Descendente</option>
                        </select>
                    </td>
                </tr>
                <tr><td></td><td><button type="submit" id="btnBuscar1">Buscar</button></td></tr>
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
    extract($_GET);
    // echo"<pre>";
    // var_dump($_GET);
    if (!@$tb) {
        $tabla = "$selTable";
        $sql = "SELECT * FROM $selTable ";
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
    }else{
        $tabla = $_GET['tb'];
        $sql = "SELECT * FROM $tabla ";
    }
       $x=0;
        echo '<table class="hd-table" id="empTable"><tr>';
        $stmt = sqlsrv_query($conn, $sql);
        foreach(sqlsrv_field_metadata($stmt) as $field){
            echo '<th>'.$field['Name'].'</th>';
            $x++;
        }
        echo '</tr>';
        while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_BOTH)){
            for ($j = 0; $j < $x; $j++) {
                if ($row[$j] instanceof DateTime) {
                    echo "<td>".$row[$j]->format('m/d/Y H:i:s')."</td>";
                }else{
                    echo "<td>".($row[$j] == '' ? '0' : $row[$j]) ."</td>";
                }
            }
            //$x++;
            echo '</tr><br>';
        }
        echo "</table><br>";
        
    }

?>
    </div>
</div>
</body>
</html>
