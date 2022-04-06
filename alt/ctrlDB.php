<?php
date_default_timezone_set("America/Puerto_Rico");
header('Content-Type: text/html; charset=utf-8');
// funcion para buscar empleado por id
function gUtilEmployee($str){
    if($str > 0){
        $db = new ServidorBD;
        $conn = $db->Conectar('a');
        $tsql = 'SELECT nombre FROM [Utilizacion_Empleados] where [id] =?';
        $res = sqlsrv_query( $conn, $tsql,array($str));
        // echo "</br>$tsql$str</br>";
        if (!$res) die( "<pre>" . print_r( sqlsrv_errors(). "</pre>", true));
        if( $res === false )
        {  
            echo "Error in statement preparation/execution.\n";  
            die( print_r( sqlsrv_errors(), true));  
        }
        /* Make the first row of the result set available for reading. */  
        if( sqlsrv_fetch( $res ) === false)  
        {  
            echo "Error in retrieving row.\n";  
            die( print_r( sqlsrv_errors(), true));  
        }
        $name = sqlsrv_get_field( $res, 0);
    }else{
        $name = 'Sin asignar';
    }
    return $name;
}

function setBGColor($qty){
    $minPacientes = 25;
    $maxPacientes = 30;
    switch(true){
        case ($qty > $maxPacientes):
            $style = 'background-color:red;';
        break;
        case ($qty >= $minPacientes && $qty <= $maxPacientes):
            $style = 'background-color:gold;';
         break;
        case ($qty < $minPacientes && $qty > 0):
            $style = 'background-color:green;';
        break;
        default:
            $style = 'background-color:lightgray;';
        break;
    }
    return $style;
}
// funcion para obtener las altas registradas de un dia 
function getAltas($dia){
    require_once("cno.php");
    $db = new ServidorBD;
    $conn = $db->Conectar('a');
    $tsql = 'SELECT [id],[Dia],[Created],[Usuario] FROM [WebReports].[dbo].[Utilizacion_Altas] where Dia = ? order by Created desc';
    $getResults = sqlsrv_query($conn, $tsql, array($dia));
    if (@!$getResults) {
        die( "<pre>" . print_r( sqlsrv_errors(). "</pre>", true)); ;
    }
    $html='<table><tr class="noprint"><td style="text-align:left;border:0">';
    while ($row = sqlsrv_fetch_array($getResults, SQLSRV_FETCH_ASSOC)){
        $html .= '</br><a href="altas2.php?a='.$row['id'].'">'.date_format($row['Created'],'Y-m-d H:i:s').' - '.$row['Usuario']. '</a>';
    }
    $html .= '</tr></td></table>';
    return $html;
}
// obtener la ultima alta del dia especificado
function getLastAltas($dia){
    require_once("cno.php");
    $db = new ServidorBD;
    $conn = $db->Conectar('a');
    $tsql = 'SELECT max(id) FROM [Utilizacion_Altas] where Dia = ?';
    $getResults = sqlsrv_query($conn, $tsql, array($dia));
    if (!$getResults) {
        die( "<pre>" . print_r( sqlsrv_errors(). "</pre>", true)); ;
    }
    if ( sqlsrv_fetch( $getResults ) )  
    {  
        $id = sqlsrv_get_field( $getResults, 0);  
    }  
    else  
    {  
        echo "Error in retrieving data.</br>";  
        die(print_r( sqlsrv_errors(), true));  
    } 
    return $id;
}
// funcion para definir el formato de los text de los manejadores
function setManStyle($qty){
    // asigna color de las cajas de los manejadores
    $minPacientes = 25;
    $maxPacientes = 30;
    switch(true){
        case ($qty > $maxPacientes):
            $style = 'width: 40px;background-color:red;color:white'; //$color = "red";$fontc = 'white';$bg = 'red';
        break;
        case ($qty >= $minPacientes && $qty <= $maxPacientes):
            $style = 'width: 40px;background-color:gold;color:black'; //$color = "gold";$fontc = 'black';$bg = 'gold';
         break;
        case ($qty < $minPacientes):
            $style = 'width: 40px;background-color:default;color:black'; //$color =  "green";$fontc = 'black';$bg = 'white';
        break;
    }
    return $style;
}
// funcion para definir el formato de los text de los planificadores
function setPlanStyle($qty){
    // asigna color de las cajas de los planificadores
    $minPacientes = 40;
    $maxPacientes = 50;
    switch(true){
        case ($qty > $maxPacientes):
            $style = 'width: 40px;background-color:red;color:white'; //$color = "red";$fontc = 'white';$bg = 'red';
        break;
        case ($qty >= $minPacientes && $qty <= $maxPacientes):
            $style = 'width: 40px;background-color:gold;color:black'; //$color = "gold";$fontc = 'black';$bg = 'gold';
         break;
        case ($qty < $minPacientes):
            $style = 'width: 40px;background-color:default;color:black'; //$color =  "green";$fontc = 'black';$bg = 'white';
        break;
    }
    return $style;
}

