<!DOCTYPE html>
<?php
date_default_timezone_set("America/Puerto_Rico");
header('Content-Type: text/html; charset=utf-8');
ini_set('display_errors',0);
ini_set('log_errors',0);
error_reporting(E_ALL & ~E_NOTICE);
session_start();
require_once("cno.php");
require_once("ctrlDB.php");
require_once("funcs.php");
include('header.php');
/********************************************
 * Danny Monzon
 * 20210909
 ********************************************/
// if (!isset($_SESSION['user_name'])) {
//     header('location:logout.php');
//     exit();
// }
$dia = false;
if($_POST){
    // var_dump($_POST);
    @$dia = $_POST['ddPeriod'] ;
    @$opt = $_POST['opt'];
    switch ($opt) {
        case 'newE':
            newEmployee($_POST);
            break;
        default:
            # code...
            break;
    }
}
// dia variable para filtrar en las busquedas  dia2 para mostrar en el textbox
if(!$dia) $dia = date("Y-m-d");
$dia2 = date("d/m/Y");
?>
<head>
    <meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="w.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <link href="jquery-ui.css" rel="stylesheet">
    <script src="https://kit.fontawesome.com/2a9ceb1fca.js" crossorigin="anonymous"></script>
    <script src="altas.js"></script>
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
<title>Altas</title>
</head>
<body><meta name="viewport" content="width=device-width, initial-scale=1">
    <div id="main">
        <div id="forma" class="divx">
            <!-- getAltasDet($date = null,$id = 0,$opt=1) -->
            <?php echo getAltasDet($dia,0,1);?>
                    <tr>
                        <th colspan="12">
                            <!-- <form> -->
                                <button type="submit" disabled style="display: none" aria-hidden="true"></button>
                                <!-- <input type="submit" value="Salvar"/> -->
                                <button type="submit" form="main2" value="Submit" style="background-color: #FFF7F9; border: none;" onclick="return confirm('Are you sure you want to submit this form?');"><i class="far fa-save fa-3x"></i></button>
                            <!-- </form> -->
                        </th>
                    </tr>
                </table>
    <!----------------------------------------------------------------------------------------------------------> 
    <!---------------------------------------------- empleados -------------------------------------------------> 
    <!----------------------------------------------------------------------------------------------------------> 
    </div>    
    <div id="empleados"> 
        <table>                
            <tr><th colspan="3"><a href="#activateEmpModal" class="edit" data-toggle="modal"><i class="fas fa-user-alt"></i> Edit</a></th></tr>
            <tr>
                <th>Manejadores disponibles</th>
                <th>Revision</th>
                <th>Planificacion</th>
            </tr>
            <?php getEmpTotalDet($date);?>
        <!-- </table> -->
        </form>
        </div> <!--div empleados-->
            <!----------------------------------------------------------------------------------------------------------> 
            <!------------------------------------------- listado de ausencias -----------------------------------------> 
            <!----------------------------------------------------------------------------------------------------------> 
            <div id="ausencias" style="float: left; width: 30%; padding-top: 10px;">
                <table>
                    <tr class="noprint">
                        <th>Ausencias <a href="#VacModal" class="edit" data-toggle="modal"><i class="far fa-calendar-plus fa-md"></i></a></th>
                        <th>Razón</th>
                        <th>Desde</th><th>Hasta</th>
                    </tr>
                    <?php
                        $db = new ServidorBD();
                        $conn = $db->Conectar('a');
                        $sql = "SELECT d.[id],d.[id_Ausencia],a.Ausencia,d.[Desde],d.[Hasta],d.[id_Empleado],e.nombre
                            FROM [WebReports].[dbo].[Utilizacion_AusenciasDet] d
                            left join [Utilizacion_Ausencias] a on d.id_Ausencia = a.id
                            left join [Utilizacion_Empleados] e on e.id = d.id_Empleado
                            where '$date' between Desde and Hasta";
                        $res = sqlsrv_query($conn,$sql);
                        if($res){
                            $rows = sqlsrv_has_rows( $res );
                            if ($rows === true){
                                while ($row = sqlsrv_fetch_array($res, SQLSRV_FETCH_ASSOC)){
                                    $name = $row['nombre'];
                                    $ausent = $row['Ausencia'];
                                    $dia = $row['Hasta'];
                                    echo '<tr class="noprint">
                                    <td style="text-align: left;">'.$name.'</td>
                                    <td style="text-align: left;">'.$ausent.'</td>
                                    <td>'.$row['Desde']->format('Y-m-d').'</td><td>'.$row['Hasta']->format('Y-m-d').'</td></tr>';
                                }
                            }else{
                                echo '<tr><td colspan="4">No hay ausentes.</td></tr>';
                            }
                        }
                        $db->Desconectar();
                    ?>
                </table>
            </div> <!-- end div ausencias -->
            <div id="newEmp" name="newEmp" style="float: left; width: 30%; padding-top: 10px; padding-left: 10px;">
                <form id="fNewEmp" action="altas.php" target="_self" method="post">
                    <table><tr><th>Crear Empleado</th></tr><td><input type="text" name="nombre" id="nombre" placeholder="Nombre del empleado" required>
                        <input type="checkbox" name="active" id="active" checked><label for="chkEmp">Active</label></td>
                        <tr><th><input type="hidden" name="opt" value="newE"><input type="submit" value="Crear"></th></tr>
                    </table>
                </form>
            </div>
        </div>
        <div id="enabler" class="mystyle">
            <?php
                require_once('cno.php');
                $db = new ServidorBD();
                $conn = $db->Conectar('x');

                $sql = 'SELECT * from Utilizacion_Empleados order by nombre';
                $res = sqlsrv_query($conn, $sql, array(), array( "Scrollable" => SQLSRV_CURSOR_KEYSET ));
                $html = '';

                while ($r = sqlsrv_fetch_array($res, SQLSRV_FETCH_ASSOC)) {
                    $id = $r['id'];
                    //($r['Active']) ? $a = 'selected' : $i = 'selected' ;
                    $html .= '<form id="frmEmul'.$id.'" name="frmEmul'.$id.'" method="POST" action="altas.php">
                    <input type="hidden" id="id" name="id" value="'.$id.'">
                    <input type="text" id="nombre" name="nombre" value="'.$r['nombre'].'"/>
                    <!--<input type="checkbox" name="active'.$id.'" >-->
                    <input type="radio" id="oactive1" name="active" value="1" '.($r['Active'] == 1 ? 'checked' : '').'>
                    <label for="oactive1">On</label>
                    <input type="radio" id="oactive2" name="active" value="0" '.($r['Active'] == 0 ? 'checked' : '').'>
                    <label for="oactive2">Off</label></td>
                    <button id="btn'.$id.'" class="dentro">actualizar</button>
                    <input type="hidden" name="opt" value="newE"></form>';
                }
                $html .= '</br>';
                echo $html;
            ?>
            <input type="submit" name="btnSometer" value="Guardar">
            <input type="button" name="btnCancel" value="Cancelar" onclick="myFunction()">
            
        </div>
        </div>
    </div><!--div main-->
    <!----------------------------------------------------------------------------------------------------------> 
    <!---------------------------------------- activar/editar empleados ----------------------------------------> 
    <!----------------------------------------------------------------------------------------------------------> 
    <div id="activateEmpModal" class="modal fade">
		<div class="modal-dialog">
			<div class="modal-content">
					<div class="modal-header">						
						<h4 class="modal-title">Activar empleado</h4>
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
					</div>
					<div class="modal-body">
                        <?php
                            require_once('cno.php');
                            $db = new ServidorBD();
                            $conn = $db->Conectar('x');
                            $sql = 'SELECT [id],[nombre],[Active] from Utilizacion_Empleados where active = 0 order by nombre';
                            $res = sqlsrv_query($conn, $sql, array(), array( "Scrollable" => SQLSRV_CURSOR_KEYSET ));
                            $html = '';
            
                            while ($r = sqlsrv_fetch_array($res, SQLSRV_FETCH_ASSOC)) {
                                $id = $r['id'];
                                //($r['Active']) ? $a = 'selected' : $i = 'selected' ;
                                // $html .= '<form id="frmE'.$id.'">
                                $html .= '<form id="frmActivar" name="frmActivar">
                                <input type="hidden" id="empid'.$id.'" name="empid'.$id.'" value="'.$id.'" size="5">
                                <input type="text" id="nombre'.$id.'" name="nombre'.$id.'" value="'.$r['nombre'].'"/>
                                <input type="radio" id="oactive1" name="eactive'.$id.'" value="1" '.($r['Active'] == 1 ? 'checked' : '').'>
                                <label for="oactive1">Activar</label>
                                <input type="radio" id="oactive2" name="eactive'.$id.'" value="0" '.($r['Active'] == 0 ? 'checked' : '').'>
                                <label for="oactive2">Desactivar</label></td>
                                <button id="btn'.$id.'" class="dentro actual">Actualizar</button>
                                <input type="hidden" name="opt" value="acEmp"></form>';
                            }
                            $html .= '</br>';
                            echo $html;
                        ?>
					</div>
					<div class="modal-footer">
						<input type="button" class="btn btn-default" data-dismiss="modal" value="Done">
					</div>
			</div>
		</div>
	</div>
    <!----------------------------------------------------------------------------------------------------------> 
    <!-------------------------------------------- editar empleado ---------------------------------------------> 
    <!----------------------------------------------------------------------------------------------------------> 
    <div id="editEmployeeModal" class="modal fade">
		<div class="modal-dialog">
			<div class="modal-content">
                <div class="modal-header">						
                    <h4 class="modal-title">Activar empleado</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <div class="modal-body">
                    <form id="frmEmp"><!-- action="employees.php" method="post" target="_blank">-->
                        <input type="hidden" id="hempid" name="hempid" value="">
                        <input type="text" size="35" id="ename" name="ename" value=""/>
                        <input type="radio" id="oactive1" name="eactive" value="1">
                        <label for="ractive1">Activar</label>
                        <input type="radio" id="oactive2" name="eactive" value="0">
                        <label for="ractive2">Desactivar</label></td>
                        <button id="btn" class="dentro salvar">Actualizar</button>
                        <input type="hidden" name="opt" id="opta" value="edEmp"></form>
                        </br>
                    </form>
                </div>
                <div class="modal-footer">
                    <input type="button" class="btn btn-default" data-dismiss="modal" value="Done">
                </div>
			</div>
		</div>
	</div>
    <!----------------------------------------------------------------------------------------------------------> 
    <!------------------------------------------- registro de ausencias ----------------------------------------> 
    <!----------------------------------------------------------------------------------------------------------> 
    <div id="VacModal" class="modal fade">
		<div class="modal-dialog">
			<div class="modal-content">
                <div class="modal-header">						
                    <h4 class="modal-title">Registrar ausencias</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <div class="modal-body">
                    <form id="frmEAu"><table style="border:0px;"><input type="hidden" name="opt" id="optb" value="regAu"><!--gddEmployees($dname,$id,$clase,$unidad-->
                        <tr><td style="text-align: left;border:0px;">Empleado:</td><td style="text-align: left;border:0px;"><?php echo gddEmployees("empida",0,'ddausencia','') ?></td></tr>
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
			</div>
		</div>
	</div>
</body>
<script>
    $(document).inactivityTimeout();    
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
