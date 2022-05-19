<?php 
require_once("cno.php");
$divs = 
'<center><img src="imgs/ham.jpg"></center>
<div id="SleepStudies" class="noprint content">
<div class="contentt">
<tr>Sleep Studies Results - <a href="rpt.php?tb=Sleep_Studies_Results"><i class="fa-solid fa-file-lines fa-2x"></i></a></td></tr><hr></br>
    <table>
        <form id="frmStudies" action="rpt.php" target="rpt" method="post"><input type="hidden" value="Sleep_Studies_Results" name="tb">
            <tr>
                <td style="text-align: left;border: none ;width:20%;"><label for="expedienteResults" class="lrequired">Numero de expediente </label></td>
                <td style="text-align: left;border: none ;width:80%;"><input type="text" id="expedienteResults" name="expedienteResults" placeholder="Numero de expediente" required></br></td>
            </tr>
            <tr>
                <td style="text-align: left;border: none ;width:20%;"><label for="nombreResultados">Nombre</label></td>
                <td style="text-align: left;border: none ;width:70%;"><input type="text" id="nombreResultados" name="nombreResultados" placeholder="Nombre"></br></td>
            </tr>
            <tr>
                <td style="text-align: left;border: none ;width:20%;"><label for="txtApellidos">Apellidos </label></td>
                <td style="text-align: left;border: none ;width:70%;"><input type="text" id="txtApellidos" name="txtApellidos" placeholder="Apellidos"></br></td>
            </tr>
            <tr>
                <td style="text-align: left;border: none ;width:20%;"><label for="txtfechaEstudio" class="lrequired">Fecha de Estudio </label></td>
                <td style="text-align: left;border: none ;width:70%;"><input type="date" id="txtfechaEstudio" name="txtfechaEstudio" placeholder="Fecha de Estudio" required></br></td>
            </tr>
            <tr>
                <td style="text-align: left;border: none ;width:20%;"><label for="fechaEntrega">Fecha de entrega por MD </label></td>
                <td style="text-align: left;border: none ;width:70%;"><input type="date" id="fechaEntrega" name="fechaEntrega" placeholder="Fecha de entrega por MD"></br></td>
            </tr>
            <tr>
                <td style="text-align: left;border: none ;width:20%;"><label for="txtMedico">Medico </label></td>
                <td style="text-align: left;border: none ;width:70%;"><input type="text" id="txtMedico" name="txtMedico" placeholder="Medico"></br></td>
            </tr>
            <tr>
                <td style="text-align: left;border: none ;width:20%;"><label for="txtVisitID">Visit ID </label></td>
                <td style="text-align: left;border: none ;width:70%;"><input type="number" id="txtVisitID" name="txtVisitID" placeholder="Visit ID"></br></td>
            </tr>
            <tr>
                <td style="text-align: left;border: none ;width:20%;"><label for="txtDED">DED </label></td>
                <td style="text-align: left;border: none ;width:70%;"><input type="text" id="txtDED" name="txtDED" placeholder="DED"></br></td>
            </tr>
            <tr>
                <td style="text-align: left;border: none ;width:20%;"><label for="txtPlan">Plan Medico </label></td>
                    <td style="text-align: left;border: none ;width:70%;"><input type="text" id="txtPlan" name="txtPlan" placeholder="Plan Medico"></br></td>
            </tr>
            <tr>
                <td style="text-align: left;border: none ;width:20%;"><label for="txtOtroPlan">Otro Plan Medico </label></td>
                <td style="text-align: left;border: none ;width:70%;"><input type="text" id="txtOtroPlan" name="txtOtroPlan" placeholder="Otro Plan Medico"></br></td>
            </tr>
            <tr><td style="text-align: left;border: none ;width:20%;" colspan="2"></td>
            <td style="text-align: left;border: none ;width:70%;" colspan="2"></td></tr>
            <tr>
                <td style="text-align: center;border:none;width:20%;">
                    <button id="btn" class="dentro salvar">Someter</button>
                    <button class="dentro" type="reset">Cancel / Reset</button>
                </td>
                <td style="text-align: left;border:none;"></td>
            </tr>
        </table>
    </form>
    </div>
</div>

<div id="lstExpedientes" class="noprint content">
<div class="contentt">
<tr>Listado de Expedientes de la Clínica - <a href="rpt.php?tb=Sleep_Listado_Expedientes"><i class="fa-solid fa-file-lines fa-2x"></i></a></tr><hr></br>
    <form id="frmExpedientes" action="rpt.php" target="rpt" method="post"><input type="hidden" value="Sleep_Listado_Expedientes" name="tb">
    <table>
        </style>
            <tr>
                <td style="text-align: left;border: none ;width:20%;"><label for="numExpediente" class="lrequired">Numero de expediente </label></td>
                <td style="text-align: left;border: none ;width:80%;"><input type="text" id="numExpediente" name="numExpediente" placeholder="Numero de expediente" required></br></td>
            </tr>
            <tr>
                <td style="text-align: left;border: none ;width:20%;"><label for="nombre2" class="lrequired">Nombre</label></td>
                <td style="text-align: left;border: none ;width:80%;"><input type="text" id="nombre2" name="nombre2" placeholder="Nombre" required></br></td>
            </tr>
            <tr>
                <td style="text-align: left;border: none ;width:20%;"><label for="apellidos2" class="lrequired">Apellidos </label></td>
                <td style="text-align: left;border: none ;width:80%;"><input type="text" id="apellidos2" name="apellidos2" placeholder="Apellidos" required></br></td>
            </tr>
            <tr>
                <td style="text-align: left;border: none ;width:20%;"><label for="txtTelefono">Telefono (1)</label></td>
                <td style="text-align: left;border: none ;width:80%;"><input type="tel" id="txtTelefono" name="txtTelefono" placeholder="123-456-7890"></br></td>
            </tr>
            <tr>
                <td style="text-align: left;border: none ;width:20%;"><label for="txtTelefono2">Telefono (2)</label></td>
                <td style="text-align: left;border: none ;width:80%;"><input type="tel" id="txtTelefono2" name="txtTelefono2" placeholder="123-456-7890"></br></td>
            </tr>
            <tr>
                <td style="text-align: center;border:none;width:20%;">
                    <input type="submit" id="btnSubmit2" value="Someter">
                    <input type="button" id="btnCancel2" value="Cancel">
                </td><td style="text-align: left;border:none;"></td>
            </tr>
        </table>
    </form>
    </div>
</div>

