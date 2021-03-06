<!DOCTYPE >
<?php
require_once('cno.php');
$db = new ServidorBD();
$conn = $db->Conectar('x');
if($_GET){
    // echo "<pre>GET";
    // var_dump($_GET);
    extract($_GET);
    $tsql = "SELECT * FROM $tb where id =".$id;
    $stmt = sqlsrv_query($conn, $tsql);
    $row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_NUMERIC);
    // echo"<pre><br>";
    // var_dump($row);
}
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
    <script src="https://kit.fontawesome.com/2a9ceb1fca.js" crossorigin="anonymous"></script>
    <script src="censo.js"></script>
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
            height: auto;
            /* line-height: 100px; */
            font-size:15px;
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

        #forma {
            float:left;
            width:79%;
            padding:0px;
            padding-top: 5px;
        }
        #empleados {
            float:right;
            width:20%;
            padding:0px;
            padding-top: 5px;
            padding-left: 2px;
        }
        ul.no-bullets {
            list-style-type: none;
            padding: 0;
            margin: 0;
        }
    </style>
    <title></title>
</head>

<!--<center><img src="imgs/hamlogo.png"></center>-->
<?php
// echo $tb."<br>id:".$id;
    switch ($tb) {
        case 'Sleep_Comunicacion_HSAT':
            echo '<div id="logComunicacionHSAT" >
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">					
                                Log de Comunicaci??n HSAT
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">??</button>
                            </div>
                        <div class="modal-body">
                        <form id="frmlogComunicacionH" action="rpt.php" target="_self" method="post">
                        <table>
                            <input type="hidden" value="Sleep_Comunicacion_HSAT" name="tb"><input type="hidden" value="1" name="update">
                            <tr>
                                <td style="text-align: left;border: none ;width:20%;"><label for="chFecha">Fecha y Hora de llamada:</label></td>
                                <td style="text-align: left;border: none ;width:30%;"><input type="datetime-local" id="chFecha" name="chFecha" value="'.(!$row[1] == '' ? $row[1]->format('Y-m-d\TH:i'):'').'"></br></td>
                                <td style="text-align: left;border: none ;width:40%;" colspan="2">
                            </tr>
                            <tr>
                                <td style="text-align: left;border: none ;width:20%;"><label for="chName">Nombre del paciente</label></td>
                                <td style="text-align: left;border: none ;width:30%;"><input type="text" id="chName" name="chName" value="'.$row[2].'" required></br></td>
                                <td style="text-align: left;border: none ;width:40%;"></td>
                            </tr>
                            <tr>
                                <td style="text-align: left;border: none ;width:20%;"><label for="chCaller">Persona que llama al centro:</label></td>
                                <td style="text-align: left;border: none ;width:30%;"><input type="text" id="chCaller" name="chCaller" value="'.$row[3].'" required></br></td>
                                <td style="text-align: left;border: none ;width:40%;"></td>
                            </tr>
                            <tr>
                                <td style="text-align: left;border: none ;width:20%;"><label for="chDispositivo">Numero de identificaci??n del dispositivo:</label></td>
                                <td style="text-align: left;border: none ;width:30%;"><input type="text" id="chDispositivo" name="chDispositivo" value="SN-BWM2022-7101" required></br></td>
                                <td style="text-align: left;border: none ;width:40%;"></td>
                            </tr>
                            <tr>
                                <td style="text-align: left;border: none ;width:20%;"><label for="chAsunto">Asunto identificado o problema con el equipo:</label></td>
                                <td style="text-align: left;border: none ;width:30%;"><textarea id="chAsunto" name="chAsunto">'.$row[5].'</textarea></br></td>
                                <td style="text-align: left;border: none ;width:40%;"></td>
                            </tr>
                            <tr>
                                <td style="text-align: left;border: none ;width:20%;"><label for="chSolucion">Soluci??n o recomendaci??n brindada al paciente:</label></td>
                                <td style="text-align: left;border: none ;width:30%;"><textarea id="chSolucion" name="chSolucion">'.$row[6].'</textarea></br></td>
                                <td style="text-align: left;border: none ;width:40%;"></td>
                            </tr>
                            <tr>
                                <td style="text-align: left;border: none ;width:20%;"><label for="chTecnico">Nombre del tecnico</label></td>
                                <td style="text-align: left;border: none ;width:30%;"><input type="text" id="chTecnico" name="chTecnico" value="'.$row[7].'"  required></br></td>
                                <td style="text-align: left;border: none ;width:40%;"></td>
                            </tr>
                            <tr>
                                <td style="text-align: center;border:none;width:20%;" colspan="3">
                                    <input type="hidden" name="id" value="'.$row[0].'">
                                    <input type="submit" id="btnSubmit31" value="Guardar">
                                    <input type="button" id="btnCancel31" value="Cancelar">
                                </td><td style="text-align: left;border:none;"></td>
                            </tr>
                            </table>
                            </form>
                    </div>
                    <div class="modal-footer">
                        <input type="button" class="btn btn-default" data-dismiss="modal" value="Done">
                    </div>
                    </div>
                </div>
            </div>';
        break;
        case 'Sleep_Devolucion_HSAT':
            echo '<div id="logDevolucionHSAT" >
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">					
                                Log de Registro de Devolucion del HSAT
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">??</button>
                            </div>
                        <div class="modal-body">
                        <form id="frmlogComHSAT" action="rpt.php" target="_self" method="post"><input type="hidden" value="Sleep_Devolucion_HSAT" name="tb"><input type="hidden" value="1" name="update">
                        <table>
                            <tr>
                                <td style="text-align: left;border: none ;width:20%;"><label for="vstId">Visit ID</label></td>
                                <td style="text-align: left;border: none ;width:30%;"><input type="text" id="vstId" name="vstId" value="'.$row[1].'"></br></td>
                                <td style="text-align: left;border: none ;width:40%;" colspan="2">
                            </tr>
                            <tr>
                                <td style="text-align: left;border: none ;width:20%;"><label for="rhFecha">Fecha y Hora de devolucion:</label></td>
                                <td style="text-align: left;border: none ;width:30%;"><input type="datetime-local" id="rhFecha" name="rhFecha" value="'.(!$row[2] == '' ? $row[2]->format('Y-m-d\TH:i'):'').'"></br></td>
                                <td style="text-align: left;border: none ;width:40%;" colspan="2">
                            </tr>
                            <tr>
                                <td style="text-align: left;border: none ;width:20%;"><label for="rhName">Nombre del paciente</label></td>
                                <td style="text-align: left;border: none ;width:30%;"><input type="text" id="rhName" name="rhName" value="'.$row[3].'"  required></br></td>
                                <td style="text-align: left;border: none ;width:40%;"></td>
                            </tr>
                            <tr>
                                <td style="text-align: left;border: none ;width:20%;"><label for="rhEquipo">Tipo de equipo prestado:</label></td>
                                <td style="text-align: left;border: none ;width:30%;">
                                <input type="radio" id="rhEquipo" name="rhEquipo" value="HSAT-SN-BWM2022-7101" checked><label for="radio1">HSAT-SN-BWM2022-7101</label></br></td>
                                <td style="text-align: left;border: none ;width:40%;"></td>
                            </tr>
                            <tr>
                                <td style="text-align: left;border: none ;width:20%;"><label for="rhInspeccion">Inspeccion de rutina:</label></td>
                                <td style="text-align: left;border: none ;width:30%;">
                                    <input type="radio" id="chAsunto1" name="rhInspeccion" value="Funcional" '.(trim($row[5]) =='Funcional' ? 'checked' : '').'><label for="radio1">Funcional</label></br>
                                    <input type="radio" id="chAsunto2" name="rhInspeccion" value="Defectuoso"'.(trim($row[5]) =='Defectuoso' ? 'checked' : '').'><label for="radio2">Defectuoso</option>
                                <td style="text-align: left;border: none ;width:40%;"></td>
                            </tr>
                            <tr>
                                <td style="text-align: left;border: none ;width:20%;"><label for="rhComentarios">Comentarios:</label></td>
                                <td style="text-align: left;border: none ;width:30%;"><textarea id="rhComentarios" name="rhComentarios">'.$row[6].'</textarea></br></td>
                                <td style="text-align: left;border: none ;width:40%;"></td>
                            </tr>
                            <tr>
                                <td style="text-align: left;border: none ;width:20%;"><label for="rhTecnico">Nombre del tecnico</label></td>
                                <td style="text-align: left;border: none ;width:30%;"><input type="text" id="rhTecnico" name="rhTecnico" value="'.$row[7].'" required></br></td>
                                <td style="text-align: left;border: none ;width:40%;"></td>
                            </tr>
                            <tr>
                                <td style="text-align: center;border:none;width:20%;" colspan="5">
                                    <input type="hidden" name="id" value="'.$row[0].'">
                                    <input type="submit" id="btnSubmit31" value="Guardar">
                                    <input type="button" id="btnCancel31" value="Cancelar">
                                </td>
                            </tr>
                            </table>
                            </form>
                    </div>
                    <div class="modal-footer">
                        <input type="button" class="btn btn-default" data-dismiss="modal" value="Done">
                    </div>
                </div>
                </div>
            </div>';
        break;
        case 'Sleep_Registro_HSAT':
            echo '<div id="logResgistroHSAT" >
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">					
                                Log de Registro y Mantenimiento del HSAT
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">??</button>
                            </div>
                        <div class="modal-body">
                        <form id="frmlogComHSAT" action="rpt.php" target="_self" method="post"><input type="hidden" value="Sleep_Registro_HSAT" name="tb"><input type="hidden" value="1" name="update">
                        <table>
                            <tr>
                                <td style="text-align: left;border: none ;width:20%;"><label for="vstId">Visit ID</label></td>
                                <td style="text-align: left;border: none ;width:30%;"><input type="text" id="vstId" name="vstId" value="'.$row[1].'"></br></td>
                                <td style="text-align: left;border: none ;width:40%;" colspan="2">
                            </tr>
                            <tr>
                                <td style="text-align: left;border: none ;width:20%;"><label for="rhFecha">Fecha y Hora de entrega:</label></td>
                                <td style="text-align: left;border: none ;width:30%;"><input type="datetime-local" id="rhFecha" name="rhFecha" value="'.(!$row[2] == '' ? $row[2]->format('Y-m-d\TH:i'):'').'"></br></td>
                                <td style="text-align: left;border: none ;width:40%;" colspan="2">
                            </tr>
                            <tr>
                                <td style="text-align: left;border: none ;width:20%;"><label for="rhName">Nombre del paciente</label></td>
                                <td style="text-align: left;border: none ;width:30%;"><input type="text" id="rhName" name="rhName" value="'.$row[3].'"  required></br></td>
                                <td style="text-align: left;border: none ;width:40%;"></td>
                            </tr>
                            <tr>
                                <td style="text-align: left;border: none ;width:20%;"><label for="rhEquipo">Tipo de equipo prestado:</label></td>
                                <td style="text-align: left;border: none ;width:30%;">
                                <input type="radio" id="rhEquipo" name="rhEquipo" value="HSAT-SN-BWM2022-7101" checked><label for="radio1">HSAT-SN-BWM2022-7101</label></br></td>
                                <td style="text-align: left;border: none ;width:40%;"></td>
                            </tr>
                            <tr>
                                <td style="text-align: left;border: none ;width:20%;"><label for="rhInspeccion">Inspeccion de rutina:</label></td>
                                <td style="text-align: left;border: none ;width:30%;">
                                    <input type="radio" id="chAsunto1" name="rhInspeccion" value="Funcional" '.(trim($row[5]) =='Funcional' ? 'checked' : '').'><label for="radio1">Funcional</label></br>
                                    <input type="radio" id="chAsunto2" name="rhInspeccion" value="Defectuoso"'.(trim($row[5]) =='Defectuoso' ? 'checked' : '').'><label for="radio2">Defectuoso</option>
                                <td style="text-align: left;border: none ;width:40%;"></td>
                            </tr>
                            <tr>
                                <td style="text-align: left;border: none ;width:20%;"><label for="rhComentarios">Comentarios:</label></td>
                                <td style="text-align: left;border: none ;width:30%;"><textarea id="rhComentarios" name="rhComentarios">'.$row[6].'</textarea></br></td>
                                <td style="text-align: left;border: none ;width:40%;"></td>
                            </tr>
                            <tr>
                                <td style="text-align: left;border: none ;width:20%;"><label for="rhTecnico">Nombre del tecnico</label></td>
                                <td style="text-align: left;border: none ;width:30%;"><input type="text" id="rhTecnico" name="rhTecnico" value="'.$row[7].'" required></br></td>
                                <td style="text-align: left;border: none ;width:40%;"></td>
                            </tr>
                            <tr>
                                <td style="text-align: center;border:none;width:20%;" colspan="5">
                                    <input type="hidden" name="id" value="'.$row[0].'">
                                    <input type="submit" id="btnSubmit31" value="Guardar">
                                    <input type="button" id="btnCancel31" value="Cancelar">
                                </td>
                            </tr>
                            </table>
                            </form>
                    </div>
                    <div class="modal-footer">
                        <input type="button" class="btn btn-default" data-dismiss="modal" value="Done">
                    </div>
                </div>
                </div>
            </div>';
        break;
        case 'Sleep_HSAT':
            echo '<div id="HSAT" >
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">					
                                Log de Desinfecci??n del HSAT
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">??</button>
                            </div>
                            <div class="modal-body">
                            <form id="frmHAST" action="rpt.php" target="_self" method="post"><input type="hidden" value="Sleep_HSAT" name="tb"><input type="hidden" value="1" name="update">
                                <table>
                                    <tr>
                                        <td style="text-align: left;border: none ;width:20%;"><label for="hsatFecha">Fecha de desinfecci??n</label></td>
                                        <td style="text-align: left;border: none ;width:80%;"><input type="date" name="hsatFecha" value="'.(!$row[1] == '' ? $row[1]->format('Y-m-d'):'').'"></br></td>
                                    </tr>
                                    <tr>
                                        <td style="text-align: left;border: none ;width:20%;"><label for="hsatTecnico" class="lrequired">Nombre del T??cnico</label></td>
                                        <td style="text-align: left;border: none ;width:80%;"><input type="text" name="hsatTecnico" value="'.$row[3].'"  required></br></td>
                                    </tr>
                                    <tr>
                                        <td style="text-align: left;border: none ;width:20%;"><label for="hsatModelo" class="lrequired">Modelo</label></td>
                                        <td style="text-align: left;border: none ;width:80%;">
                                        <input type="radio" name="hsatModelo" id="radio1" value="BWMini: HST Compass (#serie: BWM2022-7101)" checked><label for="radio1">BWMini: HST Compass (#serie: BWM2022-7101)</label></br>
                                    </tr>
                                    <tr>
                                        <td style="text-align: center;border:none;width:20%;" colspan="3">
                                            <input type="hidden" name="id" value="'.$row[0].'">
                                            <input type="submit" id="btnSubmit14" value="Guardar">
                                            <input type="button" id="btnCancel14" value="Cancelar">
                                        </td><td style="text-align: left;border:none;"></td>
                                    </tr>
                                    </table>
                                </form>
                            </div>
                            <div class="modal-footer">
                                <input type="button" class="btn btn-default" data-dismiss="modal" value="Done">
                            </div>
                        </div>
                    </div>
                </div>';
        break;
        case 'Sleep_TCPCO':
            echo '<div id="tcPCO2" >
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">					
                                Log de Desinfecci??n de tcPCO2
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">??</button>
                            </div>
                        <div class="modal-body">
                            <form id="frmETCO2" action="rpt.php" target="_self" method="post">
                            <input type="hidden" value="Sleep_TCPCO" name="tb"><input type="hidden" value="1" name="update">
                                <table>
                                    <tr>
                                        <td style="text-align: left;border: none ;width:20%;"><label for="tcpcFecha">Fecha de desinfecci??n</label></td>
                                        <td style="text-align: left;border: none ;width:80%;"><input type="date" name="tcpcFecha" value="'.(!$row[1] == '' ? $row[1]->format('Y-m-d'):'').'"></br></td>
                                    </tr>
                                    <tr>
                                        <td style="text-align: left;border: none ;width:20%;"><label for="tcpcTecnico" class="lrequired">Nombre del T??cnico</label></td>
                                        <td style="text-align: left;border: none ;width:80%;"><input type="text" name="tcpcTecnico" value="'.$row[3].'" required></br></td>
                                    </tr>
                                    <tr>
                                        <td style="text-align: left;border: none ;width:20%;"><label for="tcpcModelo" class="lrequired">Modelo</label></td>
                                        <td style="text-align: left;border: none ;width:80%;">
                                        <input type="radio" name="tcpcModelo" id="radio1" value="(Sentec Digital Monitoring System ??? SDMS)#serie 320125" '.($row[2] =='(Sentec Digital Monitoring System ??? SDMS)#serie 320125' ? 'checked' : '').'>
                                        <label for="radio1">(Sentec Digital Monitoring System ??? SDMS)#serie 320125</label></br>
                                    </tr>
                                    <tr>
                                        <td style="text-align: center;border:none;width:20%;" colspan="3">
                                            <input type="hidden" name="id" value="'.$row[0].'">
                                            <input type="submit" id="btnSubmit13" value="Guardar">
                                            <input type="button" id="btnCancel13" value="Cancelar">
                                        </td><td style="text-align: left;border:none;"></td>
                                    </tr>
                                </table>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <input type="button" class="btn btn-default" data-dismiss="modal" value="Done">
                        </div>
                    </div>
                </div>
            </div>';
        break;
        case 'Sleep_Studies_Results':
                echo '<div id="SleepStudies" >
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">			
                            Sleep Studies Results
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">??</button>
                        </div>
                        <div class="modal-body">
                        <form id="frmStudies" action="rpt.php" target="_self" method="post"><input type="hidden" value="Sleep_Studies_Results" name="tb"><input type="hidden" value="1" name="update">
                            <table>
                                <tr>
                                    <td style="text-align: left;border: none ;width:20%;"><label for="expedienteResults" class="lrequired">Numero de expediente </label></td>
                                    <td style="text-align: left;border: none ;width:80%;"><input type="text" id="expedienteResults" name="expedienteResults" value="'.$row[1].'" required></br></td>
                                </tr>
                                <tr>
                                    <td style="text-align: left;border: none ;width:20%;"><label for="nombreResultados">Nombre</label></td>
                                    <td style="text-align: left;border: none ;width:70%;"><input type="text" id="nombreResultados" name="nombreResultados" value="'.$row[2].'"></br></td>
                                </tr>
                                <tr>
                                    <td style="text-align: left;border: none ;width:20%;"><label for="txtApellidos">Apellidos </label></td>
                                    <td style="text-align: left;border: none ;width:70%;"><input type="text" id="txtApellidos" name="txtApellidos" value="'.$row[3].'"></br></td>
                                </tr>
                                <tr>
                                    <td style="text-align: left;border: none ;width:20%;"><label for="txtfechaEstudio" class="lrequired">Fecha de Estudio </label></td>
                                    <td style="text-align: left;border: none ;width:70%;"><input type="date" id="txtfechaEstudio" name="txtfechaEstudio" value="'.$row[4]->format('Y-m-d\TH:i').'" required></br></td>
                                </tr>
                                <tr>
                                    <td style="text-align: left;border: none ;width:20%;"><label for="fechaEntrega">Fecha de entrega por MD </label></td>
                                    <td style="text-align: left;border: none ;width:70%;"><input type="date" id="fechaEntrega" name="fechaEntrega" value="'.$row[5]->format('Y-m-d\TH:i').'"></br></td>
                                </tr>
                                <tr>
                                    <td style="text-align: left;border: none ;width:20%;"><label for="txtMedico">Medico </label></td>
                                    <td style="text-align: left;border: none ;width:70%;"><input type="text" id="txtMedico" name="txtMedico" placeholder="Medico" value="'.$row[6].'"></br></td>
                                </tr>
                                <tr>
                                    <td style="text-align: left;border: none ;width:20%;"><label for="txtVisitID">Visit ID </label></td>
                                    <td style="text-align: left;border: none ;width:70%;"><input type="number" id="txtVisitID" name="txtVisitID" value="'.$row[7].'"></br></td>
                                </tr>
                                <tr>
                                    <td style="text-align: left;border: none ;width:20%;"><label for="txtDED">DED </label></td>
                                    <td style="text-align: left;border: none ;width:70%;"><input type="text" id="txtDED" name="txtDED" value="'.$row[8].'"></br></td>
                                </tr>
                                <tr>
                                    <td style="text-align: left;border: none ;width:20%;"><label for="txtPlan">Plan Medico </label></td>
                                        <td style="text-align: left;border: none ;width:70%;"><input type="text" id="txtPlan" name="txtPlan" value="'.$row[9].'"></br></td>
                                </tr>
                                <tr>
                                    <td style="text-align: left;border: none ;width:20%;"><label for="txtOtroPlan">Otro Plan Medico </label></td>
                                    <td style="text-align: left;border: none ;width:70%;"><input type="text" id="txtOtroPlan" name="txtOtroPlan" value="'.$row[10].'"></br></td>
                                </tr>
                                <tr><td style="text-align: left;border: none ;width:20%;" colspan="2"></td>
                                <td style="text-align: left;border: none ;width:70%;" colspan="2"></td></tr>
                                <tr>
                                    <td style="text-align: center;border:none;width:20%;" colspan="5">
                                        <input type="hidden" name="id" value="'.$row[0].'">
                                        <button id="btn" class="dentro salvar">Someter</button>
                                        <button class="dentro" type="reset">Cancel / Reset</button>
                                    </td>
                                    <td style="text-align: left;border:none;"></td>
                                </tr>
                                </div>
                                </form>
                            </table>
                        <div class="modal-footer">
                            <input type="button" class="btn btn-default" data-dismiss="modal" value="Done">
                        </div>
                    </div>
                </div>
                </div>';
        break;
        case 'Sleep_Inspeccion_Rutina':
            echo '<div id="InspeccionVisual" class="noprint content">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">					
                        Inspecci??n Visual de Rutina
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">??</button>
                    </div>
                    <div class="modal-body">
                    <form id="frmInspeccionVisual" action="rpt.php" target="_self" method="post">
                        <table>
                            <input type="hidden" value="Sleep_Inspeccion_Rutina" name="tb">
                            <input type="hidden" value="1" name="update">
                            <tr>
                                <td style="text-align: left;border: none ;width:20%;"><label for="fechaInspeccion">Fecha de Inspeccion</label></td>
                                <td style="text-align: left;border: none ;width:20%;"><input type="datetime-local" id="fechaInspeccion" name="fechaInspeccion" value="'. (!$row[1] == '' ? $row[1]->format('Y-m-d\TH:s'):'').'"></br></td>
                                <td style="text-align: left;border: none ;width:10%;"></br></td>
                                <td style="text-align: left;border: none ;width:50%;"></br></td>
                            </tr>
                            <tr>
                                <td style="text-align: left;border: none ;width:20%;"><label for="ddHabitacion" class="lrequired">N??mero de Habitaci??n</label></td>
                                <td style="text-align: left;border: none ;width:20%;">
                                    <select id="ddHabitacion" name="ddHabitacion" required>
                                        <option value="1"'. ($row[2] == 1 ? ' selected': '').'>1</option>
                                        <option value="2"'. ($row[2] == 2 ? ' selected': '').'>2</option>
                                        <option value="3"'. ($row[2] == 3 ? ' selected': '').'>3</option>
                                        <option value="4"'. ($row[2] == 4 ? ' selected': '').'>4</option>
                                        <option value="5"'. ($row[2] == 5 ? ' selected': '').'>5</option>
                                        <option value="6"'. ($row[2] == 6 ? ' selected': '').'>6</option>
                                        <option value="7"'. ($row[2] == 7 ? ' selected': '').'>7</option>
                                        <option value="8"'. ($row[2] == 8 ? ' selected': '').'>8</option>
                                        <option value="9"'. ($row[2] == 9 ? ' selected': '').'>9</option>
                                        <option value="10"'.($row[2] == 10 ? ' selected': '').'>10</option>
                                        <option value="11"'.($row[2] == 11 ? ' selected': '').'>11</option>
                                        <option value="12"'.($row[2] == 12 ? ' selected': '').'>12</option>
                                    </select></td>
                                <td style="text-align: left;border: none ;width:10%;"><label for="ddCama1">Cama</label></td>
                                <td style="text-align: left;border: none ;width:50%;">
                                    <select id="ddCama1" name="ddCama1">
                                        <option value="Intacta" '. ($row[7] == 'Intacta' ? ' selected': '').'>Intacta</option>
                                        <option value="Alterada"'. ($row[7] == 'Alterada' ? ' selected': '').'>Alterada</option>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td style="text-align: left;border: none ;width:20%;"><label for="ddAmplificador">Amplificador</label></td>
                                <td style="text-align: left;border: none ;width:20%;">
                                    <select id="ddAmplificador" name="ddAmplificador">
                                        <option value="Intacto" '. ($row[3] == 'Intacto' ? ' selected': '').'>Intacto</option>
                                        <option value="Alterado"'. ($row[3] == 'Alterado' ? ' selected': '').'>Alterado</option>
                                    </select>
                                </td>
                                <td style="text-align: left;border: none ;width:10%;"><label for="ddBandas">Bandas</label></td>
                                <td style="text-align: left;border: none ;width:50%;">
                                    <select id="ddBandas" name="ddBandas">
                                        <option  value="Intacta" '. ($row[8] == 'Intacta' ? ' selected': '').'>Intacta</option>
                                        <option value="Alterada"'. ($row[8] == 'Alterada' ? ' selected': '').'>Alterada</option>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td style="text-align: left;border: none ;width:20%;"><label for="ddHeadbox">Headbox</label></td>
                                <td style="text-align: left;border: none ;width:20%;">
                                    <select id="ddHeadbox" name="ddHeadbox">
                                        <option value="Intacto" '. ($row[4] == 'Intacto' ? ' selected': '').'>Intacto</option>
                                        <option value="Alterado"'. ($row[4] == 'Alterado' ? ' selected': '').'>Alterado</option>
                                    </select>
                                </td>
                                <td style="text-align: left;border: none ;width:10%;"><label for="ddSensores">Sensores</label></td>
                                <td style="text-align: left;border: none ;width:50%;">
                                    <select id="ddSensores" name="ddSensores">
                                        <option value="Intactos" '. ($row[9] == 'Intactos' ? ' selected': '').'>Intactos</option>
                                        <option value="Alterados"'. ($row[9] == 'Alterados' ? ' selected': '').'>Alterados</option>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td style="text-align: left;border: none ;width:20%;"><label for="ddOximetro">Ox??metro</label></td>
                                <td style="text-align: left;border: none ;width:20%;">
                                    <select id="ddOximetro" name="ddOximetro">
                                        <option value="Intacto" '. ($row[5] == 'Intacto' ? ' selected': '').'>Intacto</option>
                                        <option value="Alterado"'. ($row[5] == 'Alterado' ? ' selected': '').'>Alterados</option>
                                    </select>
                                </td>
                                <td style="text-align: left;border: none ;width:10%;"><label for="ddElectrodos">Electrodos</label></td>
                                <td style="text-align: left;border: none ;width:50%;">
                                    <select id="ddElectrodos" name="ddElectrodos">
                                        <option value="Intactos" '. ($row[10] == 'Intactos' ? ' selected': '').'>Intactos</option>
                                        <option value="Alterados"'. ($row[10] == 'Alterados' ? ' selected': '').'>Alterados</option>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td style="text-align: left;border: none ;width:20%;"><label for="ddOxigeno">Metro de Ox??geno</label></td>
                                <td style="text-align: left;border: none ;width:20%;">
                                <select id="ddOxigeno" name="ddOxigeno">
                                    <option value="Intacto" '. ($row[11] == 'Intacto' ? ' selected': '').'>Intacto</option>
                                    <option value="Alterado"'. ($row[11] == 'Alterado' ? ' selected': '').'>Alterados</option>
                                </select>
                                </td>
                                <td style="text-align: left;border: none ;width:10%;"><label for="ddIntrcome">Intercome</label></td>
                                <td style="text-align: left;border: none ;width:50%;">
                                <select id="ddIntrcome" name="ddIntrcome">
                                    <option  value="Intacta" '. ($row[12] == 'Intactos' ? ' selected': '').'>Intacta</option>
                                    <option value="Alterada"'. ($row[12] == 'Alterada' ? ' selected': '').'>Alterada</option>
                                </select>
                            </td>
                            </tr>
                            <tr>
                                <td style="text-align: left;border: none ;width:20%;"><label for="ddCPAP">CPAP</label></td>
                                <td style="text-align: left;border: none ;width:20%;">
                                    <select id="ddCPAP" name="ddCPAP">
                                        <option value="Intacto"'. ($row[6] == 'Intacto' ? ' selected': '').'>Intacto</option>
                                        <option value="Alterado"'. ($row[6] == 'Alterado' ? ' selected': '').'>Alterado</option>
                                    </select>
                                </td>
                                <td style="text-align: left;border: none ;width:10%;"><label for="ddPC">PC</label></td>
                                <td style="text-align: left;border: none ;width:50%;">
                                    <select id="ddPC" name="ddPC">
                                        <option  value="Intacta" '. ($row[13] == 'Intacto' ? ' selected': '').'>Intacta</option>
                                        <option value="Alterada"'. ($row[13] == 'Alterada' ? ' selected': '').'>Alterada</option>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td style="text-align: left;border: none ;width:20%;"><label for="ddTrans">Transcutaneo</label></td>
                                <td style="text-align: left;border: none ;width:20%;">
                                    <select id="ddTrans" name="ddTrans">
                                        <option value="N/A" '. ($row[18] == 'N/A' ? ' selected': '').'>N/A</option>
                                        <option value="Intacto"'. ($row[18] == 'Intacto' ? ' selected': '').'>Intacto</option>
                                        <option value="Alterado"'. ($row[18] == 'Alterado' ? ' selected': '').'>Alterado</option>
                                    </select>
                                </td>
                                <td style="text-align: left;border: none ;width:10%;"><label for="ddETCO">ETCO2</label></td>
                                <td style="text-align: left;border: none ;width:50%;">
                                <select id="ddETCO" name="ddETCO">
                                    <option value="N/A" '. ($row[16] == 'N/A' ? ' selected': '').'>N/A</option>
                                    <option value="Intacto"'. ($row[16] == 'Intacto' ? ' selected': '').'>Intacto</option>
                                    <option value="Alterado"'. ($row[16] == 'Alterado' ? ' selected': '').'>Alterado</option>
                                </select>
                                </td>
                            </tr>
                            <tr>
                                <td style="text-align: left;border: none ;width:20%;"><label for="ddTrans">CO2</label></td>
                                <td style="text-align: left;border: none ;width:20%;">
                                    <select id="ddCO2" name="ddCO2">
                                        <option value="N/A" '. ($row[17] == 'N/A' ? ' selected': '').'>N/A</option>
                                        <option value="Intacto"'. ($row[17] == 'Intacto' ? ' selected': '').'>Intacto</option>
                                        <option value="Alterado"'. ($row[17] == 'Alterado' ? ' selected': '').'>Alterado</option>
                                    </select>
                                </td>
                                <td style="text-align: left;border: none ;width:10%;"></td>
                            </tr>
                            <tr>
                                <td style="text-align: left;border: none ;width:20%;"><label for="accionTomada">Acci??n Tomada</label></td>
                                <td style="text-align: left;border: none ;width:20%;" colspan="3">
                                <textarea name="accionTomada" id="accionTomada" rows="4" cols="50">'.$row[14].'</textarea>
                                
                            </tr>
                            <tr>
                                <td style="text-align: left;border: none ;width:20%;"><label for="techRutina">Iniciales del T??cnico</label></td>
                                <td style="text-align: left;border: none ;width:20%;" colspan="3"><input type="text" id="techRutina" name="techRutina" value="'.$row[15].'"></td>
                            </tr>
                            <tr>
                                <td style="text-align: center;border:none;width:20%;" colspan="3">
                                    <input type="hidden" name="id" value="'.$row[0].'">
                                    <input type="submit" id="btnSubmit3" value="Someter">
                                    <input type="button" id="btnCancel3" value="Cancel">
                                </td><td style="text-align: left;border:none;"></td>
                            </tr>
                            </table>
                            </form>
                </div>
                <div class="modal-footer">
                    <input type="button" class="btn btn-default" data-dismiss="modal" value="Done">
                </div>
                </div>
            </div></div>';
        break;
        case 'Sleep_Registro_Paciente':
            echo '<div id="MaskFitting" >
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">					
                        Registro de Paciente-Class/Mask Fitting
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">??</button>
                    </div>
                    <div class="modal-body">
                    <form id="frmMaskFitting" action="rpt.php" target="_self" method="post">
                        <table>
                            <input type="hidden" value="Sleep_Registro_Paciente" name="tb"><input type="hidden" value="1" name="update">
                            <tr>
                                <td style="text-align: left;border: none ;width:20%;"><label for="nombreMask" class="lrequired">Nombre </label></td>
                                <td style="text-align: left;border: none ;width:80%;"><input type="text" id="nombreMask" name="nombreMask" value="'.$row[1].'" required></br></td>
                            </tr>
                            <tr>
                                <td style="text-align: left;border: none ;width:20%;"><label for="apellidosMask" class="lrequired">Apellidos</label></td>
                                <td style="text-align: left;border: none ;width:80%;"><input type="text" id="apellidosMask" name="apellidosMask" value="'.$row[2].'" required></br></td>
                            </tr>
                            <tr>
                                <td style="text-align: left;border: none ;width:20%;"><label for="fechaMask" class="lrequired">Fecha</label></td>
                                <td style="text-align: left;border: none ;width:80%;"><input type="date" id="fechaMask" name="fechaMask" value="'.(!$row[3] == '' ? $row[3]->format('Y-m-d'):'').'" required></br></td>
                            </tr>
                            <tr>
                                <td style="text-align: left;border: none ;width:20%;"><label for="ddPlanMedico">Plan Medico </label></td>
                                <td style="text-align: left;border: none ;width:80%;">
                                <select id="ddPlanMedico" name="ddPlanMedico">
                                    <option value="SSS"'.($row[4] ==='SSS' ? ' checked' : '').'>SSS</option>
                                    <option value="Salud Plus"'.($row[4] ==='Salud Plus' ? ' checked' : '').'>Salud Plus</option>
                                </select></td>    
                            </tr>
                            <tr>
                                <td style="text-align: left;border: none ;width:20%;"><label for="ddProcedimiento1">Procedimiento</label></td>
                                <td style="text-align: left;border: none ;width:80%;">
                                <select id="ddProcedimiento1" name="ddProcedimiento1">
                                    <option value="Mask Fitting">Mask Fitting</option>
                                    <option value="Orientaci??n">Orientaci??n</option>
                                    <option value="Recomendaci??n de PAP NAP">Recomendaci??n de PAP NAP</option>
                                    <option value="CPAP programming/Calibration">CPAP programming/Calibration</option>
                                    <option value="Otros">Otros</option>
                                </select></br></td>
                            </tr>
                            <tr>
                                <td style="text-align: left;border: none ;width:20%;"><label for="ddProcedimiento2">Otro Procedimiento</label></td>
                                <td style="text-align: left;border: none ;width:80%;"><input type="text" id="ddProcedimiento2" name="ddProcedimiento2" value="'.$row[6].'"></br></td>
                            </tr>
                            <tr>
                                <td style="text-align: left;border: none ;width:20%;"><label for="mdRefiere" class="lrequired">M??dico que refiere</label></td>
                                <td style="text-align: left;border: none ;width:80%;"><input type="text" id="mdRefiere" name="mdRefiere" value="'.$row[7].'" required></br></td>
                            </tr>
                            <tr>
                                <td style="text-align: left;border: none ;width:20%;"><label for="tecnicoMask" class="lrequired">Iniciales del t??cnico</label></td>
                                <td style="text-align: left;border: none ;width:80%;"><input type="text" id="tecnicoMask" name="tecnicoMask" value="'.$row[8].'" ></br></td>
                            </tr>
                            <tr>
                                <td style="text-align: center;border:none;width:20%;" colspan="5">
                                    <input type="hidden" name="id" value="'.$id.'">
                                    <input type="submit" id="btnSubmit3" value="Someter">
                                    <input type="button" id="btnCancel3" value="Cancel">
                                </td>
                                <td style="text-align: left;border:none;"></td>
                            </tr>
                            </table>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <input type="button" class="btn btn-default" data-dismiss="modal" value="Done">
                    </div>
                </div>
            </div></div>';
        break;
        case 'Sleep_Valores_Criticos':
            echo '<div id="ValCriticos" >
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">					
                        Valores Cr??ticos
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">??</button>
                    </div>
                <div class="modal-body">
                <form id="frmValCriticos" action="rpt.php" target="_self" method="post"><input type="hidden" value="Sleep_Valores_Criticos" name="tb"><input type="hidden" value="1" name="update">
                    <table>
                        <tr>
                            <td style="text-align: left;border: none ;width:30%;"><label for="valExpediente">T??cnico</label></td>
                            <td style="text-align: left;border: none ;width:30%;"><input type="text" id="valExpediente" name="valExpediente" value="'.$row[1].'"></br></td>
                            <td style="text-align: left;border: none ;width:30%;"></td>
                            <td style="text-align: left;border: none ;width:30%;"></td>
                        </tr>
                        <tr>
                            <td style="text-align: left;border: none ;width:30%;"><label for="valFecha">Fecha del evento</label></td>
                            <td style="text-align: left;border: none ;width:30%;"><input type="datetime-local" name="valFecha" id="valFecha" value="'.(!$row[2] == '' ? $row[2]->format('Y-m-d\TH:i'):'').'"></br></td>
                            <td style="text-align: left;border: none ;width:30%;" colspan="2">
                            <label for="ddReferidoMD"></label></td>
                        </tr>
                        <tr>
                            <td style="text-align: left;border: none ;width:30%;"><label for="valPaciente">Visit ID del Paciente </label></td>
                            <td style="text-align: left;border: none ;width:30%;"><input type="number" id="valPaciente" name="valPaciente" value="'.$row[3].'"></br></td>
                            <td style="text-align: left;border: none ;width:30%;"></td>
                            <td style="text-align: left;border: none ;width:30%;"></td>
                        </tr>
                        <tr>
                            <td style="text-align: left;border: none ;width:30%;"><label for="valorCritico">Valor Cr??tico</label></td>
                            <td style="text-align: left;border: none ;width:30%;"><input type="text" id="valorCritico" name="valorCritico" value="'.$row[4].'"></br></td>
                            <td style="text-align: left;border: none ;width:30%;"></td>
                            <td style="text-align: left;border: none ;width:30%;"></td>
                        </tr>
                        <tr>
                            <td style="text-align: left;border: none ;width:30%;"><label for="repotadoa">A qui??n se reporta</label></td>
                            <td style="text-align: left;border: none ;width:30%;"><input type="text" id="repotadoa" name="repotadoa" value="'.$row[5].'"></br></td>
                            <td style="text-align: left;border: none ;width:30%;"></td>
                            <td style="text-align: left;border: none ;width:30%;"></td>
                        </tr>
                        <tr>
                            <td style="text-align: left;border: none ;width:30%;"><label for="valAccion">Acci??n que se tom??</label></td>
                            <td style="text-align: left;border: none ;width:30%;"><input type="text" id="valAccion" name="valAccion" value="'.$row[6].'"></br></td>
                            <td style="text-align: left;border: none ;width:30%;"></td>
                            <td style="text-align: left;border: none ;width:30%;"></td>
                        </tr>
                        <tr>
                            <td style="text-align: left;border: none ;width:30%;"><label for="mdAccion">Acci??n tomada por el m??dico (si aplicada)</label></td>
                            <td style="text-align: left;border: none ;width:30%;"><input type="text" id="mdAccion" name="mdAccion" value="'.$row[7].'"></br></td>
                            <td style="text-align: left;border: none ;width:30%;"></td>
                            <td style="text-align: left;border: none ;width:30%;"></td>
                        </tr>
                        <tr>
                            <td style="text-align: left;border: none ;width:30%;"><label for="valReportado">Fecha reportado</label></td>
                            <td style="text-align: left;border: none ;width:30%;"><input type="datetime-local" id="valReportado" name="valReportado" value="'.(!$row[8] == '' ? $row[8]->format('Y-m-d\TH:i'):'').'"></br></td>
                            <td style="text-align: left;border: none ;width:30%;" colspan="2">
                            <label for="ddReferidoMD"></label></td>
                        </tr>
                        <tr>
                            <td style="text-align: center;border:none;width:30%;" colspan="3">
                                <input type="hidden" name="id" value="'.$id.'">
                                <input type="submit" id="btnSubmit3" value="Someter">
                                <input type="button" id="btnCancel3" value="Cancel">
                            </td><td style="text-align: left;border:none;"></td>
                        </tr>
                        </table>
                    </form>
                </div>
                <div class="modal-footer">
                    <input type="button" class="btn btn-default" data-dismiss="modal" value="Done">
                </div>
            </div>
            </div>
            </div>';
        break;
        case 'Sleep_CPAP_Prestados':
            echo '<div id="LogCPAP" >
            <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">					
                    Log de Auto CPAP Prestados
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">??</button>
                </div>
            <div class="modal-body">
            <form id="frmLogCPAP" action="rpt.php" target="_self" method="post"><input type="hidden" value="Sleep_CPAP_Prestados" name="tb">
                <input type="hidden" value="1" name="update">
                <table>
                    <tr>
                        <td style="text-align: left;border: none ;width:30%;"><label for="cpacpName">Nombre del paciente</label></td>
                        <td style="text-align: left;border: none ;width:30%;"><input type="text" id="cpacpName" name="cpacpName" value="'.$row[1].'"></br></td>
                    </tr>
                    <tr>
                        <td style="text-align: left;border: none ;width:30%;"><label for="pTelefono">Telefono</label></td>
                        <td style="text-align: left;border: none ;width:30%;"><input type="text" id="pTelefono" name="pTelefono" value="'.$row[2].'"required></br></td>
                    </tr>
                    <tr>
                        <td style="text-align: left;border: none ;width:30%;"><label for="fechaPrestado">Fecha y hora de prestado</label></td>
                        <td style="text-align: left;border: none ;width:30%;"><input type="datetime-local" name="fechaPrestado" id="fechaPrestado" value="'.(!$row[4] == '' ? $row[3]->format('Y-m-d\TH:i'):'').'"></br></td>
                    </tr>
                    <tr>
                        <td style="text-align: left;border: none ;width:30%;"><label for="tecEntrega">Techico que entrega</label></td>
                        <td style="text-align: left;border: none ;width:30%;"><input type="text" id="tecEntrega" name="tecEntrega" value="'.$row[5].'" required></br></td>
                    </tr>
                    <tr>
                        <td style="text-align: left;border: none ;width:30%;"><label for="pago50">Pago $50.00</label></td>
                        <td style="text-align: left;border: none ;width:30%;"><input type="text" id="pago50" name="pago50" value="'.$row[6].'"></br></td>
                    </tr>
                    <tr>
                        <td style="text-align: left;border: none ;width:30%;"><label for="fecha_Entrega">Fecha y hora de entrega en que el equipo debe ser entregado al laboratorio del sue??o</label></td>
                        <td style="text-align: left;border: none ;width:30%;"><input type="datetime-local" name="fecha_Entrega" id="fecha_Entrega" value="'.(!$row[4] == '' ? $row[4]->format('Y-m-d\TH:i'):'').'"></br></td>
                    </tr>
                    <tr>
                        <td style="text-align: left;border: none ;width:30%;"><label for="techRecibe">Tecnico que recibe</label></td>
                        <td style="text-align: left;border: none ;width:30%;"><input type="text" name="techRecibe" id="techRecibe" value="'.$row[7].'"></br></td>
                    </tr>
                    <tr>
                        <td style="text-align: left;border: none ;width:30%;"><label for="fRecibe">Fecha y hora que recibe</label></td>
                        <td style="text-align: left;border: none ;width:30%;"><input type="datetime-local" name="fRecibe" id="fRecibe" value="'.(!$row[8] == '' ? $row[8]->format('Y-m-d\TH:i'):'').'"></br></td>
                    </tr>
                    <tr>
                        <td style="text-align: left;border: none ;width:30%;"><label for="desinfecto">Desinfect?? equipo</label></td>
                        <td style="text-align: left;border: none ;width:30%;"><input type="text" id="desinfecto" name="desinfecto" value="'.$row[9].'"></br></td>
                    </tr>            
                    <tr>
                        <td style="text-align: left;border: none ;width:30%;"><label for="cpapFecha">Fecha y hora de desinfectado</label></td>
                        <td style="text-align: left;border: none ;width:30%;"><input type="datetime-local" id="cpapFecha" name="cpapFecha" value="'.(!$row[10] == '' ? $row[10]->format('Y-m-d\TH:i'):'').'"></br></td>
                    </tr>
                    <tr>
                        <td style="text-align: left;border: none ;width:30%;"><label for="ePrestado">Equipo prestado</label></td>
                        <td style="text-align: left;border: none ;width:30%;">
                        <select id="ePrestado" name="ePrestado">
                            <option value="I REMSTAR AUTO 560P (P125149222BDE)" '.($row[11] ==='I REMSTAR AUTO 560P (P125149222BDE)' ? 'selected' : '').'>I REMSTAR AUTO 560P (P125149222BDE)</option>
                            <option value="II REMSTAR AUTO 560P (P12514958C98C)" '.($row[11] ==='II REMSTAR AUTO 560P (P12514958C98C)' ? 'selected' : '').'>II REMSTAR AUTO 560P (P12514958C98C)</option>
                        </select></td>     
                    </tr>           
                    <tr>
                        <td style="text-align: center;border:none;width:30%;" colspan="3">
                            <input type="submit" id="btnSubmit3" value="Someter"><input type="hidden" name="id" value="'.$id.'">
                            <input type="button" id="btnCancel3" value="Cancel">
                        </td><td style="text-align: left;border:none;"></td>
                    </tr>
                    </table>
                </form>
            </div>
            <div class="modal-footer">
                <input type="button" class="btn btn-default" data-dismiss="modal" value="Done">
            </div>
            </div>
            </div>
            </div>';
        break;
        case 'Sleep_Comunicacion':
            echo '<div id="logComunicacion" >
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">					
                        Log de Comunicaci??n
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">??</button>
                    </div>
                <div class="modal-body">
                <form id="frmlogComunicacion" action="rpt.php" target="_self" method="post"><input type="hidden" value="Sleep_Comunicacion" name="tb"><input type="hidden" value="1" name="update">
                <table>
                    <tr>
                        <td style="text-align: left;border: none ;width:20%;"><label for="tecComunicacion">Nombre del techico</label></td>
                        <td style="text-align: left;border: none ;width:30%;"><input type="text" id="tecComunicacion" name="tecComunicacion" value="'.$row[1].'" required></br></td>
                        <td style="text-align: left;border: none ;width:40%;"></td>
                    </tr>
                    <tr>
                        <td style="text-align: left;border: none ;width:20%;"><label for="comFecha">Fecha y Hora:</label></td>
                        <td style="text-align: left;border: none ;width:30%;"><input type="datetime-local" id="comFecha" name="comFecha" value="'.(!$row[3] == '' ? $row[3]->format('Y-m-d\TH:i'):'').'"></br></td>
                        <td style="text-align: left;border: none ;width:40%;" colspan="2">
                    </tr>
                    <tr>
                        <td style="text-align: left;border: none ;width:20%;"><label for="txtLlama">A qui??n se llama</label></td>
                        <td style="text-align: left;border: none ;width:30%;"><input type="text" id="txtLlama" name="txtLlama" value="'.$row[2].'" ></br>
                        <td style="text-align: left;border: none ;width:40%;"></td>
                    </tr>
                    <tr>
                        <td style="text-align: left;border: none ;width:20%;"><label for="comSituacion">Situaci??n Presentada</label></td>
                        <td style="text-align: left;border: none ;width:30%;"><textarea id="comSituacion" name="comSituacion">'.$row[4].'</textarea></br></td>
                        <td style="text-align: left;border: none ;width:40%;"></td>
                    </tr>
                    <tr>
                        <td style="text-align: center;border:none;width:20%;" colspan="3">
                            <input type="hidden" name="id" value="'.$row[0].'">
                            <input type="submit" id="btnSubmit3" value="Guardar">
                            <input type="button" id="btnCancel3" value="Cancelar">
                        </td><td style="text-align: left;border:none;"></td>
                    </tr>
                </table>
                </form>
            </div>
            <div class="modal-footer">
                <input type="button" class="btn btn-default" data-dismiss="modal" value="Done">
            </div>
            </div>
            </div>
            </div>';
        break;
        case 'Sleep_Rechazo':
            echo '<div id="logRechazo" >
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">					
                        Rechazo de Tratamiento
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">??</button>
                    </div>
                <div class="modal-body">
                <form id="frmlogRechazo" action="rpt.php" target="_self" method="post"><input type="hidden" value="Sleep_Rechazo" name="tb"><input type="hidden" value="1" name="update">
                    <table>
                        <tr>
                            <td style="text-align: left;border: none ;width:20%;"><label for="visitRechazo" class="lrequired">Visit ID *</label></td>
                            <td style="text-align: left;border: none ;width:80%;"><input type="number" id="visitRechazo" name="visitRechazo" value="'.$row[1].'" required></br></td>
                        </tr>
                        <tr>
                            <td style="text-align: left;border: none ;width:20%;"><label for="paciente">Nombre del paciente</label></td>
                            <td style="text-align: left;border: none ;width:80%;"><input type="text" id="paciente" name="paciente" value="'.$row[2].'"></br></td>
                        </tr>
                        <tr>
                            <td style="text-align: left;border: none ;width:20%;"><label for="fechaRechazo">Fecha del estudio</label></td>
                            <td style="text-align: left;border: none ;width:80%;"><input type="datetime-local" id="fechaRechazo" name="fechaRechazo" value="'.(!$row[3] == '' ? $row[3]->format('Y-m-d\TH:i'):'').'"></br></td>
                        </tr>
                        <tr>
                            <td style="text-align: left;border: none ;width:20%;"><label for="radPasos">Se tomaron pasos de adaptaci??n?</label></td>
                            <td style="text-align: left;border: none ;width:80%;">
                                <input type="radio" id="radPasos1" name="radPasos" value="Si" '.(trim($row[5]) ==='Si' ? 'checked' : '').'><label for="radio1">Si</label></br>
                                <input type="radio" id="radPasos2" name="radPasos" value="No" '.(trim($row[5]) ==='No' ? 'checked' : '').'><label for="radio2">No</option>
                            </td>
                        </tr>
                        <tr>
                            <td style="text-align: left;border: none ;width:20%;"><label>Firm?? documento de rechazo?</label></td>
                            <td style="text-align: left;border: none ;width:80%;">
                                <input type="radio" id="radFirma1" name="radFirma" value="Si" '.(trim($row[6]) ==='Si' ? 'checked' : '').'><label for="radFirma1">Si</label></br>
                                <input type="radio" id="radFirma2" name="radFirma" value="No" '.(trim($row[6]) ==='No' ? 'checked' : '').'><label for="radFirma2">No</option>
                            </td>
                        </tr>
                        <tr>
                            <td style="text-align: left;border: none ;width:20%;"><label for="razonRechazo" class="lrequired">Raz??n por la que rechazo tratamiento*</label></td>
                            <td style="text-align: left;border: none ;width:80%;"><textarea id="razonRechazo" name="razonRechazo" cols="50" rows="4" required>'.$row[4].'</textarea></br></td>
                        </tr>
                        <tr>
                            <td style="text-align: left;border: none ;width:20%;"><label for="techRechazo">Nombre del t??cnico</label></td>
                            <td style="text-align: left;border: none ;width:80%;"><input type="text" id="techRechazo" name="techRechazo" value="'.$row[7].'"></br></td>
                        </tr>
                        <tr>
                            <td style="text-align: center;border:none;width:80%;" colspan="3">
                                <input type="hidden" name="id" value="'.$row[0].'">
                                <input type="submit" id="btnSubmit3" value="Guardar">
                                <input type="button" id="btnCancel3" value="Cancelar">
                            </td><td style="text-align: left;border:none;"></td>
                        </tr>
                        </table>
                    </form>
                </div>
                <div class="modal-footer">
                    <input type="button" class="btn btn-default" data-dismiss="modal" value="Done">
                </div>
            </div>
            </div>';
        break;
        case 'Sleep_Endozime':
            echo '<div id="UsoManejo" >
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">					
                        Uso y Manejo de Endozime AW Plus
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">??</button>
                    </div>
                    <div class="modal-body">
                    <form id="frmUsoManejo" action="rpt.php" target="_self" method="post"><input type="hidden" value="Sleep_Endozime" name="tb"><input type="hidden" value="1" name="update">
                        <table>
                            <tr>
                                <td style="text-align: left;border: none ;width:20%;"><label for="fechaPreparacion" class="lrequired">Fecha y Hora de Preparaci??n</label></td>
                                <td style="text-align: left;border: none ;width:80%;"><input type="datetime-local" id="fechaPreparacion" name="fechaPreparacion" value="'.(!$row[1]=='' ? $row[1]->format('Y-m-d\TH:i'):'').'"></br></td>
                            </tr>
                            <tr>
                                <td style="text-align: left;border: none ;width:20%;"><label for="expiracionEndozime">Fecha de Expiraci??n</label></td>
                                <td style="text-align: left;border: none ;width:80%;"><input type="date" name="expiracionEndozime" value="'.(!$row[2] == '' ? $row[2]->format('Y-m-d'):'').'"></br></td>
                            </tr>
                            <tr>
                                <td style="text-align: left;border: none ;width:20%;"><label for="tempEndozime">Temperatura del cuarto de almacenaje 15 a 80 grados C</label></td>
                                <td style="text-align: left;border: none ;width:80%;"><input type="text" name="tempEndozime" value="'.$row[3].'" required></br></td>
                            </tr>
                            <tr>
                                <td style="text-align: left;border: none ;width:20%;"><label for="etcoTecnico" class="lrequired">Nombre del T??cnico</label></td>
                                <td style="text-align: left;border: none ;width:80%;"><input type="text" name="etcoTecnico" value="'.$row[4].'"required></br></td>
                            </tr>
                            <tr>
                                <td style="text-align: center;border:none;width:20%;" colspan="3">
                                    <input type="hidden" name="id" value="'.$id.'">
                                    <input type="submit" id="btnSubmit3" value="Guardar">
                                    <input type="button" id="btnCancel3" value="Cancelar">
                                </td>
                            </tr>
                            </table>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <input type="button" class="btn btn-default" data-dismiss="modal" value="Done">
                    </div>
                </div>
            </div>
            </div>';
        break;
        case 'Sleep_Ojos':
            echo '<div id="DuchasOjos" >
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">					
                            Duchas de lavado de ojos
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">??</button>
                        </div>
                        <div class="modal-body">
                        <form id="frmDuchasOjos" action="rpt.php" target="_self" method="post"><input type="hidden" value="Sleep_Ojos" name="tb">
                        <input type="hidden" value="1" name="update">
                            <table>
                                    <tr>
                                        <td style="text-align: left;border: none ;width:20%;"><label for="fechaDucha">Fecha de prueba de lavado de ojos</label></td>
                                        <td style="text-align: left;border: none ;width:80%;"><input type="date" name="fechaDucha" value="'.$row[1]->format('Y-m-d').'"></br></td>
                                    </tr>
                                    <tr>
                                        <td style="text-align: left;border: none ;width:20%;"><label for="tecDucha" class="lrequired">Nombre del T??cnico</label></td>
                                        <td style="text-align: left;border: none ;width:80%;"><input type="text" name="tecDucha" value="'.$row[2].'" required></br></td>
                                    </tr>
                                    <tr>
                                        <td style="text-align: center;border:none;width:20%;" colspan="3">
                                            <input type="submit" id="btnSubmit3" value="Guardar"><input type="hidden" name="id" value="'.$row[0].'">
                                            <input type="button" id="btnCancel3" value="Cancelar">
                                        </td><td style="text-align: left;border:none;"></td>
                                    </tr>
                                </table>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <input type="button" class="btn btn-default" data-dismiss="modal" value="Done">
                        </div>
                    </div>
                </div>
            </div>';
        break;
        case 'Sleep_ETCO':
            echo '<div id="ETCO2" >
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">					
                                Desinfeccion ETCO2
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">??</button>
                            </div>
                        <div class="modal-body">
                        <form id="frmETCO2" action="rpt.php" target="_self" method="post"><input type="hidden" value="Sleep_ETCO" name="tb"><input type="hidden" value="1" name="update">
                            <table>
                                <tr>
                                    <td style="text-align: left;border: none ;width:20%;"><label for="etcoDesinfeccion">Fecha de desinfecci??n</label></td>
                                    <td style="text-align: left;border: none ;width:80%;"><input type="date" name="etcoDesinfeccion"value="'.(!$row[1] == '' ? $row[1]->format('Y-m-d'):'').'"></br></td>
                                </tr>
                                <tr>
                                    <td style="text-align: left;border: none ;width:20%;"><label for="etcoTecnico" class="lrequired">Nombre del T??cnico</label></td>
                                    <td style="text-align: left;border: none ;width:80%;"><input type="text" name="etcoTecnico" value="'.$row[2].'" required></br></td>
                                </tr>
                                <tr>
                                    <td style="text-align: left;border: none ;width:20%;"><label for="etcoModelo" class="lrequired">Modelo</label></td>
                                    <td style="text-align: left;border: none ;width:80%;">
                                    <input type="radio" name="etcoModelo" id="radio1" value="I Resp Sense LS1R-9R-MMHG (#serie 590000107)" '.($row[3] ==='I Resp Sense LS1R-9R-MMHG (#serie 590000107)' ? 'checked' : '').'><label for="radio1">I Resp Sense LS1R-9R-MMHG (#serie 590000107)</label></br>
                                    <input type="radio" name="etcoModelo" id="radio2" value="II Resp Sense LS1R-9R (#serie 501967844)"'.($row[3] ==='II Resp Sense LS1R-9R (#serie 501967844)' ? 'checked' : '').'><label for="radio2">II Resp Sense LS1R-9R (#serie 501967844)</option> 
                                </tr>
                                <tr>
                                    <td style="text-align: center;border:none;width:20%;" colspan="3">
                                        <input type="submit" id="btnSubmit3" value="Guardar"><input type="hidden" name="id" value="'.$row[0].'">
                                        <input type="button" id="btnCancel3" value="Cancelar">
                                    </td>
                                    <td style="text-align: left;border:none;"></td>
                                </tr>
                                </table>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <input type="button" class="btn btn-default" data-dismiss="modal" value="Done">
                        </div>
                    </div>
                </div>
            </div>';
        break;
        case 'Sleep_Desinfeccion_CPAP':
            $ar = explode(',',$row[4]);
            echo '<div id="CPAP" >
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">					
                                Desinfeccion CPAP
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">??</button>
                            </div>
                        <div class="modal-body">
                        <form id="frmCPAP" action="rpt.php" target="_self" method="post"><input type="hidden" value="Sleep_Desinfeccion_CPAP" name="tb"><input type="hidden" value="1" name="update">
                            <table>
                                <tr>
                                    <td style="text-align: left;border: none ;width:20%;"><label for="fechaDesinfeccion" class="lrequired">Fecha de desinfecci??n</label></td>
                                    <td style="text-align: left;border: none ;width:80%;"><input type="date" name="fechaDesinfeccion" value="'.(!$row[1] == '' ? $row[1]->format('Y-m-d') : '').'" ></br></td>
                                </tr>
                                <tr>
                                    <td style="text-align: left;border: none ;width:20%;"><label for="DesinfeccionFiltro">Fecha de desinfecci??n de filtro</label></td>
                                    <td style="text-align: left;border: none ;width:80%;"><input type="date" name="DesinfeccionFiltro" value="'.(!$row[2] == '' ? $row[2]->format('Y-m-d'):'').'"></br></td>
                                </tr>
                                <tr>
                                    <td style="text-align: left;border: none ;width:20%;"><label for="CambioFiltro">Fecha de cambio de filtro</label></td>
                                    <td style="text-align: left;border: none ;width:80%;"><input type="date" name="CambioFiltro" value="'.(!$row[3] == '' ?$row[3]->format('Y-m-d'):'').'"></br></td>
                                </tr>
                                <tr>
                                    <td style="text-align: left;border: none ;width:20%;"><label for="ddCama" class="lrequired">Cama</label></td>
                                    <td style="text-align: left;border: none ;width:80%;">
                                    <input type="checkbox" name="ckCamas[]"  value="1" '.(in_array('1',$ar) ? 'checked' : '').'>1
                                    <input type="checkbox" name="ckCamas[]"  value="2" '.(in_array('2',$ar) ? 'checked' : '').'>2
                                    <input type="checkbox" name="ckCamas[]"  value="4" '.(in_array('3',$ar) ? 'checked' : '').'>3
                                    <input type="checkbox" name="ckCamas[]"  value="4" '.(in_array('4',$ar) ? 'checked' : '').'>4
                                    <input type="checkbox" name="ckCamas[]"  value="5" '.(in_array('5',$ar) ? 'checked' : '').'>5
                                    <input type="checkbox" name="ckCamas[]"  value="6" '.(in_array('6',$ar) ? 'checked' : '').'>6
                                    <input type="checkbox" name="ckCamas[]"  value="7" '.(in_array('7',$ar) ? 'checked' : '').'>7
                                    <input type="checkbox" name="ckCamas[]"  value="8" '.(in_array('8',$ar) ? 'checked' : '').'>8
                                    <input type="checkbox" name="ckCamas[]"  value="9" '.(in_array('9',$ar) ? 'checked' : '').'>9
                                    <input type="checkbox" name="ckCamas[]" value="10" '.(in_array('10',$ar) ? 'checked' : '').'>10
                                    <input type="checkbox" name="ckCamas[]" value="11" '.(in_array('11',$ar) ? 'checked' : '').'>11
                                    <input type="checkbox" name="ckCamas[]" value="12" '.(in_array('12',$ar) ? 'checked' : '').'>12
                                </tr>
                                <tr>
                                    <td style="text-align: left;border: none ;width:20%;"><label for="txtTecnico" class="lrequired">Nombre del T??cnico</label></td>
                                    <td style="text-align: left;border: none ;width:80%;"><input type="text" name="txtTecnico" value="'.$row[5].'" required></br></td>
                                </tr>
                                <tr>
                                    <td style="text-align: center;border:none;width:20%;" colspan="5">
                                        <input type="hidden" name="id" value="'.$row[0].'">
                                        <input type="submit" id="btnSubmit3" value="Guardar">
                                        <input type="button" id="btnCancel3" value="Cancelar">
                                    </td><td style="text-align: left;border:none;"></td>
                                </tr>
                                </table>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <input type="button" class="btn btn-default" data-dismiss="modal" value="Done">
                        </div>
                    </div>
                </div>
            </div>';
        break;
        case 'Sleep_Frasco_Cidex':
            echo '<div id="frascoCIdex" >
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">					
                        Registro de Verificaci??n de Frasco de Cidex OPA y Frasco de las Tirillas para las Pruebas Durante el Proceso de Desinfecci??n de Alto Nivel
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">??</button>
                    </div>
                    <div class="modal-body">
                    <form id="frmfrascoCIdex" action="rpt.php" target="_self" method="post"><input type="hidden" value="Sleep_Frasco_Cidex" name="tb"><input type="hidden" value="1" name="update">
                        <table>
                                <tr>
                                    <td style="text-align: left;border: none ;width:20%;"><label for="fechaDePrueba" class="lrequired">Fecha de la Prueba</label></td>
                                    <td style="text-align: left;border: none ;width:80%;"><input type="date" id="fechaDePrueba" name="fechaDePrueba" value="'.$row[1]->format('Y-m-d').'"></br></td>
                                </tr>
                                <tr>
                                    <td style="text-align: left;border: none ;width:20%;"><label for="txtTemperatura" class="lrequired">Temperatura del cuarto de almacenaje (15-80 Grados Celsius)</label></td>
                                    <td style="text-align: left;border: none ;width:80%;"><input type="text" id="txtTemperatura" name="txtTemperatura" value="'.$row[2].'">
                                </tr>
                                <tr>
                                    <td style="text-align: left;border: none ;width:20%;"><label for="loteFrasco">Num Lote del Frasco de la Soluci??n</label></td>
                                    <td style="text-align: left;border: none ;width:80%;"><input type="text" name="loteFrasco" id="loteFrasco" value="'.$row[3].'"></br></td>
                                </tr>
                                <tr>
                                    <td style="text-align: left;border: none ;width:20%;"><label for="frascoAbierto">Fecha Abierto Frasco de la soluci??n</label></td>
                                    <td style="text-align: left;border: none ;width:80%;"><input type="date" id="frascoAbierto" name="frascoAbierto" value="'.(!$row[4] = '' ? $row[4]->format('Y-m-d'):'').'"></br></td>
                                </tr>        
                                <tr>
                                    <td style="text-align: left;border: none ;width:20%;"><label for="expiraSolucion">Fecha de Expiraci??n de la soluci??n (75 d??as)</label></td>
                                    <td style="text-align: left;border: none ;width:80%;"><input type="date" id="expiraSolucion" name="expiraSolucion" value="'.(!$row[5] = '' ? $row[5]->format('Y-m-d'):'').'"></br></td>
                                </tr>            
                                <tr>
                                    <td style="text-align: left;border: none ;width:20%;"><label for="loteTirillas">N??m. Lote del Frasco de Tirillas</label></td>
                                    <td style="text-align: left;border: none ;width:80%;"><input type="text" id="loteTirillas" name="loteTirillas" value="'.$row[6].'"></br></td>
                                </tr>
                                <tr>
                                    <td style="text-align: left;border: none ;width:20%;"><label for="abiertoTirillas">Fecha Abierto Frasco de Tirillas</label></td>
                                    <td style="text-align: left;border: none ;width:80%;"><input type="date" id="abiertoTirillas" name="abiertoTirillas" value="'.(!$row[7] = '' ? $row[7]->format('Y-m-d'):'').'"></br></td>
                                </tr>            
                                <tr>
                                    <td style="text-align: left;border: none ;width:20%;"><label for="expiraTirilla">Fecha de Expiraci??n (Frasco de Tirillas)</label></td>
                                    <td style="text-align: left;border: none ;width:80%;"><input type="date" id="expiraTirilla" name="expiraTirilla" value="'.(!$row[8] = '' ? $row[8]->format('Y-m-d'):'').'"> (luego de abrir el frasco 90 dias)</br></td>
                                </tr>
                                <tr>
                                    <td style="text-align: left;border: none ;width:20%;"><label for="ddResultadoTirilla1">1. Resultado Prueba de las Tirillas con Cidex OPA (PURO)</label></td>
                                    <td style="text-align: left;border: none ;width:80%;">'.$row[9].'
                                    <select id="ddResultadoTirilla1" name="ddResultadoTirilla1">
                                        <option value="Fall??"'.($row[9] =='Fall??' ? ' selected' : '').'>Fall?? </option>
                                        <option value="Pas??"'.($row[9] =='Pas??' ? ' selected' : '').'>Pas??</option>
                                    </select></td>     
                                </tr>
                                <tr>
                                    <td style="text-align: left;border: none ;width:20%;"><label for="ddResultadoTirilla2">2. Resultado Prueba de las Tirillas con Cidex OPA (PURO)</label></td>
                                    <td style="text-align: left;border: none ;width:80%;">'.$row[10].'
                                    <select id="ddResultadoTirilla2" name="ddResultadoTirilla2">
                                        <option value="Fall??"'.($row[10] =='Fall??' ? ' selected' : '').'>Fall?? </option>
                                        <option value="Pas??" '.($row[10] =='Pas??' ? ' selected' : '').'>Pas??</option>
                                    </select></td>     
                                </tr>
                                <tr>
                                    <td style="text-align: left;border: none ;width:20%;"><label for="ddResultadoTirilla3">3. Resultado Prueba de las Tirillas con Cidex OPA (PURO)</label></td>
                                    <td style="text-align: left;border: none ;width:80%;"> '.$row[11].'
                                    <select id="ddResultadoTirilla3" name="ddResultadoTirilla3">
                                        <option value="Fall??"'.($row[11] =='Fall??' ? ' selected' : '').'>Fall??</option>
                                        <option value="Pas??" '.($row[11] =='Pas??' ? ' selected' : '').'>Pas??</option>
                                </select></td>     
                                </tr>
                                <tr>
                                    <td style="text-align: left;border: none ;width:20%;"><label for="ddResultadoDiluido1">1. Resultado Prueba de las Tirillas con Cidex OPA (DILUIDO)</label></td>
                                    <td style="text-align: left;border: none ;width:80%;">'.$row[12].'
                                    <select id="ddResultadoDiluido1" name="ddResultadoDiluido1">
                                        <option value="Fall??"'.($row[12] =='Fall??' ? ' selected' : '').'>Fall?? </option>
                                        <option value="Pas??" '.($row[12] =='Pas??' ? ' selected' : '').'>Pas??</option>
                                </select></td>     
                                </tr>
                                <tr>
                                    <td style="text-align: left;border: none ;width:20%;"><label for="ddResultadoDiluido2">2. Resultado Prueba de las Tirillas con Cidex OPA (DILUIDO)</label></td>
                                    <td style="text-align: left;border: none ;width:80%;"> '.$row[13].'
                                    <select id="ddResultadoDiluido2" name="ddResultadoDiluido2">
                                        <option value="Fall??"'.($row[13] =='Fall??' ? ' selected' : '').'>Fall??</option>
                                        <option value="Pas??" '.($row[13] =='Pas??' ? ' selected' : '').'>Pas??</option>
                                </select></td>     
                                </tr>
                                <tr>
                                    <td style="text-align: left;border: none ;width:20%;"><label for="ddResultadoDiluido3">3. Resultado Prueba de las Tirillas con Cidex OPA (DILUIDO)</label></td>
                                    <td style="text-align: left;border: none ;width:80%;"> '.$row[14].'
                                    <select id="ddResultadoDiluido3" name="ddResultadoDiluido3">
                                        <option value="Fall??"'.($row[14] =='Fall??' ? ' selected' : '').'>Fall??</option>
                                        <option value="Pas??" '.($row[14] =='Pas??' ? ' selected' : '').'>Pas??</option>
                                    </select></td>     
                                </tr>
                                <tr>
                                    <td style="text-align: left;border: none ;width:20%;"><label for="txtAccionesCorrectivas">Acciones Correctivas necesarias</label></td>
                                    <td style="text-align: left;border: none ;width:80%;"><input type="text" id="txtAccionesCorrectivas" name="txtAccionesCorrectivas" value="'.$row[15].'"></br></td>
                                </tr>
                                <tr>
                                    <td style="text-align: left;border: none ;width:20%;"><label for="techTest">Nombre de quien abre el frasco o realiza la prueba.</label></td>
                                    <td style="text-align: left;border: none ;width:80%;"><input type="text" id="ddAbreFrasco" name="techTest" value="'.$row[16].'"></br></td>
                                </tr>
                                <tr>
                                    <td style="text-align: left;border: none ;width:20%;"><label for="expiracionSolucion" class="lrequired">Fecha de expiraci??n del frasco de la soluci??n</label></td>
                                    <td style="text-align: left;border: none ;width:80%;"><input type="date" id="expiracionSolucion" name="expiracionSolucion" value="'.(!$row[17] = '' ? $row[17]->format('Y-m-d'):'').'"> (Frasco cerrado)</br></td>
                                </tr>   
                                <tr>
                                    <td style="text-align: left;border: none ;width:20%;"><label for="expiracionTirillas">Fecha de expiraci??n del frasco de tirillas</label></td>
                                    <td style="text-align: left;border: none ;width:80%;"><input type="date" id="expiracionTirillas" name="expiracionTirillas" value="'.(!$row[18] = '' ? $row[18]->format('Y-m-d'):'').'"> (Frasco cerrado)</br></td>
                                </tr>   
                                <tr>
                                    <td style="text-align: center;border:none;width:20%;" colspan="5">
                                        <input type="hidden" name="id" value="'.$row[0].'">
                                        <input type="submit" id="btnSubmit3" value="Guardar">
                                        <input type="button" id="btnCancel3" value="Cancelar">
                                    </td><td style="text-align: left;border:none;"></td>
                                </tr>
                            </table>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <input type="button" class="btn btn-default" data-dismiss="modal" value="Done">
                    </div>
                </div>
            </div>
            </div>';
        break;
        case 'Sleep_Solucion_Cidex':
            $ar = explode(',',$row[18]);
            echo '<div id="solucionCidex" >
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">					
                        Registro de la Verificaci??n de la Soluci??n Cidex OPA e Inmersi??n del Equipo Durante el Proceso de Desinfecci??n de Alto Nivel
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">??</button>
                    </div>
                    <div class="modal-body">                    
                    <form id="frmsolucionCidex" action="rpt.php" target="_self" method="post"><input type="hidden" value="Sleep_Solucion_Cidex" name="tb"><input type="hidden" value="1" name="update">
                        <table>
                            <tr>
                                <td style="text-align: left;border: none ;width:20%;"><label for="fechaSolucion" class="lrequired">Fecha *</label></td>
                                <td style="text-align: left;border: none ;width:80%;"><input type="date" name="fechaSolucion" value="'.(!$row[1] == '' ? $row[1]->format('Y-m-d\TH:i'): '').'"></br></td>
                            </tr>
                            <tr>
                                <td style="text-align: left;border: none ;width:20%;"><label for="txtDept">Departamento</label></td>
                                <td style="text-align: left;border: none ;width:80%;"><input type="text" name="txtDept" value="'.$row[2].'"></td>
                            </tr>
                            <tr>
                                <td style="text-align: left;border: none ;width:20%;"><label for="fechaFrasco">Fecha Abierto Frasco de Tirillas</label></td>
                                <td style="text-align: left;border: none ;width:80%;"><input type="date" name="fechaFrasco" value="'. (!$row[3] == '' ? $row[3]->format('Y-m-d') : '').'"></br></td>
                            </tr>            
                            <tr>
                                <td style="text-align: left;border: none ;width:20%;"><label for="fechaExpiracion">No Use Despu??s de (FECHA)</label></td>
                                <td style="text-align: left;border: none ;width:80%;"><input type="date" name="fechaExpiracion" value="'.(!$row[4] == '' ? $row[4]->format('Y-m-d') : '').'"></br></td>
                            </tr>
                            <tr>
                                <td style="text-align: left;border: none ;width:20%;"><label for="numeroLote">N??m. Lote del Frasco de Tirillas</label></td>
                                <td style="text-align: left;border: none ;width:80%;"><input type="text" name="numeroLote" value="'.$row[5].'"></br></td>
                            </tr>
                            <tr>
                                <td style="text-align: left;border: none ;width:20%;"><label for="ddPruebaRes">Resultados Pruebas de Calidad</label></td>
                                <td style="text-align: left;border: none ;width:80%;">
                                <select name="ddPruebaRes">
                                    <option value="Fall??" '.($row[6] =='Fall??' ? ' selected' : '').'>Fall??</option>
                                    <option value="Pas??" '.($row[6] =='Pas??' ? ' selected' : '').'>Pas??</option>
                                </select></td>     
                            </tr>
                            <tr>
                                <td style="text-align: left;border: none ;width:20%;"><label for="fechaCalidad">Fecha Pruebas de Calidad</label></td>
                                <td style="text-align: left;border: none ;width:80%;"><input type="date" name="fechaCalidad" value="'.(!$row[7] == '' ? $row[7]->format('Y-m-d'):'').'"></br></td>
                            </tr>
                            <tr>
                                <td style="text-align: left;border: none ;width:20%;"><label for="txtProbada" class="lrequired">Probada por *</label></td>
                                <td style="text-align: left;border: none ;width:80%;"><input type="text" name="txtProbada" value="'.$row[8].'" ></br></td>
                            </tr>
                            <tr>
                                <td style="text-align: left;border: none ;width:20%;"><label for="visitIdSolucion" class="lrequired">Visit ID del paciente *</label></td>
                                <td style="text-align: left;border: none ;width:80%;"><input type="number" name="visitIdSolucion" value="'.$row[9].'" required></br></td>
                            </tr>
                            <tr>
                                <td style="text-align: left;border: none ;width:20%;"><label for="fechaComienzo">Fecha de Comienzo de la Soluci??n</label></td>
                                <td style="text-align: left;border: none ;width:80%;"><input type="date" name="fechaComienzo" value="'.(!$row[10] == '' ? $row[10]->format('Y-m-d'):'').'"></br></td>
                            </tr>
                            <tr>
                                <td style="text-align: left;border: none ;width:20%;"><label for="fechaExpiraSolucion">Fecha de Expiraci??n de la Soluci??n</label></td>
                                <td style="text-align: left;border: none ;width:80%;"><input type="date" name="fechaExpiraSolucion" value="'.($row[11] instanceof Date ? $row[11]->format('Y-m-d'): '').'"></br></td>
                            </tr>
                            <tr>
                                <td style="text-align: left;border: none ;width:20%;"><label for="fechaPrueba">Fecha y Hora de Prueba a la Soluci??n</label></td>
                                <td style="text-align: left;border: none ;width:80%;"><input type="datetime-local" name="fechaPrueba" value="'.($row[12] instanceof DateTime ? $row[12]->format('Y-m-d\TH:i'): '').'"></br></td>
                            </tr>
                            <tr>
                                <td style="text-align: left;border: none ;width:20%;"><label for="cpapEquipo">Resultados de la Prueba de Concentraci??n de la Soluci??n</label></td>
                                <td style="text-align: left;border: none ;width:80%;">
                                <select name="cpapEquipo">
                                    <option value="Pas??" '.($row[13] =='Pas??' ? ' selected' : '').'>Pas??</option>
                                    <option value="Fall??"'.($row[13] =='Fall??' ? ' selected' : '').'>Fall??</option>
                                </select></td>     
                            </tr>
                            <tr>
                                <td style="text-align: left;border: none ;width:20%;"><label for="solTemp">Temperatura de Soluci??n Antes de Uso (20-37 Grados Celcius)</label></td>
                                <td style="text-align: left;border: none ;width:80%;"><input type="text" name="solTemp" value="'.$row[14].'"></br></td>
                            </tr>
                            <tr>
                                <td style="text-align: left;border: none ;width:20%;"><label for="ddTurbidez">Ausencia de Turbidez</label></td>
                                <td style="text-align: left;border: none ;width:80%;">
                                <select name="ddTurbidez">
                                    <option value="No" '.($row[15] =='No' ? ' selected' : '').'>No</option>
                                    <option value="Si" '.($row[15] =='Si' ? ' selected' : '').'>Si</option>
                                </select></td>     
                            </tr>
                            <tr>
                                <td style="text-align: left;border: none ;width:20%;"><label for="ddMateria">Ausencia de Materia Org??nica</label></td>
                                <td style="text-align: left;border: none ;width:80%;">
                                <select name="ddMateria">
                                    <option value="No" '.($row[16] =='No' ? ' selected' : '').'>No</option>
                                    <option value="Si" '.($row[16] =='Si' ? ' selected' : '').'>Si</option>
                                </select></td>     
                            </tr>
                            <tr>
                                <td style="text-align: left;border: none ;width:20%;"><label for="txtCorrectivas">Acciones Correctivas (si es necesaria)</label></td>
                                <td style="text-align: left;border: none ;width:80%;"><input type="text" name="txtCorrectivas" value="'.$row[17].'" ></br></td>
                            </tr>
                            <tr>
                                <td style="text-align: left;border: none ;width:20%;"><label>Descripci??n de Equipo</label></td>
                                <td style="text-align: left;border: none ;width:80%;">        
                                    <input type="checkbox" name="ckEquipo[]" id="ckElec" value="Electrodes"'.(in_array('Electrodes',$ar) ? ' checked' : '').'>Electrodes<br>
                                    <input type="checkbox" name="ckEquipo[]" id="ckHumi" value="Humidifier"'.(in_array('Humidifier',$ar) ? ' checked' : '').'>Humidifier<br>
                                    <input type="checkbox" name="ckEquipo[]" id="ckMask" value="Mask"'.(in_array('Mask',$ar) ? ' checked' : '').'>Mask<br>
                                    <input type="checkbox" name="ckEquipo[]" id="ckTube" value="Tubes"'.(in_array('Tubes',$ar) ? ' checked' : '').'>Tubes<br>
                                </td>
                            </tr>
                            <tr>
                                <td style="text-align: left;border: none ;width:20%;"><label for="fechaInmersion">Fecha y Hora de Comienzo de Inmersi??n</label></td>
                                <td style="text-align: left;border: none ;width:80%;"><input type="datetime-local" name="fechaInmersion" value="'.(!$row[19] == '' ? $row[19]->format('Y-m-d\TH:i'):'').'"></br></td>
                            </tr>
                            <tr>
                                <td style="text-align: left;border: none ;width:20%;"><label for="tiempoInmersion">Tiempo de Inmersi??n (minutos)</label></td>
                                <td style="text-align: left;border: none ;width:80%;"><input type="number" name="tiempoInmersion" value="'.($row[20] == '' ? '12' : $row[20]).'" width="5" max="60" min="0"></br></td>
                            </tr>
                            <tr>
                                <td style="text-align: left;border: none ;width:20%;"><label for="txtLiqueo">Prueba de liqueo</label></td>
                                <td style="text-align: left;border: none ;width:80%;"><input type="text" name="txtLiqueo" value="'.$row[21].'"></br></td>
                            </tr>
                            <tr>
                                <td style="text-align: left;border: none ;width:20%;"><label for="techPrueba">Nombre de qui??n realiza la prueba</label></td>
                                <td style="text-align: left;border: none ;width:80%;"><input type="text" name="techPrueba" value="'.$row[22].'"></br>
                            </tr>
                            <tr>
                                <td style="text-align: left;border: none ;width:20%;"><label for="terminacion">Hora termin?? la Inmersi??n</label></td>
                                <td style="text-align: left;border: none ;width:80%;"><input type="time" name="terminacion" value="'.($row[23] instanceof Time ? $row[23]->format('H:i'): '0:00').'"></br></td>
                            </tr>
                            <tr>
                                <td style="text-align: center;border:none;width:20%;" colspan="5">
                                    <input type="hidden" name="id" value="'.$row[0].'">
                                    <input type="submit" id="btnSubmit3" value="Guardar">
                                    <input type="button" id="btnCancel3" value="Cancelar">
                                </td><td style="text-align: left;border:none;"></td>
                            </tr>
                            </table>
                        </form>
                    </div>
                <div class="modal-footer">
                    <input type="button" class="btn btn-default" data-dismiss="modal" value="Done">
                </div>
            </div>
            </div>
            </div>';
        break;
        case 'Sleep_Mant_Cap':
            echo'<div id="MantCAP" >
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">					
                    Mantenimiento Preventivo Capnografo
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">??</button>
                    </div>
                    <div class="modal-body">   
                <form id="frmMantCAP" action="rpt.php" target="rpt" method="post"><input type="hidden" value="Sleep_Mant_Cap" name="tb"><input type="hidden" value="1" name="update">
                <table>
                        <tr>
                            <td style="text-align: left;border: none ;width:20%;"><label for="fechaMant" class="lrequired">Fecha de mantenimiento (Calibracion e Inspeccion visual cada 6 meses)</label></td>
                            <td style="text-align: left;border: none ;width:80%;"><input type="date" name="fechaMant" value="'.(!$row[1] == '' ? $row[1]->format('Y-m-d'): '').'"></br></td>
                        </tr>
                        <tr>
                            <td style="text-align: left;border: none ;width:20%;"><label for="equipo">Equipo</label></td>
                            <td style="text-align: left;border: none ;width:80%;">
                            <input type="radio" id="rdEquipo1" name="equipo" value="501967844" '.($row[2] =='501967844' ? ' checked' : '').'><label for="rdEquipo1">501967844 NONIN MEDICAL INC. RESPSENSE LS1R-9R</label><br/>
                            <input type="radio" id="rdEquipo2" name="equipo" value="590000107"'.($row[2] =='590000107' ? ' checked' : '').'><label for="rdEquipo2">590000107 NONIN MEDICAL INC. RESPSENSE LS1R-9R</label>
                            </br></td>
                        </tr>

                        <tr>
                            <td style="text-align: left;border: none ;width:20%;"><label for="notas">Notas:</label></td>
                            <td style="text-align: left;border: none ;width:80%;"><textarea name="notas" id="notas" rows="4" cols="50">'.trim($row[3]).'</textarea></br></td>
                        </tr>
                        <tr>
                            <td style="text-align: left;border: none ;width:20%;"><label for="tecnico">Mantenimiento por:</label></td>
                            <td style="text-align: left;border: none ;width:80%;"><input type="text" id="tecnico" name="tecnico" value="'.trim($row[4]).'"></br></td>
                        </tr>
                        <tr>
                        <td style="text-align: center;border:none;width:20%;" colspan="5">
                        <input type="hidden" name="id" value="'.$row[0].'">
                        <input type="submit" id="btnSubmit3" value="Guardar">
                    </td><td style="text-align: left;border:none;"></td>
                        </tr>
                    </table>
                </form>
                </div>
                <div class="modal-footer">
                <input type="button" class="btn btn-default" data-dismiss="modal" value="Cerrar">
            </div></div>
            </div>';
        break;
        case 'Sleep_Mant_PAP':
            echo'<div id="MantPAP" class="noprint content">
                <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">					
                            Mantenimiento Preventivo PAP
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">??</button>
                            </div>
                        <div class="modal-body">
                <form id="frmMantPAP" action="rpt.php" target="rpt" method="post"><input type="hidden" value="Sleep_Mant_PAP" name="tb"><input type="hidden" value="1" name="update">
                <table>
                        <tr>
                            <td style="text-align: left;border: none ;width:20%;"><label for="fechaMant" class="lrequired">Fecha de mantenimiento (Inspeccion visual cada 6 meses)</label></td>
                            <td style="text-align: left;border: none ;width:80%;"><input type="date" name="fechaMant" value="'.(!$row[1] == '' ? $row[1]->format('Y-m-d'): '').'"></br></td>
                        </tr>
                        <tr>
                            <td style="text-align: left;border: none ;width:20%;"><label for="equipo">PAP</label></td>
                            <td style="text-align: left;border: none ;width:80%;">
                            <select id="equipo" name="equipo" required>
                                <option value="" selected>Seleccione</option>
                                <option value="L120923865976"'.($row[2] =='L120923865976' ? ' selected' : '').'>L120923865976 PHILIPS</option>
                                <option value="L12092399B859"'.($row[2] =='L12092399B859' ? ' selected' : '').'>L12092399B859 PHILIPS</option>
                                <option value="L120924016F0C"'.($row[2] =='L120924016F0C' ? ' selected' : '').'>L120924016F0C PHILIPS</option>
                                <option value="L146449847EC7"'.($row[2] =='L146449847EC7' ? ' selected' : '').'>L146449847EC7 PHILIPS</option>
                                <option value="L150102570615"'.($row[2] =='L150102570615' ? ' selected' : '').'>L150102570615 PHILIPS</option>
                                <option value="22151762119"'.($row[2] =='22151762119' ? ' selected' : '').'>22151762119 RESMED</option>
                                <option value="22152090784"'.($row[2] =='22152090784' ? ' selected' : '').'>22152090784 RESMED</option>
                                <option value="22152090785"'.($row[2] =='22152090785' ? ' selected' : '').'>22152090785 RESMED</option>
                                <option value="22152090801"'.($row[2] =='22152090801' ? ' selected' : '').'>22152090801 RESMED</option>
                                <option value="22152090841"'.($row[2] =='22152090841' ? ' selected' : '').'>22152090841 RESMED</option>
                                <option value="22152090842"'.($row[2] =='22152090842' ? ' selected' : '').'>22152090842 RESMED</option>
                            </select>
                            <label for="cama" class="lrequired">Cama</label>
                            <select id="cama" name="cama" required>
                                <option value="" selected>Seleccione</option>
                                <option value="1"'.($row[3] =='1' ? ' selected' : '').'>1</option>
                                <option value="2"'.($row[3] =='2' ? ' selected' : '').'>2</option>
                                <option value="3"'.($row[3] =='3' ? ' selected' : '').'>3</option>
                                <option value="4"'.($row[3] =='4' ? ' selected' : '').'>4</option>
                                <option value="5"'.($row[3] =='5' ? ' selected' : '').'>5</option>
                                <option value="6"'.($row[3] =='6' ? ' selected' : '').'>6</option>
                                <option value="7"'.($row[3] =='7' ? ' selected' : '').'>7</option>
                                <option value="8"'.($row[3] =='8' ? ' selected' : '').'>8</option>
                                <option value="9"'.($row[3] =='9' ? ' selected' : '').'>9</option>
                                <option value="10"'.($row[3] =='10' ? ' selected' : '').'>10</option>
                                <option value="11"'.($row[3] =='11' ? ' selected' : '').'>11</option>
                                <option value="12"'.($row[3] =='12' ? ' selected' : '').'>12</option>
                            </select>
                        </tr>
                        <tr>
                            <td style="text-align: left;border: none ;width:20%;"><label for="notas1">Notas:</label></td>
                            <td style="text-align: left;border: none ;width:80%;"><textarea name="notas1" id="notas1" rows="4" cols="50">'.trim($row[4]).'</textarea></br></td>
                        </tr>
                        <tr>
                            <td style="text-align: left;border: none ;width:20%;"><label for="txtTecnico" class="lrequired">Nombre del T??cnico</label></td>
                            <td style="text-align: left;border: none ;width:80%;"><input type="text" name="txtTecnico" value="'.$row[5].'" required></br></td>
                        </tr>
                        <tr>
                            <td style="text-align: center;border:none;width:20%;"><input type="hidden" name="id" value="'.$row[0].'">
                                <input type="submit" id="btnSubmit3" value="Guardar">
                            </td><td style="text-align: left;border:none;"></td>
                        </tr>
                    </table>
                </form>
                </div><div class="modal-footer">
                <input type="button" class="btn btn-default" data-dismiss="modal" value="Cerrar">
            </div>
            </div>';
        break;
        case 'Sleep_Mant_HA':
            echo '<div id="MantHA" class="noprint content">
            <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">					
                Mantenimiento Preventivo Headbox y Amplificadores
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">??</button>
                </div>
            <div class="modal-body"><form id="frmMantPAP" action="rpt.php" target="rpt" method="post"><input type="hidden" value="Sleep_Mant_HA" name="tb"><input type="hidden" value="1" name="update">
                <table>
                    <tr>
                        <td style="text-align: left;border: none ;width:20%;"><label for="fechaMant" class="lrequired">Fecha de mantenimiento (Inspeccion visual cada 6 meses)</label></td>
                        <td style="text-align: left;border: none ;width:80%;"><input type="date" name="fechaMant" value="'.(!$row[1] == '' ? $row[1]->format('Y-m-d'): '').'"></br></td>
                    </tr>
                    <tr>
                        <td style="text-align: left;border: none ;width:20%;"><label for="equipo">Headbox</label></td>
                        <td style="text-align: left;border: none ;width:80%;">
                        <select id="Headbox" name="Headbox" required>
                            <option value="" selected>Seleccione</option>
                            <option value="BWIII2015-1204"'.($row[2] =='BWIII2015-1204' ? ' selected' : '').'>BWIII2015-1204</option>
                            <option value="BWIII2015-1211"'.($row[2] =='BWIII2015-1211' ? ' selected' : '').'>BWIII2015-1211</option>
                            <option value="BWIII2016-1249"'.($row[2] =='BWIII2016-1249' ? ' selected' : '').'>BWIII2016-1249</option>
                            <option value="BWIII2016-1251"'.($row[2] =='BWIII2016-1251' ? ' selected' : '').'>BWIII2016-1251</option>
                            <option value="BWIII2016-1270"'.($row[2] =='BWIII2016-1270' ? ' selected' : '').'>BWIII2016-1270</option>
                            <option value="BWIII2016-1250"'.($row[2] =='BWIII2016-1250' ? ' selected' : '').'>BWIII2016-1250</option>
                            <option value="BWIII2016-1269"'.($row[2] =='BWIII2016-1269' ? ' selected' : '').'>BWIII2016-1269</option>
                            <option value="BWIII2015-1216"'.($row[2] =='BWIII2015-1216' ? ' selected' : '').'>BWIII2015-1216</option>
                            <option value="BWIII2015-1215"'.($row[2] =='BWIII2015-1215' ? ' selected' : '').'>BWIII2015-1215</option>
                            <option value="BWIII2015-1213"'.($row[2] =='BWIII2015-1213' ? ' selected' : '').'>BWIII2015-1213</option>
                            <option value="BWIII2015-1212"'.($row[2] =='BWIII2015-1212' ? ' selected' : '').'>BWIII2015-1212</option>
                            <option value="BWIII2015-1210"'.($row[2] =='BWIII2015-1210' ? ' selected' : '').'>BWIII2015-1210</option>
                        </select>
                        <label for="ddCama" class="lrequired">Cama</label>
                        <select id="cama1" name="cama1" required>
                            <option value="" selected>Seleccione</option>
                            <option value="1"'.($row[3] =='1' ? ' selected' : '').'>1</option>
                            <option value="3"'.($row[3] =='2' ? ' selected' : '').'>3</option>
                            <option value="3"'.($row[3] =='3' ? ' selected' : '').'>3</option>
                            <option value="4"'.($row[3] =='4' ? ' selected' : '').'>4</option>
                            <option value="5"'.($row[3] =='5' ? ' selected' : '').'>5</option>
                            <option value="6"'.($row[3] =='6' ? ' selected' : '').'>6</option>
                            <option value="7"'.($row[3] =='7' ? ' selected' : '').'>7</option>
                            <option value="8"'.($row[3] =='8' ? ' selected' : '').'>8</option>
                            <option value="9"'.($row[3] =='9' ? ' selected' : '').'>9</option>
                            <option value="10"'.($row[3] =='10' ? ' selected' : '').'>10</option>
                            <option value="11"'.($row[3] =='11' ? ' selected' : '').'>11</option>
                            <option value="12"'.($row[3] =='12' ? ' selected' : '').'>12</option>
                        </select>
                    </tr>
                    <tr>
                        <td style="text-align: left;border: none ;width:20%;"><label for="amplificadores">Equipo</label></td>
                        <td style="text-align: left;border: none ;width:80%;">
                        <select id="amplificadores" name="amplificadores" required>
                            <option value="" selected>Seleccione</option>
                            <option value="BWIII2015-1204"'.($row[4] =='BWIII2015-1204' ? ' selected' : '').'>BWIII2015-1204</option>
                            <option value="BWIII2015-1211"'.($row[4] =='BWIII2015-1211' ? ' selected' : '').'>BWIII2015-1211</option>
                            <option value="BWIII2016-1249"'.($row[4] =='BWIII2016-1249' ? ' selected' : '').'>BWIII2016-1249</option>
                            <option value="BWIII2016-1251"'.($row[4] =='BWIII2016-1251' ? ' selected' : '').'>BWIII2016-1251</option>
                            <option value="BWIII2016-1270"'.($row[4] =='BWIII2016-1270' ? ' selected' : '').'>BWIII2016-1270</option>
                            <option value="BWIII2016-1250"'.($row[4] =='BWIII2016-1250' ? ' selected' : '').'>BWIII2016-1250</option>
                            <option value="BWIII2016-1269"'.($row[4] =='BWIII2016-1269' ? ' selected' : '').'>BWIII2016-1269</option>
                            <option value="BWIII2015-1216"'.($row[4] =='BWIII2015-1216' ? ' selected' : '').'>BWIII2015-1216</option>
                            <option value="BWIII2015-1215"'.($row[4] =='BWIII2015-1215' ? ' selected' : '').'>BWIII2015-1215</option>
                            <option value="BWIII2015-1213"'.($row[4] =='BWIII2015-1213' ? ' selected' : '').'>BWIII2015-1213</option>
                            <option value="BWIII2015-1212"'.($row[4] =='BWIII2015-1212' ? ' selected' : '').'>BWIII2015-1212</option>
                            <option value="BWIII2015-1210"'.($row[4] =='BWIII2015-1210' ? ' selected' : '').'>BWIII2015-1210</option>
                        </select>
                        <label for="ddCama" class="lrequired">Cama</label>
                        <select id="cama2" name="cama2" required>
                            <option value="" selected>Seleccione</option>
                            <option value="1" '.($row[5] =='1' ? ' selected' : '').'>1</option>
                            <option value="2" '.($row[5] =='2' ? ' selected' : '').'>2</option>
                            <option value="3" '.($row[5] =='3' ? ' selected' : '').'>5</option>
                            <option value="4" '.($row[5] =='4' ? ' selected' : '').'>4</option>
                            <option value="5" '.($row[5] =='5' ? ' selected' : '').'>5</option>
                            <option value="6" '.($row[5] =='6' ? ' selected' : '').'>6</option>
                            <option value="7" '.($row[5] =='7' ? ' selected' : '').'>7</option>
                            <option value="8" '.($row[5] =='8' ? ' selected' : '').'>8</option>
                            <option value="9" '.($row[5] =='9' ? ' selected' : '').'>9</option>
                            <option value="10"'.($row[5] =='10' ? ' selected' : '').'>10</option>
                            <option value="11"'.($row[5] =='11' ? ' selected' : '').'>11</option>
                            <option value="12"'.($row[5] =='12' ? ' selected' : '').'>12</option>
                        </select>
                    </tr>
                    <tr>
                        <td style="text-align: left;border: none ;width:20%;"><label for="notas1">Notas:</label></td>
                        <td style="text-align: left;border: none ;width:80%;"><textarea name="notas1" id="notas1" rows="4" cols="50">'.trim($row[6]).'</textarea></br></td>
                    </tr>
                    <tr>
                        <td style="text-align: left;border: none ;width:20%;"><label for="txtTecnico">Inpeccionado por</label></td>
                        <td style="text-align: left;border: none ;width:80%;"><input type="text" name="txtTecnico" value="'.$row[7].'" ></br></td>
                    </tr>
                    <tr>
                        <td style="text-align: center;border:none;width:20%;"><input type="hidden" name="id" value="'.$row[0].'">
                            <input type="submit" id="btnSubmit3" value="Guardar">
                        </td><td style="text-align: left;border:none;"></td>
                    </tr>
                </table>
                </form>
                </div><div class="modal-footer">
                <input type="button" class="btn btn-default" data-dismiss="modal" value="Cerrar">
            </div>
            </div>';
        break;
        case 'Sleep_Mant_Equipos':
            $ar = explode(',',$row[2]);
            echo '<div id="MantEq" class="noprint content">
            <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">					
                Mantenimiento Equipos
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">??</button>
                </div>
            <div class="modal-body">
                <form id="frmMantEqu" action="rpt.php" target="rpt" method="post"><input type="hidden" value="Sleep_Mant_Equipos" name="tb"><input type="hidden" value="1" name="update">
                <table>
                    </style>
                        <tr>
                            <td style="text-align: left;border: none ;width:20%;"><label for="fechaMant" class="lrequired">Fecha de mantenimiento</label></td>
                            <td style="text-align: left;border: none ;width:80%;"><input type="date" name="fechaMant" value="'.(!$row[1] == '' ? $row[1]->format('Y-m-d'): '').'"></br></td>
                        </tr>
                        <tr>
                            <td style="text-align: left;border: none ;width:20%;"><label for="ckEquipo" class="lrequired">Equipos:</label></td>
                            <td style="text-align: left;border: none ;width:80%;">
                            <input type="checkbox" name="ckEquipo[]" value="SH614534977SA"'.(in_array('SH614534977SA',$ar) ? ' checked' : '').'>SH614534977SA GENERAL ELECTRIC V100 VITAL SIGNS MONITOR<br/>
                            <input type="checkbox" name="ckEquipo[]" value="SH618310150SA"'.(in_array('SH618310150SA',$ar) ? ' checked' : '').'>SH618310150SA GENERAL ELECTRIC V100 VITAL SIGNS MONITOR<br/>
                            <input type="checkbox" name="ckEquipo[]" value="G02854573"'.(in_array('G02854573',$ar) ? ' checked' : '').'>G02854573 NELLCOR N595 PULSE OXIMETER<br/>
                            <input type="checkbox" name="ckEquipo[]" value="G05862166"'.(in_array('G05862166',$ar) ? ' checked' : '').'>G05862166 NELLCOR N595 PULSE OXIMETER<br/>
                            <input type="checkbox" name="ckEquipo[]" value="066957"'.(in_array('066957',$ar) ? ' checked' : '').'>066957 PRECISION MEDICAL EASY GO SUCTION PUMP<br/>
                            <input type="checkbox" name="ckEquipo[]" value="US00119956"'.(in_array('US00119956',$ar) ? ' checked' : '').'>US00119956 PHILIPS M4735 DEFIBRILLATOR/MONITOR<br/>
                            <input type="checkbox" name="ckEquipo[]" value="A142460"'.(in_array('A142460',$ar) ? ' checked' : '').'>A142460 EXERGEN TAT 5000S TERMOMETRO<br/>
                            <input type="checkbox" name="ckEquipo[]" value="A165685"'.(in_array('A165685',$ar) ? ' checked' : '').'>A165685 EXERGEN TAT 5000 TERMOMETRO<br/>
                            <input type="checkbox" name="ckEquipo[]" value="BALANZA"'.(in_array('BALANZA',$ar) ? ' checked' : '').'>BALANZA 33 DETECTO DETECTO BALANZA<br/>
                        </tr>
                        <tr>
                            <td style="text-align: left;border: none ;width:20%;"><label for="notas1">Notas:</label></td>
                            <td style="text-align: left;border: none ;width:80%;"><textarea name="notas1" id="notas1" rows="4" cols="50">'.trim($row[3]).'</textarea></br></td>
                        </tr>
                        <tr>
                            <td style="text-align: left;border: none ;width:20%;"><label for="txtTecnico" class="lrequired">Mantenimiento por</label></td>
                            <td style="text-align: left;border: none ;width:80%;"><input type="text" name="txtTecnico" value="'.$row[4].'" required></br></td>
                        </tr>
                        <tr>
                            <td style="text-align: center;border:none;width:20%;"><input type="hidden" name="id" value="'.$row[0].'">
                                <input type="submit" id="btnSubmit3" value="Guardar">
                            </td><td style="text-align: left;border:none;"></td>
                        </tr>
                    </table>
                </form>
                </div><div class="modal-footer">
                <input type="button" class="btn btn-default" data-dismiss="modal" value="Cerrar">
            </div>
            </div>';
        break;
        case 'Sleep_Biomedica_Equipos':
            echo '<div id="BioEq" class="noprint content">
            <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">					
                Equipos enviados para reparaci??n
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">??</button>
                </div>
            <div class="modal-body">
                <form id="frmBioEq" action="rpt.php" target="rpt" method="post"><input type="hidden" value="Sleep_Biomedica_Equipos" name="tb"><input type="hidden" value="1" name="update">
                <table>
                        <tr>
                            <td style="text-align: left;border: none ;width:20%;"><label for="equipo">Equipo</label></td>
                            <td style="text-align: left;border: none ;width:80%;"><input type="text" name="equipo" value="'.$row[1].'"></br></td>
                        </tr>
                        <tr>
                            <td style="text-align: left;border: none ;width:20%;"><label for="problema">Problema reportado:</label></td>
                            <td style="text-align: left;border: none ;width:80%;"><input type="text" name="problema" value="'.$row[2].'"></br></td>
                        </tr>
                        <tr>
                            <td style="text-align: left;border: none ;width:20%;"><label for="reportado" class="lrequired">Fecha reportado por personal t??cnico:</label></td>
                            <td style="text-align: left;border: none ;width:80%;"><input type="date" name="reportado" value="'.(!$row[3] == '' ? $row[3]->format('Y-m-d'): '').'"></br></td>
                        </tr>
                        <tr>
                            <td style="text-align: left;border: none ;width:20%;"><label for="reporto">Qui??n report??:</label></td>
                            <td style="text-align: left;border: none ;width:80%;"><input type="text" name="reporto" value="'.$row[4].'"></br></td>
                        </tr>
                        <tr>
                            <td style="text-align: left;border: none ;width:20%;"><label for="fechaEnvio" class="lrequired">Fecha de env??o</label></td>
                            <td style="text-align: left;border: none ;width:80%;"><input type="date" name="fechaEnvio" value="'.(!$row[5] == '' ? $row[5]->format('Y-m-d'): '').'"></br></td>
                        </tr>
                        <tr>
                            <td style="text-align: left;border: none ;width:20%;"><label for="tracking">Tracking number:</label></td>
                            <td style="text-align: left;border: none ;width:80%;"><input type="text" name="tracking" value="'.$row[6].'" required></br></td>
                        </tr>
                        <tr>
                            <td style="text-align: left;border: none ;width:20%;"><label for="recibido">Fecha recibido:</label></td>
                            <td style="text-align: left;border: none ;width:80%;"><input type="date" name="recibido" value="'.(!$row[7] == '' ? $row[7]->format('Y-m-d'): '').'"></br></td>
                        </tr>
                        <tr>
                            <td style="text-align: left;border: none ;width:20%;"><label for="notas1">Notas:</label></td>
                            <td style="text-align: left;border: none ;width:80%;"><textarea name="notas1" id="notas1" rows="4" cols="50">'.trim($row[8]).'</textarea></br></td>
                        </tr>
                        <tr>
                            <td style="text-align: left;border: none ;width:20%;"><label for="biomedico" class="lrequired">Nombre del biom??dico</label></td>
                            <td style="text-align: left;border: none ;width:80%;"><input type="text" name="biomedico" value="'.$row[9].'" required></br></td>
                        </tr>
                        <tr>
                            <td style="text-align: center;border:none;width:20%;"><input type="hidden" name="id" value="'.$row[0].'">
                                <input type="submit" id="btnSubmit3" value="Guardar">
                            </td><td style="text-align: left;border:none;"></td>
                        </tr>
                    </table>
                </form>
                </div><div class="modal-footer">
                <input type="button" class="btn btn-default" data-dismiss="modal" value="Cerrar">
            </div>
            </div>';
        break;
        default:
        break;
}   
?>