function getAltasDet($date = null,$id = 0,$opt = 1){
    $db = new ServidorBD();
    $conn = $db->Conectar('a');
    if($date === null) $date = date('Y-m-d') ;
    sqlsrv_configure('WarningsReturnAsErrors',0);
    $sql = "{call spAltas(?,?)}";
    $params = array($id,$date);
    if (!$res = sqlsrv_prepare($conn, $sql, $params)) {
        echo "Statement could not be prepared.\n";
        die(print_r(sqlsrv_errors(), true));  
    } 
    if( sqlsrv_execute( $res ) === false ) {
        die( print_r( sqlsrv_errors(), true));
    }
    $btn = '<i class="far fa-eye fa-2x"></i>';
    $html='';
    while ($row = sqlsrv_fetch_array($res, SQLSRV_FETCH_ASSOC)){
        $id = $row['id'];
        //cantidades de pacientes por manejador
        ($row['Empleado1'] > 0) ? $eid1 = $row['Empleado1'] : $eid1 = '';
        ($row['Empleado2'] > 0) ? $eid2 = $row['Empleado2'] : $eid2 = '';
        ($row['Planificador1'] > 0) ? $eid3 = $row['Planificador1'] : $eid3 = '';
        ($row['Planificador2'] > 0) ? $eid4 = $row['Planificador2'] : $eid4 = '';
        //cantidades de pacientes por planficador
        ($row['pacientes1'] > 0) ? $qty1 = $row['pacientes1'] : $qty1 = 0;
        ($row['pacientes2'] > 0) ? $qty2 = $row['pacientes2'] : $qty2 = 0;
        ($row['pacientesp1'] > 0) ? $qty3 = $row['pacientesp1'] : $qty3 = 0;
        ($row['pacientesp2'] > 0) ? $qty4 = $row['pacientesp2'] : $qty4 = 0;
        if($row['Unit_Desc'] <> null){
            $unidad = $row['Unidad'] . ' ('.$row['Unit_Desc'].')';
        }else{
            $unidad = $row['Unidad'];
        }
        $totalUnidad = $row['TotalUpdated'];
        // $totalReg = $row['TotalRegistrado'];
        $alta = $row['alta'];
        /*************************************************************************/
        // generacion de los dropdowns y cantidades de pacientes
        /*************************************************************************/
        $html .= '<tr><td style="text-align: center;"><span class="dot" id="circle'.$id.'" style="'.setBGColor($qty1).'" ></span></td>
            <td style="text-align: left;">('.$id.')'.$unidad.'</td>
            <td style="text-align: left;">'.gddEmployees("manejadora",$eid1,'ddman',$id).'</td>
            <td style="text-align: center;">
            <input name="qtya[]" id="qtya'.$id.'" type="number" min="0" max="'.$totalUnidad.'" value="'.$qty1.'" style="'.setManStyle($qty1).'" class="manejador"/></td>
            <td style="text-align: left;">'.gddEmployees("manejadorb",$eid2,'ddman',$id).'</td>
            <td style="text-align: center;">
            <input name="qtyb[]" id="qtyb'.$id.'" type="number" min="0" max="'.$totalUnidad.'" value="'.$qty2.'" style="'.setManStyle($qty2).'" class="manejador"/></td>
            <td colspan="2" style="text-align: center;">'.$totalUnidad.'</td>
            <td style="text-align: center;">'.gddEmployees("planificadora",$eid3,'ddplan',$id).'</td>
            <td style="text-align: center;">
            <input name="qtyc[]" id="qtyc'.$id.'" type="number" min="0" max="'.$totalUnidad.'" value="'.$qty3.'" style="'.setPlanStyle($qty3).'" class="planificador"/></td>
            <td style="text-align: center;">'.gddEmployees("planificadorb",$eid4,'ddplan',$id).'</td>
            <td style="text-align: center;"><input type="hidden" name="opt" value="1">
            <input name="qtyd[]" id="qtyd'.$id.'" type="number" min="0" max="'.$totalUnidad.'" value="'.$qty4.'" style="'.setPlanStyle($qty4).'" class="planificador"/>
            <input type="hidden" name="uid[]" value="'.$id.'"><input type="hidden" name="hid[]" id="hid'.$id.'" value="'.$totalUnidad.'">
            </td></tr>';
    } //end while
        $html1 ='
        <table>
        <thead>
        <tr class="noprint">
        <th colspan="21" style="text-align:center;"><!--For the period of: -->
            <!-----------------------------------------------------------------------------------------------------------------> 
            <!------------------------------------------- actualizar dia de las altas ----------------------------------------->
            <form id="frmRefresh" action="altas2.php" method="post">
                <input type="date" id="ddPeriod" name="ddPeriod" value="'. $date .'" required>
                <input type="hidden" name="opt" value="2">
                <button type="Submit" style="border: 0; background-color: #FFF7F9;" id="btnRefresh">'.$btn.'</button>
            </form>
            <!------------------------------------------------------------------------------------------------------------------> 
            <!------------------------------------------- end actualizar dia de las altas -------------------------------------->
        </th></tr>';

        $html1.= '
        <!----------------------------------------------------------------------------------------------------------> 
        <!-------------------------------------------- data de las altas -------------------------------------------> 
        <tr>
            <th colspan="2" style="text-align: center;">Unidades Clinicas</th>
            <th style="text-align: center;">Manejadora Revision 1</th>
            <th style="text-align: center;">Pacientes Revision 1</th>
            <th style="text-align: center;">Manejadora Revision 2</th>
            <th style="text-align: center;">Pacientes Revision 2</th>
            <!--<th style="text-align: center;">Manejadora Revision 3</th>-->
            <th colspan="2" style="text-align: center;"><b>Total de Pacientes</b></th>
            <th style="text-align: center;">Planificadora 1</th>
            <th style="text-align: center;">Pacientes Planificador 1</th>
            <th style="text-align: center;">Planificadora 2</th>
            <th style="text-align: center;">Pacientes Planificador 2</th>
        </th>
        </tr>
        </thead>
        <tbody>
        <form id="main2" name="main2" action="altas2.php" target="_blank" method="POST">';
        $html = $html1.$html;

    // }
    //$html .= '<tr><td colspan="21">'.$alta.' - '.$date.'</td></tr>';
    return $html;
}
// obtener totales de pacientes por empleados por alta
function getEmpTotals($alta){
    $db = new ServidorBD();
    $conn = $db->Conectar('a');
    $sql = "SELECT t.[id]
            ,t.[id_empleado]
            ,e.nombre
            ,t.[total_revision]
            ,t.[total_planificacion]
            ,t.[id_alta]
        FROM [Utilizacion_Tot_Empleados] t
        inner join Utilizacion_Empleados e on e.id = t.[id_empleado]
        where id_alta = ? order by nombre;";
    if (!$res = sqlsrv_prepare($conn, $sql,array($alta))) {
        echo "Statement could not be prepared.\n";
        die(print_r(sqlsrv_errors(), true));  
    } 
    if( sqlsrv_execute( $res ) === false ) {
        echo "Statement could not be executed.\n";
        FormatErrors( sqlsrv_errors());
    }
    $html = '<div id="empleados"><table><tr><th>Manejadores disponibles</th>
        <th>Revision</th><th>Planificacion</th></tr>';
    while ($r = sqlsrv_fetch_array($res, SQLSRV_FETCH_ASSOC)){
       $html .= '<tr><td>'.$r['nombre'].'</td><td>'.$r['total_revision'].'</td><td>'.$r['total_planificacion'].'</td>';
    }
    $html .= '</table></div>';
    echo $html;
}
//
function getEmpTotalDet($alta){
    $db = new ServidorBD();
    $conn = $db->Conectar('a');
    sqlsrv_configure('WarningsReturnAsErrors',0);
    $sql = "{call spTotAltasEmpleados(?)}";
    if (!$res = sqlsrv_prepare($conn, $sql,array($alta))) {
        echo "Statement could not be prepared.\n";
        die(print_r(sqlsrv_errors(), true));  
    } 
    if( sqlsrv_execute( $res ) === false ) {
        echo "Statement could not be executed.\n";
        FormatErrors( sqlsrv_errors());
    }
    // $html = '<div id="empleados"><table><tr><th>Manejadores disponibles</th><th>Revision</th><th>Planificacion</th></tr>';
    $html = ''; 
    while ($r = sqlsrv_fetch_array($res, SQLSRV_FETCH_ASSOC)){
        $id = $r['id']; $name = $r['nombre'];$ac = $r['Active'];$revi = $r['Revi'];$plan = $r['Plan'];
       //$html .= '<tr><td>'.$r['nombre'].'</td><td>'.$r['total_revision'].'</td><td>'.$r['total_planificacion'].'</td>';
       $html .= '<tr>
       <td style="text-align: left;">
            <label id="eid'.$id.'">'.$name.'</label>
            <a href="#editEmployeeModal" data-toggle="modal"><i class="fas fa-user-edit editar" data-btnid="'.$id.'" data-eName="'.$name.'" data-eActive="'.$ac.'"></i></a>
       </td>
       <td style="text-align: center;">
           <input name="revi['.$id.']" id="revi'.$id.'" type="number" min="0" style="'.setManStyle(0).'" class="tmanejador" value="'.$revi.'"/>
       </td>

       <td style="text-align: center;">
           <input name="plan['.$id.']" id="plan'.$id.'" type="number" min="0" style="'.setPlanStyle(0).'" class="tplanificador" value="'.$plan.'"/>
       </td></tr>';
    }
    $html .= '</table></div>';
    echo $html;
}