<div id="lstReferidos" class="noprint content">
<div class="contentt">
    <tr>Listado de Referidos - <a href="rpt.php?tb=Sleep_Listado_Referidos"><i class="fa-solid fa-file-lines fa-2x"></i></a></tr><hr></br>
    <form id="frmReferidos" action="rpt.php" target="rpt" method="post"><input type="hidden" value="Sleep_Listado_Referidos" name="tb">
        <table>
        </style>
            <tr>
                <td style="text-align: left;border: none ;width:20%;"><label for="expediente" class="lrequired">Numero de expediente </label></td>
                <td style="text-align: left;border: none ;width:80%;"><input type="text" id="expediente" name="expediente" placeholder="Numero de expediente"></br></td>
            </tr>
            <tr>
                <td style="text-align: left;border: none ;width:20%;"><label for="nombreReferido">Nombre </label></td>
                <td style="text-align: left;border: none ;width:80%;"><input type="text" id="nombreReferido" name="nombreReferido" placeholder="Nombre"></br></td>
            </tr>
            <tr>
                <td style="text-align: left;border: none ;width:20%;"><label for="apellidosReferido">Apellidos </label></td>
                <td style="text-align: left;border: none ;width:80%;"><input type="text" id="apellidosReferido" name="apellidosReferido" placeholder="Apellidos"></br></td>
            </tr>
            <tr>
                <td style="text-align: left;border: none ;width:20%;"><label for="fechaEstudio">Dia del Estudio</label></td>
                <td style="text-align: left;border: none ;width:80%;"><input type="date" id="fechaEstudio" name="fechaEstudio" placeholder="Dia del Estudio"></br></td>
            </tr>
            <tr>
                <td style="text-align: left;border: none ;width:20%;"><label for="visitRef">Visit ID </label></td>
                <td style="text-align: left;border: none ;width:80%;"><input type="number" id="visitRef" name="visitRef" placeholder="Visit ID"></br></td>
            </tr>
            <tr>
                <td style="text-align: left;border: none ;width:20%;"><label for="planReferido">Plan Medico </label></td>
                <td style="text-align: left;border: none ;width:80%;"><input type="text" id="planReferido" name="planReferido" placeholder="Plan Medico"></br></td>
            </tr>
            <tr>
                <td style="text-align: left;border: none ;width:20%;"><label for="otroPlanReferido">Otro Plan Medico </label></td>
                <td style="text-align: left;border: none ;width:80%;"><input type="text" id="otroPlanReferido" name="otroPlanReferido" placeholder="Otro Plan Medico"></br></td>
            </tr>
            <tr>
                <td style="text-align: left;border: none ;width:20%;"><label for="ddReferidoMD">Referido Completado por el Médico</label></td>
                <td style="text-align: left;border: none ;width:80%;">
                <select id="ddReferidoMD" name="ddReferidoMD">
                    <option value="si" selected>Si</option>
                    <option value="no">No</option>
                </select></td>
            </tr>
            <tr>
                <td style="text-align: center;border:none;width:20%;">
                    <input type="submit" id="btnSubmit3" value="Someter">
                    <input type="button" id="btnCancel3" value="Cancel">
                </td><td style="text-align: left;border:none;"></td>
            </tr>
        </table>
    </form>
    </div>
</div>

<div id="InspeccionVisual" class="noprint content">
<div class="contentt">
    <tr>Inspección Visual de Rutina - <a href="rpt.php?tb=Sleep_Inspeccion_Rutina"><i class="fa-solid fa-file-lines fa-2x"></i></a></tr><hr></br>
    <form id="frmInspeccionVisual" action="rpt.php" target="rpt" method="post"><input type="hidden" value="Sleep_Inspeccion_Rutina" name="tb">
        <table>
        </style>
            <tr>
                <td style="text-align: left;border: none ;width:20%;"><label for="fechaInspeccion">Fecha de Inspeccion</label></td>
                <td style="text-align: left;border: none ;width:20%;"><input type="datetime-local" id="fechaInspeccion" name="fechaInspeccion" value="'.date('Y-m-d\TH:s').'"></br></td>
                <td style="text-align: left;border: none ;width:10%;"></br></td>
                <td style="text-align: left;border: none ;width:50%;"></br></td>
            </tr>
            <tr>
                <td style="text-align: left;border: none ;width:20%;"><label for="ddHabitacion" class="lrequired">Número de Habitación</label></td>
                <td style="text-align: left;border: none ;width:20%;">
                    <select id="ddHabitacion" name="ddHabitacion" required>
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                        <option value="5">5</option>
                        <option value="6">6</option>
                        <option value="7">7</option>
                        <option value="8">8</option>
                        <option value="9">9</option>
                        <option value="10">10</option>
                        <option value="11">11</option>
                        <option value="12">12</option>
                    </select></td>
                <td style="text-align: left;border: none ;width:10%;"><label for="ddCama1">Cama</label></td>
                <td style="text-align: left;border: none ;width:50%;">
                    <select id="ddCama1" name="ddCama1">
                        <option value="Intacta" selected>Intacta</option>
                        <option value="Alterada">Alterada</option>
                    </select>
                </td>
            </tr>
            <tr>
                <td style="text-align: left;border: none ;width:20%;"><label for="ddAmplificador">Amplificador</label></td>
                <td style="text-align: left;border: none ;width:20%;">
                    <select id="ddAmplificador" name="ddAmplificador">
                        <option value="Intactos" selected>Intacto</option>
                        <option value="Alterados">Alterado</option>
                    </select>
                </td>
                <td style="text-align: left;border: none ;width:10%;"><label for="ddBandas">Bandas</label></td>
                <td style="text-align: left;border: none ;width:50%;">
                    <select id="ddBandas" name="ddBandas">
                        <option  value="Intacta" selected>Intacta</option>
                        <option value="Alterada">Alterada</option>
                    </select>
                </td>
            </tr>
            <tr>
                <td style="text-align: left;border: none ;width:20%;"><label for="ddHeadbox">Headbox</label></td>
                <td style="text-align: left;border: none ;width:20%;">
                    <select id="ddHeadbox" name="ddHeadbox">
                        <option value="Intactos" selected>Intacto</option>
                        <option value="Alterados">Alterado</option>
                    </select>
                </td>
                <td style="text-align: left;border: none ;width:10%;"><label for="ddSensores">Sensores</label></td>
                <td style="text-align: left;border: none ;width:50%;">
                    <select id="ddSensores" name="ddSensores">
                        <option value="Intactos" selected>Intactos</option>
                        <option value="Alterados">Alterados</option>
                    </select>
                </td>
            </tr>
            <tr>
                <td style="text-align: left;border: none ;width:20%;"><label for="ddOximetro">Oxímetro</label></td>
                <td style="text-align: left;border: none ;width:20%;">
                    <select id="ddOximetro" name="ddOximetro">
                        <option value="Intactos" selected>Intacto</option>
                        <option value="Alterados">Alterado</option>
                    </select>
                </td>
                <td style="text-align: left;border: none ;width:10%;"><label for="ddElectrodos">Electrodos</label></td>
                <td style="text-align: left;border: none ;width:50%;">
                    <select id="ddElectrodos" name="ddElectrodos">
                        <option value="Intactos" selected>Intacto</option>
                        <option value="Alterados">Alterado</option>
                    </select>
                </td>
            </tr>
            <tr>
                <td style="text-align: left;border: none ;width:20%;"><label for="ddOxigeno">Metro de Oxígeno</label></td>
                <td style="text-align: left;border: none ;width:20%;">
                <select id="ddOxigeno" name="ddOxigeno">
                    <option value="Intactos" selected>Intacto</option>
                    <option value="Alterados">Alterado</option>
                </select>
                </td>
                <td style="text-align: left;border: none ;width:10%;"><label for="ddIntrcome">Intercome</label></td>
                <td style="text-align: left;border: none ;width:50%;">
                <select id="ddIntrcome" name="ddIntrcome">
                    <option  value="Intacta" selected>Intacta</option>
                    <option value="Alterada">Alterada</option>
                </select>
            </td>
            </tr>
            <tr>
                <td style="text-align: left;border: none ;width:20%;"><label for="ddCPAP">CPAP</label></td>
                <td style="text-align: left;border: none ;width:20%;">
                    <select id="ddCPAP" name="ddCPAP">
                        <option value="Intactos">Intacto</option>
                        <option value="Alterados">Alterado</option>
                    </select>
                </td>
                <td style="text-align: left;border: none ;width:10%;"><label for="ddPC">PC</label></td>
                <td style="text-align: left;border: none ;width:50%;">
                    <select id="ddPC" name="ddPC">
                        <option  value="Intacta" selected>Intacta</option>
                        <option value="Alterada">Alterada</option>
                    </select>
                </td>
            </tr>
            <tr>
                <td style="text-align: left;border: none ;width:20%;"><label for="ddTrans">Transcutaneo</label></td>
                <td style="text-align: left;border: none ;width:20%;">
                    <select id="ddTrans" name="ddTrans">
                        <option value="-" selected>N/A</option>
                        <option value="Intacto">Intacto</option>
                        <option value="Alterado">Alterado</option>
                    </select>
                </td>
                <td style="text-align: left;border: none ;width:10%;"><label for="ddETCO">ETCO</label></td>
                <td style="text-align: left;border: none ;width:50%;">
                <select id="ddETCO" name="ddETCO">
                    <option value="-" selected>N/A</option>
                    <option value="Intacto">Intacto</option>
                    <option value="Alterado">Alterado</option>
                </select>
                </td>
            </tr>
            <tr>
                <td style="text-align: left;border: none ;width:20%;"><label for="accionTomada">Acción Tomada</label></td>
                <td style="text-align: left;border: none ;width:20%;" colspan="3">
                    <textarea name="accionTomada" id="accionTomada" rows="4" cols="50"></textarea>
                
            </tr>
            <tr>
                <td style="text-align: left;border: none ;width:20%;"><label for="techRutina">Iniciales del Técnico</label></td>
                <td style="text-align: left;border: none ;width:20%;" colspan="3"><input type="text" id="techRutina" name="techRutina"></td>
            </tr>
            <tr>
                <td style="text-align: center;border:none;width:20%;" colspan="3">
                    <input type="submit" id="btnSubmit3" value="Someter">
                    <input type="button" id="btnCancel3" value="Cancel">
                </td><td style="text-align: left;border:none;"></td>
            </tr>
        </table>
    </form>
    </div>
