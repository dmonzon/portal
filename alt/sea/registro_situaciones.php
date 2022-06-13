<!DOCTYPE html>
<head>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="registro_sea.js"></script>
    <style>
        .editor{
            display:none;
        }
    </style>  
</head>
<?php
require_once('../cno.php');
date_default_timezone_set("America/Puerto_Rico");
$today = getdate();
$dias = array('Domingo','Lunes','Martes','Miércoles','Jueves','Viernes','Sábado');
$meses = array('','Enero','Febrero','Marzo','Abril', 'Mayo','Junio','Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre');
$dia = $dias[$today['wday']];
$mes = $meses[$today['mon']];
$time = date('H:i:s');
$am = (intval($today['hours']) < 12 ?  'AM' : 'PM');
$display = $dia . ' ' . $today['mday'] . ' de ' . $mes . " " . $today['year'] . ', ' . $time . ' ' . $am;
?>
</br><center><img src="../imgs/ham-logo.png" style="text-align:center;"></img></center></br></br>
<div style="margin-left:auto;margin-right:auto;background-color:rgb(128,0,0); height:90px;  width:60%;">
    <table style="height:100%; width:100%; padding-top:.3em;">
        <tr>
            <td style="vertical-align:central; text-align:center;font-size:32px;font-family:Arial;">
                <Label ID="Label2" style="color:white;">Hospital Auxilio Mutuo</Label>
            </td>
        </tr>
        <tr>
            <td style="vertical-align:central; text-align:center;font-size:25px;font-family:Arial;">                    
                <Label ID="Label1" style="color:white;">Registro Situaciones de SEA</Label>
            </td>
        </tr>            
    </table>        
</div>

<div id="header" style="margin-left:auto;margin-right:auto;width:60%;">
    <table>
        <tr>
            <td colspan="2">
                Registro De Situaciones SEA
            </td>
        </tr>
        <tr>
            <td colspan="2"><?php echo $display?></td>
        </tr>
        <tr>
            <td>
                <form id="frmSearch" action="registro_situaciones.php" method="post">No. de visita <input type="text" name="visitID" id="visitID" class="visit">
            </td>
            <td><input type="submit" id="btnBuscar" value="Buscar"></td></form>
        </tr>
        <tr>
            <td colspan="2">
            <form id="frmMain" action="registro_situaciones.php" method="post">
                <input type="hidden" id="visit" name="visit" value="true" >
            </td>
        </tr>

    </table>        
</div>
<div id="fields" style="margin-left:auto;margin-right:auto;width:60%;" class="editor">
    <table class="hd-table" id="empTable">
        <tr>
            <td><Label ID="Label_PatientName">Nombre del Paciente<Label></td>
            <td colspan="2"><input type="text" ID="nombre" name="nombre" Width="260px"></td>
        </tr>
        <tr>
            <td><Label>Hora de Llegada:</Label></td>
            <td colspan="2"><input type="datetime-local" ID="llegada" name="llegada" Width="260px"></td>
        </tr>
        <tr>
            <td><Label ID="Label_Location">Ubicación:</Label></td>
            <td colspan="2"><input type="text" ID="ubicacion" name="ubicacion" Width="260px"></td>
        </tr>
        <tr>
            <td><Label ID="Label_Bed" >Cama:</Label></td>
            <td colspan="2"><input type="text" ID="cama" name="cama" Width="260px"></td>
        </tr>
        <tr>
            <td><Label ID="Label_TriageLevel" >Categoria del Paciente:</Label></td>
            <td colspan="2"><input type="text" ID="categoria" name="categoria" Width="300px"></td>
        </tr>
        <tr>
            <td><Label ID="Label_Coord_Rep" >Coord/Rep:</Label></td>
            <td colspan="2"><input type="text" ID="coord" name="coord" Width="260px"></td>
        </tr>
        <tr>
            <td><Label ID="Label_Situ1" >Situacion 1:</Label></td>
            <td><select name="Situacion1" id="Situacion1" class="Situacion1"><option value=""></option></select></td>
            <td></td>
        </tr>
        <tr>
            <td><Label ID="Label_Situ2" >Situacion 2:</Label></td>
            <td>
                <select name="Situacion2" id="Situacion2" class="Situacion1">
                    <option value=""></option>
                </select>
            </td>
            <td></td>
        </tr>
        <tr>
            <td><Label ID="Label_Situ3" >Situacion 3:</Label></td>
            <td>
                <select name="Situacion3" id="Situacion3" class="Situacion1">
                    <option value=""></option>
                </select>
            </td>
            <td></td>
        </tr>
        <tr>
            <td><Label ID="Label_Comments" >Comentarios:</Label><input type="hidden" name="accion" value="nuevo"></td>
            <td colspan="2"><textarea rows="10" cols="60" name="comentario" id="comentario"></textarea></td>
        </tr>
        <tr>
            <td colspan="3"><input type="submit" id="Button_Submit" value="Guardar Registro"/></td>
        </tr>
    </table>
</div>
<div id="results" style="margin-left:auto;margin-right:auto;width:60%;" class="results">
    
</div>
<?php 
if($_POST){
    extract($_POST);
    // echo"<pre>";
    // var_dump($_POST);
    // echo"</pre>";
    if(@$accion === 'nuevo'){
        $db = new ServidorBD;
        $conn = $db->Conectar('a');
        $ur = 'user_name';
        $tsql = "INSERT INTO SEA_Registro_Situaciones
                        ([VisitID],[Nombre],[Hora_Llegada],[Ubicacion],[Cama],[Categoria],[CoordRep],[Situacion1],[Situacion2],[Situacion3],[Comentarios],[Created],[CreatedBy])
                VALUES (?,?,?,?,?,?,?,?,?,?,?,getdate(),?)";
        $dt = str_replace('T', ' ', $llegada);
        $params =array($visit,$nombre,$dt,$ubicacion,$cama,$categoria,$coord,$Situacion1,$Situacion2,$Situacion3,$comentario,$ur);
        $stmt = sqlsrv_prepare($conn, $tsql, $params);
        if (!$stmt) {
            die( "<pre>" . print_r( sqlsrv_errors(). "</pre>", true));
        }
        if(!sqlsrv_execute($stmt))
        {  
            die( "<pre>".print_r( sqlsrv_errors(), true))."</pre>";
        }
        sqlsrv_free_stmt( $stmt);
        sqlsrv_close( $conn);
        $db->Desconectar();
    }
}

?>