function runSpEcqm(){
    $db = new ServidorBD();
    $conn = $db->Conectar('a');
    $sql = "EXEC ECQM - File Transfer - Manual";
    $stmt = sqlsrv_prepare($conn, $sql, array());
    if (!sqlsrv_execute($stmt)) {
        return false;
    }else{
        return true;
    }
}

// obtener reporte de altas
function getAltasRpt($date = null,$id = 0){
    $db = new ServidorBD();
    $conn = $db->Conectar('a');
    //sqlsrv_configure('WarningsReturnAsErrors',1);
    //$sql = "EXEC spAltas @id = ?,@dia = ?";
    // echo "</br>a$id -> $date";
    if($date === null && $id == 0) $date = date('Y-m-d') ;
    if($date <> null && $id == 0) $id = getLastAltas($date);
    // echo "</br>b$id -> $date";
    if($id > 0){
        $sql = "SELECT a.[id],a.[Dia],a.[Created],a.[Usuario],b.id_Unidad,c.Unidad
                ,b.idEmpleado1 'Empleado1'
                ,b.qtyPacientes1 'pacientes1'
                ,b.idEmpleado2 'Empleado2'
                ,b.qtyPacientes2 'pacientes2'
                ,b.idPlanificador1 'Planificador1'
                ,b.qtyPacientesp1 'pacientesp1'
                ,b.idPlanificador2 'Planificador2'
                ,b.qtyPacientesp2 'pacientesp2'
                ,b.Unit_Count 'TotalRegistrado'
            FROM [WebReports].[dbo].[Utilizacion_Altas] a
            join Utilizacion_AltasDet b on a.id = b.id_alta
            join Utilizacion_Unidades c on c.id = b.id_Unidad
            join [dbo].[Utilizacion_Censo] d on c.Unidad = d.Nurse_Station COLLATE SQL_Latin1_General_CP1_CI_AS
            where a.id = ? order by id_Unidad";
            // echo "</br>$sql</br>";
        $params = array($id);
        if (!$res = sqlsrv_prepare($conn, $sql, $params)) {
            echo "Statement could not be prepared.\n";
            die(print_r(sqlsrv_errors(), true));  
        } 
        if( sqlsrv_execute( $res ) === false ) {
            echo "Statement could not be executed.\n";
            FormatErrors( sqlsrv_errors());
        }
        $filas='';
        while ($row = sqlsrv_fetch_array($res, SQLSRV_FETCH_ASSOC)){
            $id = $row['id'];
            $date = $row['Dia']->format('Y-m-d');
            //$date = date( "Y-m-d", strtotime( $row['dia'] ) );
            //$date = $row['Dia'];
            ($row['Empleado1'] > 0) ? $eid1 = $row['Empleado1'] : $eid1 = '';
            ($row['Empleado2'] > 0) ? $eid2 = $row['Empleado2'] : $eid2 = '';
            ($row['Planificador1'] > 0) ? $eid3 = $row['Planificador1'] : $eid3 = '';
            ($row['Planificador2'] > 0) ? $eid4 = $row['Planificador2'] : $eid4 = '';
            //cantidades de pacientes por manejador
            ($row['pacientes1'] > 0) ? $qty1 = $row['pacientes1'] : $qty1 = 0;
            ($row['pacientes2'] > 0) ? $qty2 = $row['pacientes2'] : $qty2 = 0;
            ($row['pacientesp1'] > 0) ? $qty3 = $row['pacientesp1'] : $qty3 = 0;
            ($row['pacientesp2'] > 0) ? $qty4 = $row['pacientesp2'] : $qty4 = 0;
            if($row['Unit_Desc'] <> null){
                $unidad = $row['Unidad'] . ' ('.$row['Unit_Desc'].')';
            }else{
                $unidad = $row['Unidad'];
            }
            $totalUnidad = $row['TotalUpdated'];
            $totalReg = $row['TotalRegistrado'];
            $alta = $row['alta'];
            $filas .= '<tr>
            <td colspan="2" style="text-align: left;">'.$unidad.'</td>
            <td style="text-align: left;">'.gUtilEmployee($eid1).'</td>
            <td style="text-align: center;">'.$qty1.'</td>
            <td style="text-align: left;">'.gUtilEmployee($eid2).'</td>
            <td style="text-align: center;">'.$qty2.'</td>
            <td colspan="2" style="text-align: center;">'.$totalReg.'</td>
            <td style="text-align: left;">'.gUtilEmployee($eid3).'</td>
            <td style="text-align: center;">'.$qty3.'</td>
            <td style="text-align: left;">'.gUtilEmployee($eid4).'</td>
            <td style="text-align: center;">'.$qty4.'</td></tr>';
        }//end while
        $filas .='</table></div>';
    }else{
        $filas = '<tr><td colspan="25" style="text-align: center;"> No hay altas registradas para '.$date.'</td></tr>';
    }
    // echo "</br>c $id - > $dia";
    $html1 ='<div id="main">
    <div id="forma" class="divx">
        <table>
        <thead>
        <tr class="noprint">
        <th colspan="21" style="text-align:center;"><!--For the period of: -->
            <form id="frmRefresh" action="altas2.php" method="post"><a href="altas.php"><i class="far fa-arrow-alt-circle-left fa-lg"></i></a>
                <input type="date" id="ddPeriod" name="ddPeriod" value="'. $date .'" required>
                <input type="hidden" name="opt" value="2">
                <button type="Submit" style="border: 0; background-color: #FFF7F9;" id="btnRefresh"><i class="fas fa-sync-alt fa-2x" style="background: none;"></i></button>
                <button id="btnPrint" onclick="javascript:window.print()" class="dentro">Print</button>
            </form>
        </th></tr>
        <tr>
            <th colspan="2" style="text-align: center;">Unidades Clinicas</th>
            <th style="text-align: center;">Manejadora Revision 1</th>
            <th style="text-align: center;">Pacientes Revision 1</th>
            <th style="text-align: center;">Manejadora Revision 2</th>
            <th style="text-align: center;">Pacientes Revision 2</th>
            <!--<th style="text-align: center;">Manejadora Revision 3</th>-->
            <th colspan="2" style="text-align: center;"><b>Total de Pacientes</b></th>
            <th style="text-align: center;">Planificadora 1</th>
            <th style="text-align: center;">Pacientes Planificador 1</th>
            <th style="text-align: center;">Planificadora 2</th>
            <th style="text-align: center;">Pacientes Planificador 2</th>
        </th>
        </tr>
        </thead>
        <tbody>';
    $html = $html1.$filas;//.'</table></div>';
    echo str_replace('</br>','',$html);
    return $date;
}