</div>

<div id="MaskFitting" class="noprint content">
<div class="contentt">
    <tr>Registro de Paciente-Class/Mask Fitting - <a href="rpt.php?tb=Sleep_Registro_Paciente"><i class="fa-solid fa-file-lines fa-2x"></i></a></tr><hr></br>
    <form id="frmMaskFitting" action="rpt.php" target="rpt" method="post"><input type="hidden" value="Sleep_Registro_Paciente" name="tb">
        <table>
        </style>
            <tr>
                <td style="text-align: left;border: none ;width:20%;"><label for="nombreMask" class="lrequired">Nombre </label></td>
                <td style="text-align: left;border: none ;width:80%;"><input type="text" id="nombreMask" name="nombreMask" placeholder="Nombre" required></br></td>
            </tr>
            <tr>
                <td style="text-align: left;border: none ;width:20%;"><label for="apellidosMask" class="lrequired">Apellidos</label></td>
                <td style="text-align: left;border: none ;width:80%;"><input type="text" id="apellidosMask" name="apellidosMask" placeholder="Apellidos" required></br></td>
            </tr>
            <tr>
                <td style="text-align: left;border: none ;width:20%;"><label for="fechaMask" class="lrequired">Fecha</label></td>
                <td style="text-align: left;border: none ;width:80%;"><input type="date" id="fechaMask" name="fechaMask" value="'.date('Y-m-d').'" required></br></td>
            </tr>
            <tr>
                <td style="text-align: left;border: none ;width:20%;"><label for="ddPlanMedico">Plan Medico </label></td>
                <td style="text-align: left;border: none ;width:80%;">
                <select id="ddPlanMedico" name="ddPlanMedico">
                    <option value="SSS">SSS</option>
                    <option value="ASP" selected>Salud Plus</option>
                </select></td>    
            </tr>
            <tr>
                <td style="text-align: left;border: none ;width:20%;"><label for="ddProcedimiento1">Procedimiento</label></td>
                <td style="text-align: left;border: none ;width:80%;"><input type="text" id="ddProcedimiento1" name="ddProcedimiento1"></br></td>
                <!--<select id="ddProcedimiento1" name="ddProcedimiento1">
                    <option value="si">XXXXX</option>
                    <option value="no" selected>WWWWWWWWWW</option>
                </select></td> -->    
            </tr>
            <tr>
                <td style="text-align: left;border: none ;width:20%;"><label for="ddProcedimiento2">Otro Procedimiento</label></td>
                <td style="text-align: left;border: none ;width:80%;"><input type="text" id="ddProcedimiento2" name="ddProcedimiento2"></br></td>
            </tr>
            <tr>
                <td style="text-align: left;border: none ;width:20%;"><label for="mdRefiere" class="lrequired">Médico que refiere</label></td>
                <td style="text-align: left;border: none ;width:80%;"><input type="text" id="mdRefiere" name="mdRefiere" placeholder="Médico que refiere" required></br></td>
            </tr>
            <tr>
                <td style="text-align: center;border:none;width:20%;">
                    <input type="submit" id="btnSubmit3" value="Someter">
                    <input type="button" id="btnCancel3" value="Cancel">
                </td>
                <td style="text-align: left;border:none;"></td>
            </tr>
        </table>
    </form>
    </div>
</div>

<div id="ValCriticos" class="noprint content">
<div class="contentt">
    <tr> Valores Críticos - <a href="rpt.php?tb=Sleep_Valores_Criticos"><i class="fa-solid fa-file-lines fa-2x"></i></a></tr><hr></br>
    <form id="frmValCriticos" action="rpt.php" target="rpt" method="post"><input type="hidden" value="Sleep_Valores_Criticos" name="tb">
        <table>
        </style>
            <tr>
                <td style="text-align: left;border: none ;width:30%;"><label for="valExpediente">Técnico</label></td>
                <td style="text-align: left;border: none ;width:30%;"><input type="text" id="valExpediente" name="valExpediente" placeholder="Técnico" required></br></td>
                <td style="text-align: left;border: none ;width:30%;"></td>
                <td style="text-align: left;border: none ;width:30%;"></td>
            </tr>
            <tr>
                <td style="text-align: left;border: none ;width:30%;"><label for="valFecha">Fecha del evento</label></td>
                <td style="text-align: left;border: none ;width:30%;"><input type="datetime-local" name="valFecha" id="valFecha"></br></td>
                <td style="text-align: left;border: none ;width:30%;" colspan="2">
                <!--<input type="time" id="fecha">-->
                <label for="ddReferidoMD"></label></td>
            </tr>
            <tr>
                <td style="text-align: left;border: none ;width:30%;"><label for="valPaciente"># Paciente </label></td>
                <td style="text-align: left;border: none ;width:30%;"><input type="number" id="valPaciente" name="valPaciente" placeholder="# Paciente"></br></td>
                <td style="text-align: left;border: none ;width:30%;"></td>
                <td style="text-align: left;border: none ;width:30%;"></td>
            </tr>
            <tr>
                <td style="text-align: left;border: none ;width:30%;"><label for="valorCritico">Valor Crítico</label></td>
                <td style="text-align: left;border: none ;width:30%;"><input type="text" id="valorCritico" name="valorCritico" placeholder="Valor Crítico"></br></td>
                <td style="text-align: left;border: none ;width:30%;"></td>
                <td style="text-align: left;border: none ;width:30%;"></td>
            </tr>
            <tr>
                <td style="text-align: left;border: none ;width:30%;"><label for="repotadoa">A quién se reporta</label></td>
                <td style="text-align: left;border: none ;width:30%;"><input type="text" id="repotadoa" name="repotadoa"placeholder="A quién se reporta"></br></td>
                <td style="text-align: left;border: none ;width:30%;"></td>
                <td style="text-align: left;border: none ;width:30%;"></td>
            </tr>
            <tr>
                <td style="text-align: left;border: none ;width:30%;"><label for="valAccion">Acción que se tomo</label></td>
                <td style="text-align: left;border: none ;width:30%;"><input type="text" id="valAccion" name="valAccion" placeholder="Acción que se tomo"></br></td>
                <td style="text-align: left;border: none ;width:30%;"></td>
                <td style="text-align: left;border: none ;width:30%;"></td>
            </tr>
            <tr>
                <td style="text-align: left;border: none ;width:30%;"><label for="valReportado">Fecha reportado</label></td>
                <td style="text-align: left;border: none ;width:30%;"><input type="datetime-local" id="valReportado" name="valReportado"></br></td>
                <td style="text-align: left;border: none ;width:30%;" colspan="2">
                <!--<input type="time" id="fecha">-->
                <label for="ddReferidoMD"></label></td>
            </tr>
            <tr>
                <td style="text-align: center;border:none;width:30%;" colspan="3">
                    <input type="submit" id="btnSubmit3" value="Someter">
                    <input type="button" id="btnCancel3" value="Cancel">
                </td><td style="text-align: left;border:none;"></td>
            </tr>
        </table>
    </form>
    </div>
