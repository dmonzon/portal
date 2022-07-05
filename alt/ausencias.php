<?php
ini_set('display_errors',0);
ini_set('log_errors',0);
error_reporting(E_ALL & ~E_NOTICE);
session_start();
require_once("cno.php");
require_once("ctrlDB.php");
require_once("funcs.php");
include('header.php');
?>
   <div class="modal-header">						
    <h4 class="modal-title">Registrar ausencias</h4>
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
</div>
<div class="modal-body">
    <form id="frmEAu" action="employees.php" target="_blank" method="POST"><table style="border:0px;"><input type="hidden" name="opt" id="opt" value="regAu"><!--gddEmployees($dname,$id,$clase,$unidad-->
        <tr><td style="text-align: left;border:0px;">Empleado:</td><td style="text-align: left;border:0px;"><?php echo gddEmployees("empid",0,'ddausencia','') ?></td></tr>
        <tr><td style="text-align: left;border:0px;">Desde:</td><td style="text-align: left;border:0px;"><input type="date" id="desde" name="desde" value="<?php $dia;?>" required/></td></tr>
        <tr><td style="text-align: left;border:0px;">Hasta:</td><td style="text-align: left;border:0px;"><input type="date" id="hasta" name="hasta" value="<?php $dia;?>" required/></td></tr>
        <tr><td style="text-align: left;border:0px;">Razon:</td><td style="text-align: left;border:0px;"><?php echo gddAusencias() ?></td></tr>
        <tr><td colspan="2" style="border:0;text-align: right;">
        <button id="btn2" class="register">Registrar</button>
        <!--<button id="btn" class="reportar" style="border:0; background-color: none;"><i class="far fa-save fa-2x"></i></button>-->
        </td></tr>
        </table>
    </form></br>
</div>
<div class="modal-footer">
    <input type="button" class="btn btn-default" data-dismiss="modal" value="Done">
    <!--<button type="button" class="btn btn-default" id="done" data-dismiss="modal">Done</button>-->
</div>
<?php

?>