// insertar nuevo registro de alta y obtener el id para luego insertar los detalles
function RegisterAltas(){
    $db = new ServidorBD();
    $conn = $db->Conectar('a');
    $un = $_SESSION['user_name'];
    $params = array($un);
    $tsql = "INSERT into [dbo].[Utilizacion_Altas] ([Dia],[Created],[Usuario])
            values (CONVERT (date, GETDATE()),getdate(),?);SELECT SCOPE_IDENTITY() as 'id';";
    //echo $tsql."</br>";
    $res = sqlsrv_prepare($conn, $tsql,$params);  
    if( $res === false ) {
        die( FormatErrors( sqlsrv_errors() ) );  
    }
    if( sqlsrv_execute($res) === false ) {
        die( FormatErrors( sqlsrv_errors() ) );  
    }

    /*Skip the open result set (row affected). */  
    $next_result = sqlsrv_next_result($res);  
    if( $next_result === false ){
        die( FormatErrors( sqlsrv_errors() ) );    
    }

    /* Fetch the next result set. */  
    if( sqlsrv_fetch($res) === false) {
        die( FormatErrors( sqlsrv_errors() ) );  
    }

    /* Get the first field - the identity from INSERT. */  
    $id = sqlsrv_get_field($res, 0); 

    return $id;
}
//insertar informacion / detalle de altas
function insNewAltaDet($campos,$username,$alta){
    $db = new ServidorBD();
    $conn = $db->Conectar('a');
    // echo "<pre>...</br>";
    // print_r($campos);
    // echo "</br>";
    $sql = "INSERT into [Utilizacion_AltasDet]
        ([id_Unidad],[Dia],[idEmpleado1],[qtyPacientes1],[idEmpleado2],[qtyPacientes2],[idPlanificador1],[qtyPacientesp1]
        ,[Unit_Count],[idPlanificador2],[qtyPacientesp2],[id_alta],[Modifier])";
    $sql2 = 'INSERT INTO [Utilizacion_Tot_Empleados]
        ([id_empleado],[total_revision],[total_planificacion],[id_alta])' ;

    $sql2 .= $campos[1];
    $sql .= $campos[0];
    $sql .= ';'.$sql2;
    // echo "</br>".$sql;
    $stmt = sqlsrv_prepare( $conn, $sql,array());
    if (!$stmt) {
        die( "<pre>" . print_r( sqlsrv_errors(). "</pre>", true));
    }
    if( sqlsrv_execute($stmt))
    {  
    }else{  
        die( "<pre>".print_r( sqlsrv_errors(), true))."</pre>";
    }
    sqlsrv_free_stmt( $stmt);
    sqlsrv_close( $conn);
    $db->Desconectar();
    return $alta;
}