</div>

<div id="LogCPAP" class="noprint content">
<div class="contentt">
    <tr> Log de Auto CPAP Prestados - <a href="rpt.php?tb=Sleep_CPAP_Prestados"><i class="fa-solid fa-file-lines fa-2x"></i></a></tr><hr></br>
    <form id="frmLogCPAP" action="rpt.php" target="rpt" method="post"><input type="hidden" value="Sleep_CPAP_Prestados" name="tb">
        <table>
        </style>
            <tr>
                <td style="text-align: left;border: none ;width:30%;"><label for="exClinico"># Expediente clínico </label></td>
                <td style="text-align: left;border: none ;width:30%;"><input type="number" id="exClinico" name="exClinico" placeholder="# Expediente clínico"></br></td>
                <td style="text-align: left;border: none ;width:30%;"></td>
                <td style="text-align: left;border: none ;width:30%;"></td>
            </tr>
            <tr>
                <td style="text-align: left;border: none ;width:30%;"><label for="pTelefono">Telefono</label></td>
                <td style="text-align: left;border: none ;width:30%;"><input type="text" id="pTelefono" name="pTelefono" placeholder="Telefono" required></br></td>
                <td style="text-align: left;border: none ;width:30%;"></td>
                <td style="text-align: left;border: none ;width:30%;"></td>
            </tr>
            <tr>
                <td style="text-align: left;border: none ;width:30%;"><label for="fechaPrestado">Fecha y hora de prestado</label></td>
                <td style="text-align: left;border: none ;width:30%;"><input type="datetime-local" name="fechaPrestado" id="fechaPrestado" value="'.date('Y-m-d\TH:s').'"></br></td>
                <td style="text-align: left;border: none ;width:30%;" colspan="2">
                <!--<input type="time" id="fecha">-->
                <label for="ddReferidoMD"></label></td>
            </tr>
            <tr>
                <td style="text-align: left;border: none ;width:30%;"><label for="tecEntrega">Techico de entrega</label></td>
                <td style="text-align: left;border: none ;width:30%;"><input type="text" id="tecEntrega" name="tecEntrega" placeholder="Techico de entrega" required></br></td>
                <td style="text-align: left;border: none ;width:30%;"></td>
                <td style="text-align: left;border: none ;width:30%;"></td>
            </tr>
            <tr>
                <td style="text-align: left;border: none ;width:30%;"><label for="pago50">Pago $50.00</label></td>
                <td style="text-align: left;border: none ;width:30%;"><input type="text" id="pago50" name="pago50" placeholder="Pago $50.00"></br></td>
                <td style="text-align: left;border: none ;width:30%;"></td>
                <td style="text-align: left;border: none ;width:30%;"></td>
            </tr>
            <tr>
                <td style="text-align: left;border: none ;width:30%;"><label for="fecha_Entrega">Fecha y hora de entrega que el equipo debe ser entregado al Sleep Center</label></td>
                <td style="text-align: left;border: none ;width:30%;"><input type="datetime-local" name="fecha_Entrega" id="fecha_Entrega"></br></td>
                <td style="text-align: left;border: none ;width:30%;" colspan="2">
                <!--<input type="time" id="fecha">-->
                <label for="ddReferidoMD"></label></td>
            </tr>
            <tr>
                <td style="text-align: left;border: none ;width:30%;"><label for="techRecibe">Tecnico que recibe</label></td>
                <td style="text-align: left;border: none ;width:30%;"><input type="text" name="techRecibe" id="techRecibe" placeholder="Tecnico que recibe"></br></td>
                <td style="text-align: left;border: none ;width:30%;"></td>
                <td style="text-align: left;border: none ;width:30%;"></td>
            </tr>
            <tr>
                <td style="text-align: left;border: none ;width:30%;"><label for="fRecibe">Fecha y hora de recibe</label></td>
                <td style="text-align: left;border: none ;width:30%;"><input type="datetime-local" name="fRecibe" id="fRecibe"></br></td>
                <td style="text-align: left;border: none ;width:30%;" colspan="2">
                <!--<input type="time" id="fecha">-->
                <label for="ddReferidoMD"></label></td>
            </tr>
            <tr>
                <td style="text-align: left;border: none ;width:30%;"><label for="desinfecto">Desinfectó equipo</label></td>
                <td style="text-align: left;border: none ;width:30%;"><input type="text" id="desinfecto" name="desinfecto" placeholder="Desinfectó equipo"></br></td>
                <td style="text-align: left;border: none ;width:30%;"></td>
                <td style="text-align: left;border: none ;width:30%;"></td>
            </tr>            
            <tr>
                <td style="text-align: left;border: none ;width:30%;"><label for="cpapFecha">Fecha y hora</label></td>
                <td style="text-align: left;border: none ;width:30%;"><input type="datetime-local" id="cpapFecha" name="cpapFecha"></br></td>
                <td style="text-align: left;border: none ;width:30%;" colspan="2">
                <!--<input type="time" id="fecha">-->
                <label for="ddReferidoMD"></label></td>
            </tr>
            <tr>
                <td style="text-align: left;border: none ;width:30%;"><label for="ePrestado">Equipo prestado</label></td>
                <td style="text-align: left;border: none ;width:30%;">
                <select id="ePrestado" name="ePrestado">
                    <option value="I REMSTAR AUTO 560P (P125149222BDE)">I REMSTAR AUTO 560P (P125149222BDE)</option>
                    <option value="II REMSTAR AUTO 560P (P12514958C98C)" selected>II REMSTAR AUTO 560P (P12514958C98C)</option>
                </select></td>     
                <td style="text-align: left;border: none ;width:30%;"></td>
                <td style="text-align: left;border: none ;width:30%;"></td>
            </tr>           
            <tr>
                <td style="text-align: center;border:none;width:30%;" colspan="3">
                    <input type="submit" id="btnSubmit3" value="Someter">
                    <input type="button" id="btnCancel3" value="Cancel">
                </td><td style="text-align: left;border:none;"></td>
            </tr>
        </table>
    </form>
    </div>
</div>

<div id="logComunicacion" class="noprint content">
<div class="contentt">
    <tr> Log de Comunicación - <a href="rpt.php?tb=Sleep_Comunicacion"><i class="fa-solid fa-file-lines fa-2x"></i></a></tr><hr></br>
    <form id="frmlogComunicacion" action="rpt.php" target="rpt" method="post"><input type="hidden" value="Sleep_Comunicacion" name="tb">
        <table>
        </style>
            <tr>
                <td style="text-align: left;border: none ;width:20%;"><label for="tecComunicacion">Techico de entrega</label></td>
                <td style="text-align: left;border: none ;width:30%;"><input type="text" id="tecComunicacion" name="tecComunicacion" placeholder="Técnico de entrega" required></br></td>
                <td style="text-align: left;border: none ;width:40%;"></td>
            </tr>
            <tr>
                <td style="text-align: left;border: none ;width:20%;"><label for="comFecha">Fecha</label></td>
                <td style="text-align: left;border: none ;width:30%;"><input type="datetime-local" id="comFecha" name="comFecha"></br></td>
                <td style="text-align: left;border: none ;width:40%;" colspan="2">
            </tr>
            <tr>
                <td style="text-align: left;border: none ;width:20%;"><label for="comPrestado">Equipo prestado</label></td>
                <td style="text-align: left;border: none ;width:30%;">
                <select id="comPrestado" name="comPrestado">
                    <option value="si">DR</option>
                    <option value="no" selected>Dra</option>
                </select></td>     
                <td style="text-align: left;border: none ;width:40%;"></td>
            </tr>
            <tr>
                <td style="text-align: left;border: none ;width:20%;"><label for="comSituacion">Situación Presentada</label></td>
                <td style="text-align: left;border: none ;width:30%;"><textarea id="comSituacion" name="comSituacion"></textarea></br></td>
                <td style="text-align: left;border: none ;width:40%;"></td>
            </tr>
            <tr>
                <td style="text-align: center;border:none;width:20%;" colspan="3">
                    <input type="submit" id="btnSubmit3" value="Guardar">
                    <input type="button" id="btnCancel3" value="Cancelar">
                </td><td style="text-align: left;border:none;"></td>
            </tr>
        </table>
    </form>
    </div>
</div>

<div id="logRechazo" class="noprint content">
<div class="contentt">
    <tr> Rechazo de Tratamiento - <a href="rpt.php?tb=Sleep_Rechazo"><i class="fa-solid fa-file-lines fa-2x"></i></a></tr><hr></br>
    <form id="frmlogRechazo" action="rpt.php" target="rpt" method="post"><input type="hidden" value="Sleep_Rechazo" name="tb">
    <table>
        </style>
            <tr>
                <td style="text-align: left;border: none ;width:20%;"><label for="pacienteRechazo" class="lrequired">Nombre del Paciente *</label></td>
                <td style="text-align: left;border: none ;width:80%;"><input type="text" id="pacienteRechazo" name="pacienteRechazo" placeholder="Nombre del Paciente" required></br></td>
            </tr>
            <tr>
                <td style="text-align: left;border: none ;width:20%;"><label for="visitRechazo" class="lrequired">Visit ID *</label></td>
                <td style="text-align: left;border: none ;width:80%;"><input type="number" id="visitRechazo" name="visitRechazo" required></br></td>
            </tr>
            <tr>
                <td style="text-align: left;border: none ;width:20%;"><label for="fechaRechazo">Fecha del estudio</label></td>
                <td style="text-align: left;border: none ;width:80%;"><input type="date" id="fechaRechazo" name="fechaRechazo"></br></td>
            </tr>
            <tr>
                <td style="text-align: left;border: none ;width:20%;"><label for="razonRechazo" class="lrequired">Razón por la que rechazo *</label></td>
                <td style="text-align: left;border: none ;width:80%;"><textarea id="razonRechazo" name="razonRechazo" cols="50" rows="4" required></textarea></br></td>
            </tr>
            <tr>
                <td style="text-align: left;border: none ;width:20%;"><label for="techRechazo">Técnico</label></td>
                <td style="text-align: left;border: none ;width:80%;"><input type="text" id="techRechazo" name="techRechazo"></br></td>
            </tr>
            <tr>
                <td style="text-align: center;border:none;width:80%;" colspan="3">
                    <input type="submit" id="btnSubmit3" value="Guardar">
                    <input type="button" id="btnCancel3" value="Cancelar">
                </td><td style="text-align: left;border:none;"></td>
            </tr>
        </table>
    </form>
    </div>
</div>