function gddEmployees($dname,$id,$clase,$unidad){
    //generate dropdown of epmployees
    $db = new ServidorBD();
    $conn = $db->Conectar('a');
    ////////////////////////////////////////////////////////////////
    //Si id es numerico, se verifica si el empleado esta activo para obtener solo los activos, de lo contrario se obtienen todos los empleados para el dropdown
    ////////////////////////////////////////////////////////////////
    if($id > 0){
        $sql = "SELECT id,active from Utilizacion_Empleados where id = $id" ;// : " order by 2";
        $getResults = sqlsrv_query($conn, $sql);
        $row = sqlsrv_fetch_array($getResults, SQLSRV_FETCH_ASSOC);
        if ($row['active']){
            $sql2 = "SELECT id,nombre from Utilizacion_Empleados where Active = 1 order by 2" ;// : " order by 2";
        }else{
            $sql2 = "SELECT id,nombre from Utilizacion_Empleados order by 2" ;// : " order by 2";
        }
        $getResults = sqlsrv_query($conn, $sql2);
    }else{
        $sql2 = "SELECT id,nombre from Utilizacion_Empleados where Active = 1 order by 2" ;// : " order by 2";
        $getResults = sqlsrv_query($conn, $sql2);
    }
    ////////////////////////////////////////////////////////////////
    // crear dropdown y seleccionar el empleado asignado.
    ////////////////////////////////////////////////////////////////
    $flag = false;
    if($dname == 'empida'){
        $dde = '<select name="'.$dname.'" id="'.$dname.'" class="'.$clase.'" required>';
    }else{
        $dde = '<select name="'.$dname.'[]" id="'.$dname.$unidad.'" class="'.$clase.'" required>';
    }
    
    while ($row = sqlsrv_fetch_array($getResults, SQLSRV_FETCH_ASSOC)) {
        if($id == $row['id']){
            $dde .= '<option value="' . $row['id'] . '" selected>' . $row['nombre'] . '</option>';
            $flag = true;
        }else{
            $dde .= '<option value="' . $row['id'] . '">' . $row['nombre'] . '</option>';
        }
    } //end while
    if(!$flag) $dde .= '<option value="false" selected> Sin asignar </option>';
    $dde .= '</select>';
    sqlsrv_free_stmt($getResults);
    return $dde;
}

function gddAusencias(){
    $db = new ServidorBD();
    $conn = $db->Conectar('a');
    $sql = "select id,ausencia from Utilizacion_Ausencias order by 2";
    $getResults = sqlsrv_query($conn, $sql);
    $dda = '<select name="auid" id="auid" required>';
    while ($row = sqlsrv_fetch_array($getResults, SQLSRV_FETCH_ASSOC)) {
        $dda .= '<option value="' . $row['id'] . '">' . $row['ausencia'] . '</option>';
    } //end while
    $dda .= '</select>';
    sqlsrv_free_stmt($getResults);
    return $dda;
}