<div id="solucionCidex" class="noprint content">
<div class="contentt">
    <tr> Registro de la Verificación de la Solución Cidex OPA e Inmersión del Equipo Durante el Proceso de Desinfección de Alto Nivel - <a href="rpt.php?tb=Sleep_Solucion_Cidex"><i class="fa-solid fa-file-lines fa-2x"></i></a></tr><hr></br>
    <form id="frmsolucionCidex" action="rpt.php" target="rpt" method="post"><input type="hidden" value="Sleep_Solucion_Cidex" name="tb">
    <table>
        </style>
            <tr>
                <td style="text-align: left;border: none ;width:20%;"><label for="fechaSolucion" class="lrequired">Fecha *</label></td>
                <td style="text-align: left;border: none ;width:80%;"><input type="date" name="fechaSolucion" value="'.date('Y-m-d').'"></br></td>
            </tr>
            <tr>
                <td style="text-align: left;border: none ;width:20%;"><label for="txtDept">Departamento</label></td>
                <td style="text-align: left;border: none ;width:80%;"><input type="text" name="txtDept" placeholder="Núm. Lote del Frasco de Tirillas"></td>
                <!--<select name="dept">
                    <option value="no" selected>Centro de Desórdenes de Sueño</option>
                    <option value="si">DDDDDD</option>
                </select></td> -->    
            </tr>
            <tr>
                <td style="text-align: left;border: none ;width:20%;"><label for="fechaFrasco">Fecha Abierto Frasco de Tirillas</label></td>
                <td style="text-align: left;border: none ;width:80%;"><input type="date" name="fechaFrasco"></br></td>
            </tr>            
            <tr>
                <td style="text-align: left;border: none ;width:20%;"><label for="fechaExpiracion">No Use Después de (FECHA)</label></td>
                <td style="text-align: left;border: none ;width:80%;"><input type="date" name="fechaExpiracion"></br></td>
            </tr>
            <tr>
                <td style="text-align: left;border: none ;width:20%;"><label for="numeroLote">Núm. Lote del Frasco de Tirillas</label></td>
                <td style="text-align: left;border: none ;width:80%;"><input type="text" name="numeroLote" placeholder="Núm. Lote del Frasco de Tirillas"></br></td>
            </tr>
            <tr>
                <td style="text-align: left;border: none ;width:20%;"><label for="ddPruebaRes">Resultados Pruebas de Calidad</label></td>
                <td style="text-align: left;border: none ;width:80%;">
                <select name="ddPruebaRes">
                    <option value="Falló" >Falló</option>
                    <option value="Pasó" selected>Pasó</option>
                </select></td>     
            </tr>
            <tr>
                <td style="text-align: left;border: none ;width:20%;"><label for="fechaCalidad">Fecha Pruebas de Calidad</label></td>
                <td style="text-align: left;border: none ;width:80%;"><input type="date" name="fechaCalidad"></br></td>
            </tr>
            <tr>
                <td style="text-align: left;border: none ;width:20%;"><label for="txtProbada" class="lrequired">Probada por *</label></td>
                <td style="text-align: left;border: none ;width:80%;"><input type="text" name="txtProbada"></br></td>
            </tr>
            <tr>
                <td style="text-align: left;border: none ;width:20%;"><label for="visitIdSolucion" class="lrequired">Visit ID del paciente *</label></td>
                <td style="text-align: left;border: none ;width:80%;"><input type="number" name="visitIdSolucion" required></br></td>
            </tr>
            <tr>
                <td style="text-align: left;border: none ;width:20%;"><label for="fechaComienzo">Fecha de Comienzo de la Solución</label></td>
                <td style="text-align: left;border: none ;width:80%;"><input type="date" name="fechaComienzo"></br></td>
            </tr>
            <tr>
                <td style="text-align: left;border: none ;width:20%;"><label for="fechaExpiraSolucion">Fecha de Expiración de la Solución</label></td>
                <td style="text-align: left;border: none ;width:80%;"><input type="date" name="fechaExpiraSolucion"></br></td>
            </tr>
            <tr>
                <td style="text-align: left;border: none ;width:20%;"><label for="fechaPrueba">Fecha y Hora de Prueba a la Solución</label></td>
                <td style="text-align: left;border: none ;width:80%;"><input type="datetime-local" name="fechaPrueba" value="'.date('Y-m-d\TH:s').'"></br></td>
            </tr>
            <tr>
                <td style="text-align: left;border: none ;width:20%;"><label for="cpapEquipo">Resultados de la Prueba de Concentración de la Solución</label></td>
                <td style="text-align: left;border: none ;width:80%;">
                <select name="cpapEquipo">
                    <option value="Pasó" selected>Pasó</option>
                    <option value="Falló">Falló</option>
                </select></td>     
            </tr>
            <tr>
                <td style="text-align: left;border: none ;width:20%;"><label for="solTemp">Temperatura de Solución Antes de Uso (20-37 Grados Celcius)</label></td>
                <td style="text-align: left;border: none ;width:80%;"><input type="text" name="solTemp"></br></td>
            </tr>
            <tr>
                <td style="text-align: left;border: none ;width:20%;"><label for="ddTurbidez">Ausencia de Turbidez</label></td>
                <td style="text-align: left;border: none ;width:80%;">
                <select name="ddTurbidez">
                    <option value="no" >No</option>
                    <option value="si" selected>Si</option>
                </select></td>     
            </tr>
            <tr>
                <td style="text-align: left;border: none ;width:20%;"><label for="ddMateria">Ausencia de Materia Orgánica</label></td>
                <td style="text-align: left;border: none ;width:80%;">
                <select name="ddMateria">
                    <option value="no" >No</option>
                    <option value="si" selected>Si</option>
                </select></td>     
            </tr>
            <tr>
                <td style="text-align: left;border: none ;width:20%;"><label for="txtCorrectivas">Acciones Correctivas (si necesarias)</label></td>
                <td style="text-align: left;border: none ;width:80%;"><input type="text" name="txtCorrectivas"></br></td>
            </tr>
            <tr>
                <td style="text-align: left;border: none ;width:20%;"><label>Descripción de Equipo</label></td>
                <td style="text-align: left;border: none ;width:80%;">        
                    <input type="checkbox" name="ckEquipo[]" id="ckElec" value="Electrodes">Electrodes<br>
                    <input type="checkbox" name="ckEquipo[]" id="ckHumi" value="Humidifier">Humidifier<br>
                    <input type="checkbox" name="ckEquipo[]" id="ckMask" value="Mask">Mask<br>
                    <input type="checkbox" name="ckEquipo[]" id="ckTube" value="Tubes">Tubes<br>
                </td>
            </tr>
            <tr>
                <td style="text-align: left;border: none ;width:20%;"><label for="fechaInmersion">Fecha y Hora de Comienzo de Inmersión</label></td>
                <td style="text-align: left;border: none ;width:80%;"><input type="datetime-local" name="fechaInmersion" value="'.date('Y-m-d\TH:s').'"></br></td>
            </tr>
            <tr>
                <td style="text-align: left;border: none ;width:20%;"><label for="tiempoInmersion">Tiempo de Inmersión (minutos)</label></td>
                <td style="text-align: left;border: none ;width:80%;"><input type="number" name="tiempoInmersion" value="12" width="5" max="60" min="0"></br></td>
            </tr>
            <tr>
                <td style="text-align: left;border: none ;width:20%;"><label for="txtLiqueo">Prueba de liqueo</label></td>
                <td style="text-align: left;border: none ;width:80%;"><input type="text" name="txtLiqueo"></br></td>
            </tr>
            <tr>
                <td style="text-align: left;border: none ;width:20%;"><label for="techPrueba">Nombre de quién realiza la prueba</label></td>
                <td style="text-align: left;border: none ;width:80%;"><input type="text" name="techPrueba"></br>
            </tr>
            <tr>
                <td style="text-align: left;border: none ;width:20%;"><label for="terminacion">Hora terminó la Inmersión</label></td>
                <td style="text-align: left;border: none ;width:80%;"><input type="time" name="terminacion"></br></td>
            </tr>
            <tr>
                <td style="text-align: center;border:none;width:20%;" >
                    <input type="submit" id="btnSubmit3" value="Guardar">
                    <input type="button" id="btnCancel3" value="Cancelar">
                </td><td style="text-align: left;border:none;"></td>
            </tr>
        </table>
    </form>
    </div>
</div>