function gGroups(){
    require_once("cno.php");
    $grupos = getAllGroups() ;
    $html = '<details><summary>Groups</summary><div class="contentt"><table><tr>';
    $i = 0;
    foreach($grupos as $row){
        //($row[3]) ? $checked = 'checked' : $checked = '';
        $html .= '<form name="forma" action="webadmin.php" target="_self" method="POST">
                    <tr><td style="text-align: center;" >('. $row[0] .')</td>
                        <td style="text-align:left;"><input type="hidden" value="' . $row[0] . '" name="id" id="id">
                        <input type="text" size="55" name="GroupName" value="' . $row[1] . '" ></td>
                        <td style="text-align:left;" colspan="3"><input type="text" size="55" name="GroupOU" value="' . $row[2] . '" ></td>
                        <td><button class="dentro">update</button>
                        <input type="hidden" name="req" value="doGroup">                
                    </td></tr></form>';
        $i++;
    } //end while  $GroupName,$GroupOU,$Active,$id
    // $g = allGroups()
    // echo "<pre>";
    // print_r($_SESSION);
    if ($_SESSION['Grupox']){
        $dd = '<select id="aGroups" name="GroupName">';
        for ($i=0; $i < count($_SESSION['Grupox']); $i++) { 
            $dd .= '<option value="' . $_SESSION['Grupox'][$i] . '">' . $_SESSION['Grupox'][$i] . '</option>';
        } //end while
        $dd .= '</select>';
    }
    $html .='
    <tr><td colspan="9"></td></tr><tr>
    <form name="main1" action="webadmin.php" target="_self" method="POST">
        <td>Añadir grupo</td>
        <td style="text-align:left;"><!--<input type="text" name="GroupName" placeholder="Nombre" required>-->
        '.$dd.'</td>
        <td colspan="3" style="text-align:left;"><input type="text" name="GroupOU" placeholder="Descripcion" required>
        <td colspan="2">
            <input type="hidden" name="req" value="doGroup">
        <button class="dentro">Submit</button></td>
    </form>
    </tr></table></div></details>';
    return $html;
}

function gOptions(){
    require_once("cno.php");
    $db = new ServidorBD;
    $conn = $db->Conectar('a');
    $tsql = 'SELECT [id],[OptionName],[Description],Active FROM [WebOptions]';
    $getResults = sqlsrv_query($conn, $tsql, array(), array( "Scrollable" => SQLSRV_CURSOR_KEYSET ));
    if (!$getResults) {
        die( "<pre>" . print_r( sqlsrv_errors(). "</pre>", true)); ;
    }
    $items = '<details>
                <summary>Options</summary>
                <div class="contentt">
                    <table><tr>';
    $i = 0;
    while ($row = sqlsrv_fetch_array($getResults, SQLSRV_FETCH_NUMERIC)) {
        ($row[3]) ? $checked = 'checked' : $checked = '';
        $items .= '<form name="formb" action="webadmin.php" target="_self" method="POST">
                    <tr><td style="text-align: center;" >('. $row[0] .')</td>
                        <td style="text-align:left;"><input type="hidden" value="' . $row[0] . '" name="id">
                        <input type="text" size="55" name="OptionName" value="' . $row[1] . '" ></td>
                        <td style="text-align:left;" colspan="3">
                            <input type="text" size="55" name="Description" value="' . $row[2] . '" ></td>
                        <td><button class="dentro">update</button>
                        <input type="hidden" name="req" value="doOption"> 
                    </td></tr></form>';
        $i++;
    } //end while [OptionName] = ?,[Description] = ?,[Active]

    $items .='
    <tr><td colspan="9"></td></tr><tr>
    <form name="main1" action="webadmin.php" target="_self" method="POST">
        <td>Añadir opción</td>
        <td style="text-align:left;"><input type="text" name="OptionName" placeholder="Opcion" required></td>
        <td colspan="3" style="text-align:left;"><input type="text" name="Description" placeholder="Descripcion">
        <td colspan="2">
            <input type="hidden" name="req" value="doOption">
        <button class="dentro">Submit</button></td>
    </form>
    </tr></table></div></details>';
    return $items;
}

function gGxO(){
    require_once("cno.php");
    $html = '<details><summary>OptionXGrupo</summary><div class="contentt"><table><tr>';
    $grupos = getGxO();
    $i = 0;
    foreach ($grupos as $row){
        // ($row[4]) ? $checked = 'checked' : $checked = '';
        $grpName = getGroup($row[1]);
        $optName = getOption($row[2]);
        ($row[3] > 0) ? $parent = getGroup($row[3]) : $parent = $grpName;
        $html .= '<form name="frmLogI" action="webadmin.php" target="_self" method="POST">
                    <tr><td style="text-align: center;" >('. $row[0] .')</td>
                        <td style="text-align:left;"><input type="hidden" value="' . $row[0] . '" name="id">
                        <input type="text" size="5" name="GroupID" value="' . $row[1] . '" >
                        <input type="text" size="20" name="GroupName" value="' . $grpName . '" disabled></td>
                        <td style="text-align:left;" colspan="3">
                            <input type="text" size="5" name="OptionID" value="' . $row[2] . '" >
                            <input type="text" size="20" name="OptionName" value="' . $optName . '" disabled>
                        </td>
                        <td>
                            <input type="text" size="5" name="ParentGrpID" id="ParentGrpID" value="' . $row[3] . '" >
                            <input type="text" size="20" name="Parent" value="' . $parent . '" disabled>
                        </td>
                        <td>
                        <input type="radio" id="oactive1" name="active" value="1" '.($row[4] == 1 ? 'checked' : '').'>
                        <label for="oactive1">On</label>
                        <input type="radio" id="oactive2" name="active" value="0" '.($row[4] == 0 ? 'checked' : '').'>
                        <label for="oactive2">Off</label></td>
                        <td><button class="dentro">update</button>
                        <input type="hidden" name="req" value="doLogic">
                    </td></tr></form>';
        $i++;
    } //end while [GroupID] = ?,[OptionID] = ?,[ParentGrpID] = ?,[active]
    $grupos = getAllGroups() ;
    $ddGrupos = '<datalist id="lstGrupos" name="lstGrupos">';
    foreach($grupos as $row){
        $id = $row[0];
        $name = $row[1];
        $ddGrupos .= '<option value="' . $id . '">'.$name.'</option>';
    } //end foreach
    $ddGrupos .= '</datalist>';
    $grupos = getAllOptions() ;
    $lstOpts = '<datalist id="lstOptions" name="lstOptions">';
    foreach($grupos as $row){
        $id = $row[0];
        $name = $row[1];
        $lstOpts .= '<option value="' . $id . '">'.$name.'</option>';
    } //end foreach
    $lstOpts .= '</datalist>';
    $html .= $ddGrupos .$lstOpts.'
    <tr><td colspan="9"></td></tr><tr>
    <form name="frmLogU" action="webadmin.php" target="_self" method="POST">
        <td>Añadir</td>
        <td style="text-align:left;">
            <input type="text" list="lstGrupos" id="GroupID" name="GroupID" placeholder="Grupo" required></td>
        <td colspan="2" style="text-align:left;">
            <input type="text" list="lstOptions" id="OptionID" name="OptionID" placeholder="Opcion" required></td>
        <td colspan="2" style="text-align:left;">
            <input type="text" list="lstGrupos" id="ParentGrpID" name="ParentGrpID" placeholder="Parent 0 for root" required></td>
            <td>
            <input type="radio" id="oactive1" name="active" value="1" checked>
            <label for="oactive1">On</label>
            <input type="radio" id="oactive2" name="active" value="0">
            <label for="oactive2">Off</label>
        </td>
        <td colspan="2">
            <input type="hidden" name="req" value="doLogic">
        <button class="dentro">Submit</button></td>
    </form>
    </tr></table></div></details>';
    return $html;
}

function doGroup($data){
    require_once("cno.php");
    $db = new ServidorBD;
    $conn = $db->Conectar('a');
    // echo "<pre>";
    // print_r($data);
    $GroupName = trim($data['GroupName']);
    $GroupOU = trim($data['GroupOU']);
    // $Active = trim($data['active']) ;

    if(@$data['id']){
        $tsql = 'UPDATE [WebGroups] SET [GroupName] = ?,[GroupOU] = ? WHERE id =?';
        $id = $data['id'];
        $params = array($GroupName,$GroupOU,$id);
    }else{
        $tsql = 'INSERT into [WebGroups] ([GroupName],[GroupOU],[Active]) values (?,?,?)';
        $params = array($GroupName,$GroupOU,'1');
    }
    $stmt = sqlsrv_prepare( $conn, $tsql, $params); 
    if (!$stmt) {
        die( "<pre>" . print_r( sqlsrv_errors(). "</pre>", true));
    }
    if( sqlsrv_execute($stmt))
    {  
        echo '<div id="msg" class="msg">Successfully updated!</div>';
    }else{  
        die( "<pre>".print_r( sqlsrv_errors(), true))."</pre>";
    }
    sqlsrv_free_stmt( $stmt);
    sqlsrv_close( $conn);
    $db->Desconectar();
}

function doOption($data){
    require_once("cno.php");
    $db = new ServidorBD;
    $conn = $db->Conectar('a');
    $GroupName = trim($data['OptionName']);
    $GroupOU = trim($data['Description']);
    if(@$data['id']){
        $tsql = 'UPDATE [WebOptions] SET [OptionName] = ?,[Description] = ? WHERE id =?';
        $id = $data['id'];
        $params = array($GroupName,$GroupOU,$id);
    }else{
        $tsql = 'INSERT into [WebOptions] ([OptionName],[Description]) values (?,?)';
        $params = array($GroupName,$GroupOU);
    }
    $stmt = sqlsrv_prepare( $conn, $tsql, $params);
    if (!$stmt) {
        die( "<pre>" . print_r( sqlsrv_errors(). "</pre>", true)); ;
    }
    if( sqlsrv_execute($stmt))  
    {  
        echo '<div id="msg" class="msg">Successfully updated!</div>';  
    }else{  
        die( "<pre>".print_r( sqlsrv_errors(), true))."</pre>";//die( "<pre>" . print_r( sqlsrv_errors(). "</pre>", true));  
    }
    sqlsrv_free_stmt( $stmt);  
    sqlsrv_close( $conn);
    $db->Desconectar();
}