<div id="frascoCIdex" class="noprint content">
<div class="contentt">
    <tr> Registro de Verificación de Frasco de Cidex OPA y Frasco de las Tirillas para las Pruebas Durante el Proceso de Desinfección de Alto Nivel - <a href="rpt.php?tb=Sleep_Frasco_Cidex"><i class="fa-solid fa-file-lines fa-2x"></i></a></tr><hr></br>
    <form id="frmfrascoCIdex" action="rpt.php" target="rpt" method="post"><input type="hidden" value="Sleep_Frasco_Cidex" name="tb">
    <table>
        </style>
            <tr>
                <td style="text-align: left;border: none ;width:20%;"><label for="fechaDePrueba" class="lrequired">Fecha de la Prueba</label></td>
                <td style="text-align: left;border: none ;width:80%;"><input type="date" id="fechaDePrueba" name="fechaDePrueba" value="'.date('Y-m-d').'"></br></td>
            </tr>
            <tr>
                <td style="text-align: left;border: none ;width:20%;"><label for="txtTemperatura" class="lrequired">Temperatura del cuarto de almacenaje (15-80 Grados Celsius)</label></td>
                <td style="text-align: left;border: none ;width:80%;"><input type="text" id="txtTemperatura" name="txtTemperatura">
            </tr>
            <tr>
                <td style="text-align: left;border: none ;width:20%;"><label for="loteFrasco">Num Lote del Frasco de la Solución</label></td>
                <td style="text-align: left;border: none ;width:80%;"><input type="text" name="loteFrasco" id="loteFrasco"></br></td>
            </tr>
            <tr>
                <td style="text-align: left;border: none ;width:20%;"><label for="frascoAbierto">Fecha Abierto Frasco de la solución</label></td>
                <td style="text-align: left;border: none ;width:80%;"><input type="date" id="frascoAbierto" name="frascoAbierto"></br></td>
            </tr>        
            <tr>
                <td style="text-align: left;border: none ;width:20%;"><label for="expiraSolucion">Fecha de Expiración de la solución (75 días)</label></td>
                <td style="text-align: left;border: none ;width:80%;"><input type="date" id="expiraSolucion" name="expiraSolucion"></br></td>
            </tr>            
            <tr>
                <td style="text-align: left;border: none ;width:20%;"><label for="loteTirillas">Núm. Lote del Frasco de Tirillas</label></td>
                <td style="text-align: left;border: none ;width:80%;"><input type="text" id="loteTirillas" name="loteTirillas" ></br></td>
            </tr>
            <tr>
                <td style="text-align: left;border: none ;width:20%;"><label for="abiertoTirillas">Fecha Abierto Frasco de Tirillas</label></td>
                <td style="text-align: left;border: none ;width:80%;"><input type="date" id="abiertoTirillas" name="abiertoTirillas"></br></td>
            </tr>            
            <tr>
                <td style="text-align: left;border: none ;width:20%;"><label for="expiraTirilla">Fecha de Expiración (Frasco de Tirillas)</label></td>
                <td style="text-align: left;border: none ;width:80%;"><input type="date" id="expiraTirilla" name="expiraTirilla" ></br></td>
            </tr>
            <tr>
                <td style="text-align: left;border: none ;width:20%;"><label for="ddResultadoTirilla1">1. Resultado Prueba de las Tirillas con Cidex OPA (PURO)</label></td>
                <td style="text-align: left;border: none ;width:80%;">
                <select id="ddResultadoTirilla1" name="ddResultadoTirilla1">
                    <option value="Falló">Falló</option>
                    <option value="Pasó" selected>Pasó</option>
            </select></td>     
            </tr>
            <tr>
                <td style="text-align: left;border: none ;width:20%;"><label for="ddResultadoTirilla2">2. Resultado Prueba de las Tirillas con Cidex OPA (PURO)</label></td>
                <td style="text-align: left;border: none ;width:80%;">
                <select id="ddResultadoTirilla2" name="ddResultadoTirilla2">
                    <option value="Falló">Falló</option>
                    <option value="Pasó" selected>Pasó</option>
                </select></td>     
            </tr>
            <tr>
                <td style="text-align: left;border: none ;width:20%;"><label for="ddResultadoTirilla3">3. Resultado Prueba de las Tirillas con Cidex OPA (PURO)</label></td>
                <td style="text-align: left;border: none ;width:80%;">
                <select id="ddResultadoTirilla3" name="ddResultadoTirilla3">
                    <option value="Falló">Falló</option>
                    <option value="Pasó" selected>Pasó</option>
            </select></td>     
            </tr>
            <tr>
                <td style="text-align: left;border: none ;width:20%;"><label for="ddResultadoDiluido1">1. Resultado Prueba de las Tirillas con Cidex OPA (DILUIDO)</label></td>
                <td style="text-align: left;border: none ;width:80%;">
                <select id="ddResultadoDiluido1" name="ddResultadoDiluido1">
                    <option value="Falló">Falló</option>
                    <option value="Pasó" selected>Pasó</option>
            </select></td>     
            </tr>
            <tr>
                <td style="text-align: left;border: none ;width:20%;"><label for="ddResultadoDiluido2">2. Resultado Prueba de las Tirillas con Cidex OPA (DILUIDO)</label></td>
                <td style="text-align: left;border: none ;width:80%;">
                <select id="ddResultadoDiluido2" name="ddResultadoDiluido2">
                    <option value="Falló">Falló</option>
                    <option value="Pasó" selected>Pasó</option>
            </select></td>     
            </tr>
            <tr>
                <td style="text-align: left;border: none ;width:20%;"><label for="ddResultadoDiluido3">3. Resultado Prueba de las Tirillas con Cidex OPA (DILUIDO)</label></td>
                <td style="text-align: left;border: none ;width:80%;">
                <select id="ddResultadoDiluido3" name="ddResultadoDiluido3">
                    <option value="Falló">Falló</option>
                    <option value="Pasó" selected>Pasó</option>
                </select></td>     
            </tr>
            <tr>
                <td style="text-align: left;border: none ;width:20%;"><label for="txtAccionesCorrectivas">Acciones Correctivas necesarias</label></td>
                <td style="text-align: left;border: none ;width:80%;"><input type="text" id="txtAccionesCorrectivas" name="txtAccionesCorrectivas"></br></td>
            </tr>
            <tr>
                <td style="text-align: left;border: none ;width:20%;"><label for="techTest">Quien realiza la prueba o abre el frasco?</label></td>
                <td style="text-align: left;border: none ;width:80%;"><input type="text" id="ddAbreFrasco" name="techTest"></br></td>
            </tr>
            <tr>
                <td style="text-align: left;border: none ;width:20%;"><label for="expiracionSolucion" class="lrequired">Fecha de expiración del frasco de la solución</label></td>
                <td style="text-align: left;border: none ;width:80%;"><input type="date" id="expiracionSolucion" name="expiracionSolucion"></br></td>
            </tr>   
            <tr>
                <td style="text-align: left;border: none ;width:20%;"><label for="expiracionTirillas">Fecha de expiración del frasco de tirillas</label></td>
                <td style="text-align: left;border: none ;width:80%;"><input type="date" id="expiracionTirillas" name="expiracionTirillas"></br></td>
            </tr>   
            <tr>
                <td style="text-align: center;border:none;width:20%;">
                    <input type="submit" id="btnSubmit3" value="Guardar">
                    <input type="button" id="btnCancel3" value="Cancelar">
                </td><td style="text-align: left;border:none;"></td>
            </tr>
        </table>
    </form>
    </div>
</div>

<div id="CPAP" class="noprint content">
<div class="contentt">
    <tr> Desinfeccion CPAP - <a href="rpt.php?tb=Sleep_Desinfeccion_CPAP"><i class="fa-solid fa-file-lines fa-2x"></i></a></tr><hr></br>
    <form id="frmCPAP" action="rpt.php" target="rpt" method="post"><input type="hidden" value="Sleep_Desinfeccion_CPAP" name="tb">
    <table>
        </style>
            <tr>
                <td style="text-align: left;border: none ;width:20%;"><label for="fechaDesinfeccion" class="lrequired">Fecha de desinfección</label></td>
                <td style="text-align: left;border: none ;width:80%;"><input type="date" name="fechaDesinfeccion"></br></td>
            </tr>
            <tr>
                <td style="text-align: left;border: none ;width:20%;"><label for="DesinfeccionFiltro">Fecha de desinfección de filtro</label></td>
                <td style="text-align: left;border: none ;width:80%;"><input type="date" name="DesinfeccionFiltro"></br></td>
            </tr>
            <tr>
                <td style="text-align: left;border: none ;width:20%;"><label for="CambioFiltro">Fecha de cambio de filtro</label></td>
                <td style="text-align: left;border: none ;width:80%;"><input type="date" name="CambioFiltro"></br></td>
            </tr>
            <tr>
                <td style="text-align: left;border: none ;width:20%;"><label for="ddCama" class="lrequired">Cama</label></td>
                <td style="text-align: left;border: none ;width:80%;">
                <input type="checkbox" name="ckCamas[]" value="1">1
                <input type="checkbox" name="ckCamas[]" value="2">2
                <input type="checkbox" name="ckCamas[]" value="3">3
                <input type="checkbox" name="ckCamas[]" value="4">4
                <input type="checkbox" name="ckCamas[]" value="5">5
                <input type="checkbox" name="ckCamas[]" value="6">6
                <input type="checkbox" name="ckCamas[]" value="7">7
                <input type="checkbox" name="ckCamas[]" value="8">8
                <input type="checkbox" name="ckCamas[]" value="9">9
                <input type="checkbox" name="ckCamas[]" value="10">10
                <input type="checkbox" name="ckCamas[]" value="11">11
                <input type="checkbox" name="ckCamas[]" value="12">12
            </tr>
            <tr>
                <td style="text-align: left;border: none ;width:20%;"><label for="txtTecnico" class="lrequired">Nombre del Técnico</label></td>
                <td style="text-align: left;border: none ;width:80%;"><input type="text" name="txtTecnico" required></br></td>
            </tr>
            <tr>
                <td style="text-align: center;border:none;width:20%;">
                    <input type="submit" id="btnSubmit3" value="Guardar">
                    <input type="button" id="btnCancel3" value="Cancelar">
                </td><td style="text-align: left;border:none;"></td>
            </tr>
        </table>
    </form>
    </div>
</div>

<div id="ETCO2" class="noprint content">
<div class="contentt">
    <tr> Desinfeccion ETCO2 - <a href="rpt.php?tb=Sleep_ETCO"><i class="fa-solid fa-file-lines fa-2x"></i></a></tr><hr></br>
    <form id="frmETCO2" action="rpt.php" target="rpt" method="post"><input type="hidden" value="Sleep_ETCO" name="tb">
    <table>
        </style>
            <tr>
                <td style="text-align: left;border: none ;width:20%;"><label for="etcoDesinfeccion">Fecha de desinfección</label></td>
                <td style="text-align: left;border: none ;width:80%;"><input type="date" name="etcoDesinfeccion"></br></td>
            </tr>
            <tr>
                <td style="text-align: left;border: none ;width:20%;"><label for="etcoTecnico" class="lrequired">Nombre del Técnico</label></td>
                <td style="text-align: left;border: none ;width:80%;"><input type="text" name="etcoTecnico" required></br></td>
            </tr>
            <tr>
                <td style="text-align: left;border: none ;width:20%;"><label for="etcoModelo" class="lrequired">Modelo</label></td>
                <td style="text-align: left;border: none ;width:80%;"><!--<input type="text" name="etcoModelo"></br></td>-->
                <input type="radio" name="etcoModelo" id="radio1" value="I Resp Sense LS1R-9R-MMHG (#serie 590000107)"><label for="radio1">I Resp Sense LS1R-9R-MMHG (#serie 590000107)</label></br>
                <input type="radio" name="etcoModelo" id="radio2" value="II Resp Sense LS1R-9R (#serie 501967844)"><label for="radio2">II Resp Sense LS1R-9R (#serie 501967844)</option>
                  <!--  <option value="II Resp Sense LS1R-9R (#serie 501967844)">II Resp Sense LS1R-9R (#serie 501967844)</option>
                </select></td> -->    
            </tr>
            <tr>
                <td style="text-align: center;border:none;width:20%;" colspan="3">
                    <input type="submit" id="btnSubmit3" value="Guardar">
                    <input type="button" id="btnCancel3" value="Cancelar">
                </td><td style="text-align: left;border:none;"></td>
            </tr>
        </table>
    </form>
    </div>
</div>

<div id="DuchasOjos" class="noprint content">
<div class="contentt">
    <tr> Duchas de lavado de ojos - <a href="rpt.php?tb=Sleep_Ojos"><i class="fa-solid fa-file-lines fa-2x"></i></a></tr><hr></br>
    <form id="frmDuchasOjos" action="rpt.php" target="rpt" method="post"><input type="hidden" value="Sleep_Ojos" name="tb">
    <table>
            <tr>
                <td style="text-align: left;border: none ;width:20%;"><label for="fechaDucha">Fecha de lavado</label></td>
                <td style="text-align: left;border: none ;width:80%;"><input type="datetime-local" name="fechaDucha" value="'.date('Y-m-d\TH:s').'"></br></td>
            </tr>
            <tr>
                <td style="text-align: left;border: none ;width:20%;"><label for="tecDucha" class="lrequired">Nombre del Técnico</label></td>
                <td style="text-align: left;border: none ;width:80%;"><input type="text" name="tecDucha" required></br></td>
            </tr>
            <tr>
                <td style="text-align: center;border:none;width:20%;" colspan="3">
                    <input type="submit" id="btnSubmit3" value="Guardar">
                    <input type="button" id="btnCancel3" value="Cancelar">
                </td><td style="text-align: left;border:none;"></td>
            </tr>
        </table>
    </form>
    </div>
</div>

<div id="UsoManejo" class="noprint content">
<div class="contentt">
    <tr> Uso y Manejo de Endozime AW Plus - <a href="rpt.php?tb=Sleep_Endozime"><i class="fa-solid fa-file-lines fa-2x"></i></a></tr><hr></br>
    <form id="frmUsoManejo" action="rpt.php" target="rpt" method="post"><input type="hidden" value="Sleep_Endozime" name="tb">
    <table>
        </style>
            <tr>
                <td style="text-align: left;border: none ;width:20%;"><label for="fechaPreparacion" class="lrequired">Fecha y Hora de Preparación</label></td>
                <td style="text-align: left;border: none ;width:80%;"><input type="datetime-local" id="fechaPreparacion" name="fechaPreparacion"></br></td>
            </tr>
            <tr>
                <td style="text-align: left;border: none ;width:20%;"><label for="expiracionEndozime">Fecha de Expiración</label></td>
                <td style="text-align: left;border: none ;width:80%;"><input type="date" name="expiracionEndozime"></br></td>
            </tr>
            <tr>
                <td style="text-align: left;border: none ;width:20%;"><label for="tempEndozime">Temperatura del cuarto de almacenaje 15 a 80 grados C</label></td>
                <td style="text-align: left;border: none ;width:80%;"><input type="text" name="tempEndozime" required></br></td>
            </tr>
            <tr>
                <td style="text-align: left;border: none ;width:20%;"><label for="etcoTecnico" class="lrequired">Nombre del Técnico</label></td>
                <td style="text-align: left;border: none ;width:80%;"><input type="text" name="etcoTecnico" required></br></td>
            </tr>
            <tr>
                <td style="text-align: center;border:none;width:20%;">
                    <input type="submit" id="btnSubmit3" value="Guardar">
                    <input type="button" id="btnCancel3" value="Cancelar">
                </td><td style="text-align: left;border:none;"></td>
            </tr>
        </table>
    </form>
    </div>
</div>

<div id="Buscador" class="content">
<div class="contentt">
<div id="head" class="noprint">
    <form id="frmSearch" methop="post"><input type="hidden" name="opt" value="2">
    <table style="margin-left: auto;margin-right: auto;border-collapse: collapse;">
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
        <tr><td></td><td><button type="submit" id="btnBuscar" style="border:none;background:none;color:red;"><i class="fa-solid fa-magnifying-glass fa-lg"></i></button>
        <button class="noprint" style="border:none;background:none;color:red;" alt="Print" onclick="javascript:closeNav();window.print();">
            <i class="fa-solid fa-print fa-lg"></i>
        </button></td></tr>
    </table>
    </p>
    </form>
</div>
<div id="resultados"></div>
</div>
</div>

';