function doLogic($data){
    require_once("cno.php");
    $db = new ServidorBD;
    $conn = $db->Conectar('a');
    $GroupID = trim($data['GroupID']);
    $ParentGrpID = trim($data['ParentGrpID']);
    $OptionID = trim($data['OptionID']);
    $Active = trim($data['active']) ;
    if(@$data['id']){
        $tsql = 'UPDATE [WebGrpXOpt] SET [GroupID] = ?,[OptionID] = ?,[ParentGrpID] = ?,[active] = ? WHERE id =?';
        $id = $data['id'];
        $params = array($GroupID,$OptionID,$ParentGrpID,$Active,$id);
    }else{
        $tsql = 'INSERT into [WebGrpXOpt] ([GroupID] ,[OptionID] ,[ParentGrpID] ,[active] ) values (?,?,?,?)';
        $params = array($GroupID,$OptionID,$ParentGrpID,$Active);
    }
    $stmt = sqlsrv_prepare( $conn, $tsql, $params); 
    if (!$stmt) die( "<pre>" . print_r( sqlsrv_errors(). "</pre>", true)); 
    if( sqlsrv_execute($stmt))  
    {  
        echo '<div id="msg" class="msg"> Successfully updated!</div>';  
    }else{  
        die( "<pre>".print_r( sqlsrv_errors(), true))."</pre>";
    }
    sqlsrv_free_stmt( $stmt);  
    sqlsrv_close( $conn);
    $db->Desconectar();
}

// altas, DB utilizacion
function newEmployee($data){
    // echo '<pre>';
    // print_r($data);
    // echo '</pre>';
    require_once("cno.php");
    $db = new ServidorBD;
    $conn = $db->Conectar('a');

    // $Active = trim($data['active']) ;
    if(@$data['btnSometer']){
        $x = count($data['id']); echo $x;
        for ($i=0;$i < $x; $i++) {
            $id = $data['id'][$i];
            $name = trim($data['nombre'][$i]);
            ($data['active'][$i] == 'on') ? $active = 1 : $active = 0 ;
            $modi = date('Y-m-d H:s:i');
            // echo "$id ::: $name ::: $active</br>";            
            $tsql = 'UPDATE Utilizacion_Empleados SET [nombre] = ?,[active] = ?, [modified]=? WHERE id =?';
            $params = array($name,$active,$modi,$id);
        }
    }
    else{    
        $name = trim($data['nombre']);
        ($data['active'] == 'on') ? $active = 1 : $active = 0 ;
        $tsql = 'INSERT into Utilizacion_Empleados (nombre,active,modified) values (?,?,?)';
        $params = array($name,$active,date('Y-m-d H:s:i'));
    }
    $stmt = sqlsrv_prepare( $conn, $tsql, $params); 
    if (!$stmt) {
        die( "<pre>" . print_r( sqlsrv_errors(). "</pre>", true));
    }
    if( sqlsrv_execute($stmt))
    {  
        echo '<div id="msg" class="msg">Successfully updated!</div>';
    }else{  
        die( "<pre>".print_r( sqlsrv_errors(), true))."</pre>";
    }
    sqlsrv_free_stmt( $stmt);
    sqlsrv_close( $conn);
    $db->Desconectar();
}

function FormatErrors( $errors )  
{  
    /* Display errors. */  
    echo "Error information: <br/>";  
  
    foreach ( $errors as $error )  
    {  
        echo "SQLSTATE: ".$error['SQLSTATE']."<br/>";  
        echo "Code: ".$error['code']."<br/>";  
        echo "Message: ".$error['message']."<br/>";  
    }  
}  
function allGroups($name,$pass) {
    global $host, $port, $protocol, $base_dn, $domain;
    $adServer = "auxiliomutuo.com";
    $ldapconn = ldap_connect($adServer) or die("Could not connect to LDAP server.");
    $account = $name;
    $password = $pass;
    $ldaprdn = $account.'@auxiliomutuo.com';
    $ldappass = $password;

    if ($ldapconn) {
    $ldapbind = ldap_bind($ldapconn, $ldaprdn, $ldappass)  or die("Couldn't bind to AD!");
    }

    $dn = 'OU=Auxilio_Groups,DC=auxiliomutuo,DC=com';
    $filter="(objectcategory=group)";
    $justthese = array("dn","ou");
    $sr=ldap_search($ldapconn, $dn, $filter, $justthese);
    $info = ldap_get_entries($ldapconn, $sr);
    sort($info);
    // $token = $info[0]['primarygroupid'][0];
    // echo $token."<br/>";
    // array_shift($info);
    // echo "<pre>";
    // print_r($info);

    // OU=Application Security

    // $filteres = array_filter($info[1], function($str) {
    //     return $str === 'OU=Application Security';
    // });

    for ($i=0; $i < $info[0]; $i++) {
        @$row = explode(",",$info[$i]["dn"]);
        //echo $info[$i]["dn"]."<br>";
        $group = str_replace("CN=",'',$row[0]);
        if(@$row[1] === 'OU=Application Security' || @$row[1] === 'OU=Platform Security') $groups[] = trim($group);
    }
    ldap_free_result($sr);
    ldap_unbind($ldapconn);

    return $groups;
}

?>
