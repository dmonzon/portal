<?php
class ServidorBD {
    public function __CONSTRUCT(){
        print_r(sqlsrv_errors(SQLSRV_ERR_ERRORS));
        // die("no se pudo conectar");
    }

    public function Conectar($s){
        $serverName = "VHAMSQL10SVR";
        // $serverName = "DCDL78D9773";
        switch ($s) {
            case 'i':
                $db = "SSIS_DB";
                break;
            default:
                $db = "WebReports";
                break;
        }
        // $db = "DMO";
        $connectionOptions = array("Database" => $db,"CharacterSet" => "UTF-8");
        try {
            $conn = sqlsrv_connect($serverName, $connectionOptions);
        } catch (\Throwable $th) {
            echo 'Fallo la conexion:</br>';
            DisplayErrors();
        }
        return $conn;
    }
    public function Desconectar(){
        $conn = null;
    }
}
function DisplayErrors(){  
    $errors = sqlsrv_errors(SQLSRV_ERR_ERRORS);  
    foreach( $errors as $error )  
    {  
        echo "Error: ".$error['message']."\n";  
    }  
}  

function DisplayWarnings(){  
    $warnings = sqlsrv_errors(SQLSRV_ERR_WARNINGS);  
    if(!is_null($warnings))  
    {  
        foreach( $warnings as $warning )  
        {  
            echo "Warning: ".$warning['message']."\n";  
        }  
    }  
}

function getAllGroups(){
    $db = new ServidorBD;
    $conn = $db->Conectar('a');
    $tsql = 'SELECT [id],[GroupName],[GroupOU] FROM [dbo].[WebGroups]';
    $stmt = sqlsrv_query($conn, $tsql, array(), array( "Scrollable" => SQLSRV_CURSOR_KEYSET ));
    if (!$stmt) die( "<pre>" . print_r( sqlsrv_errors(). "</pre>", true));
    
    $stmt = sqlsrv_query( $conn, $tsql);  
    if ( !$stmt )  
    {
        echo "Error in statement execution.\n";  
        die( print_r( sqlsrv_errors(), true));  
    }  
    
    /* Iterate through the result set printing a row of data upon each  
    iteration.*/  
    while( $row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_BOTH))  
    {  
        $data[] = array($row['id'],$row['GroupName'],$row['GroupOU']);                            
    }  

    return $data;
}

function getAllOptions(){
    $db = new ServidorBD;
    $conn = $db->Conectar('a');
    $tsql = 'SELECT [id],[OptionName],[Description] FROM [WebOptions]';
    $stmt = sqlsrv_query($conn, $tsql, array(), array( "Scrollable" => SQLSRV_CURSOR_KEYSET ));
    if (!$stmt) die( "<pre>" . print_r( sqlsrv_errors(). "</pre>", true));
    $stmt = sqlsrv_query( $conn, $tsql);  
    if ( !$stmt )  
    {
        echo "Error in statement execution.\n";  
        die( print_r( sqlsrv_errors(), true));
    }  
    while( $row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_BOTH))  
        $data[] = array($row['id'],$row['OptionName'],$row['Description']);                            

    return $data;
}

function getGxO(){
    $db = new ServidorBD;
    $conn = $db->Conectar('a');
    $tsql = 'SELECT [id],[GroupID],[OptionID],[ParentGrpID],active FROM [WebGrpXOpt] order by 3';
    $grupos = sqlsrv_query($conn, $tsql, array(), array( "Scrollable" => SQLSRV_CURSOR_KEYSET ));
    if (!$grupos) {
        die( "<pre>" . print_r( sqlsrv_errors(). "</pre>", true)); ;
    }
    while( $row = sqlsrv_fetch_array( $grupos, SQLSRV_FETCH_BOTH))  
        $data[] = array($row['id'],$row['GroupID'],$row['OptionID'],$row['ParentGrpID'],$row['active']);                            

    return $data;
}

function getGroup($id){
    $db = new ServidorBD;
    $conn = $db->Conectar('a');
    $tsql = 'SELECT [GroupName] FROM [WebGroups] where id='.$id;
    $res = sqlsrv_query( $conn, $tsql);  
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
    return $name;
}

function getOption($id){
    $db = new ServidorBD;
    $conn = $db->Conectar('a');
    $tsql = 'SELECT [OptionName] FROM [WebOptions] where id='.$id;
    //$getResults = sqlsrv_query($conn, $tsql);//, array(), array( "Scrollable" => SQLSRV_CURSOR_KEYSET ));
    $res = sqlsrv_query( $conn, $tsql);  
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
    return $name;
}

function getAllCapitados(){
    $db = new ServidorBD;
    $conn = $db->Conectar('a');
    $tsql = 'SELECT * FROM [dbo].[Capitados]';
    $stmt = sqlsrv_query($conn, $tsql, array(), array( "Scrollable" => SQLSRV_CURSOR_KEYSET ));
    if (!$stmt) die( "<pre>" . print_r( sqlsrv_errors(). "</pre>", true));
    
    $stmt = sqlsrv_query( $conn, $tsql);  
    if ( !$stmt )  
    {
        echo "Error in statement execution.\n";  
        die( print_r( sqlsrv_errors(), true));  
    }  
    
    /* Iterate through the result set printing a row of data upon each  
    iteration.*/  
    while( $row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_BOTH))  
    {  
        $data[] = array($row['id'],$row['GroupName'],$row['GroupOU'],$row['Active']);                            
    }  

    return $data;
}

function getCapitado($periodo){
    $db = new ServidorBD;
    $conn = $db->Conectar('a');
    $tsql = 'SELECT * FROM [Capitados] where [periodo] ='.$periodo;
    //echo $tsql.'<br/>';
    $res = sqlsrv_query( $conn, $tsql);
    if (!$res) die( print_r( sqlsrv_errors(), true));
    if( $res === false )  
    {  
        echo "Error in statement preparation/execution.\n";  
        die( print_r( sqlsrv_errors(), true));  
    }  
    /* Make the first row of the result set available for reading. */  
   
    $data = sqlsrv_fetch_array( $res, SQLSRV_FETCH_BOTH);
    return $data;
}

function getNextPeriod(){
    $db = new ServidorBD;
    $conn = $db->Conectar('a');
    $tsql = 'SELECT max([periodo]) FROM [Capitados]';
    $res = sqlsrv_query( $conn, $tsql);  
    if (!$res) die( "<pre>" . print_r( sqlsrv_errors(). "</pre>", true));
    if( $res === false )  
    {  
        echo "Error in statement preparation/execution.\n";  
        die( print_r( sqlsrv_errors(), true));  
    }  
    // $name = sqlsrv_get_field( $res, 0);
    $data = sqlsrv_fetch_array( $res, SQLSRV_FETCH_NUMERIC);
    if( $data === false )  
    {  
        echo "Error in sadata.\n";  
        die( print_r( sqlsrv_errors(), true));  
    }   
    //var_dump($data);
    return $data[0];
}

function CreateTable($tabla){
    // $tabla = 'Capitados';
    // require_once('alt/cno.php');
    $db = new ServidorBD();
    $conn = $db->Conectar('x');
    $tsql = "SELECT * FROM $tabla";
    $getResults = sqlsrv_query($conn, $tsql);
    $i =0;
    $html = "<input type='hidden' id='sort' value='asc'>
    <table width='100%' id='empTable' border='1' cellpadding='10'><tr>";
    foreach(sqlsrv_field_metadata($getResults) as $field){
        $html .= '<th><span onclick=\'sortTable("'.$tabla.'","'.$field['Name'].'");\'>'.$field['Name'].'</span></th>';
        $i++;
    }
    $html .= '</tr>';
    // echo count($field)."==$i==";
    while ($row = sqlsrv_fetch_array($getResults, SQLSRV_FETCH_BOTH)){
        for ($j = 0; $j < $i; $j++) {
            if ($row[$j] instanceof DateTime) {
                $html .= "<td>".$row[$j]->format('d/m/Y')."</td>";
            }else{
                $html .= "<td>".$row[$j]."</td>";
            }
        }
        $html .= '</tr>';
    }
    $html .= '</tr></table>';
    sqlsrv_free_stmt($getResults);
    //echo $html;
    return $html;
}

function SleepQrys($data){
    //$ur = $_SESSION['user_name'];
    $ur = 'user_name';
    //$myarray = array_map('trim', $_POST);
    extract($_POST);
    switch ($tb) {
        case 'Sleep_Studies_Results':
            $tsql ="INSERT INTO [Sleep_Studies_Results]
                ([Expediente],[Nombre],[Apelidos],[Fecha_Estudio],[Fecha_Entrega],[Medico],[Visit_ID]
                ,[DED],[Plan_Medico],[Plan_Medico2],[Created],[Modified],[CreatedBy],[ModifiedBy])
                VALUES (?,?,?,?,?,?,?,?,?,?,GETDATE(),GETDATE(),?,?)";//;SELECT SCOPE_IDENTITY() as 'id';";
            $par = array($expedienteResults,ucwords(strtolower($nombreResultados)),ucwords(strtolower($txtApellidos)),$txtfechaEstudio,$fechaEntrega,ucwords(strtolower($txtMedico)),$txtVisitID,$txtDED,$txtPlan,$txtOtroPlan,$ur,$ur);
            doSleepDB($tsql,$par,$tb);
        break;
        case 'Sleep_Listado_Expedientes':
            $tsql ="INSERT INTO [dbo].[Sleep_Listado_Expedientes]
                ([num_expediente],[Nombre],[Apellidos],[Telefono1],[Telefono2],[created],[modified],[CreatedBy],[ModifiedBy]) 
            VALUES (?,?,?,?,?,getdate(),getdate(),?,?)";
            $par = array($numExpediente,ucwords(strtolower($nombre2)),ucwords(strtolower($apellidos2)),$txtTelefono,$txtTelefono2,$ur,$ur);
            doSleepDB($tsql,$par,$tb);
        break;
        case 'Sleep_Listado_Referidos':
            $tsql ="INSERT INTO [dbo].[Sleep_Listado_Referidos]
                    ([Num_expediente],[Nombre],[Apellidos],[Dia_Estudio],[Visit_ID],[Plan_Medico],[Plan_Medico2],[Referido_Por],[created],[CreatedBy],[modified],[ModifiedBy])
                VALUES (?,?,?,?,?,?,?,?,getdate(),?,getdate(),?)";
            $par = array($expediente,ucwords(strtolower($nombreReferido)),ucwords(strtolower($apellidosReferido)),$fechaEstudio,$visitRef,$planReferido,$otroPlanReferido,$ddReferidoMD,$ur,$ur);
            doSleepDB($tsql,$par,$tb);
        break;
        case 'Sleep_Inspeccion_Rutina':
            $tsql ="INSERT INTO Sleep_Inspeccion_Rutina
                ([Fecha_Inspeccion],[Habitacion],[Amplificador],[Headbox],[Oximetro],[CPAP],[Cama],[Bandas],[Sensores]
                ,[Electrodos],[Oxigeno],[Intercome],[PC],[Accion_Tomada],[Iniciales_Tecnico],[Transcutaneo],[ETCO],[Created],[CreatedBy],[Modified],[ModifiedBy])
            VALUES
            (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,getdate(),?,getdate(),?)";
            $dt = str_replace('T', ' ', $fechaInspeccion);
            $par = array($dt,$ddHabitacion,$ddAmplificador,$ddHeadbox,$ddOximetro,$ddCPAP,$ddCama1,$ddBandas,$ddSensores,
                        $ddElectrodos,$ddOxigeno,$ddIntrcome,$ddPC,$accionTomada,trim($techRutina),$ddTrans,$ddETCO,$ur,$ur);
            doSleepDB($tsql,$par,$tb);
        break;
        case 'Sleep_Registro_Paciente':
            $tsql ="INSERT INTO Sleep_Registro_Paciente
                ([Nombre],[Apellidos],[Fecha],[Plan_Medico],[Procedimiento],[Otro_Procedimiento],[Referido],[Created],[CreatedBy],[Modified],[ModifiedBy])
            VALUES
                (?,?,?,?,?,?,?,getdate(),?,getdate(),?)";
            $par = array(ucwords(strtolower($nombreMask)),ucwords(strtolower($apellidosMask)),$fechaMask,$ddPlanMedico,$ddProcedimiento1,$ddProcedimiento2,ucwords(strtolower($mdRefiere)),$ur,$ur);
            doSleepDB($tsql,$par,$tb);
        break;
        case 'Sleep_Valores_Criticos':
            $tsql ="INSERT INTO Sleep_Valores_Criticos
                ([Tecnico],[Fecha],[Num_Paciente],[Valor_Critico],[ReportadoA],[Accion],[Fecha_Reportado],[Created],[CreatedBy],[Modified],[ModifiedBy])
            VALUES
                (?,?,?,?,?,?,?,getdate(),?,getdate(),?)";
            $dt = str_replace('T', ' ', $valFecha); $dt2 = str_replace('T', ' ', $valReportado);
            $par = array(ucwords(strtolower($valExpediente)),$dt,$valPaciente,$valorCritico,ucwords(strtolower($repotadoa)),$valAccion,$dt2,$ur,$ur);
            doSleepDB($tsql,$par,$tb);
        break;
        case 'Sleep_CPAP_Prestados':
            $tsql ="INSERT INTO Sleep_CPAP_Prestados
                ([Num_Expediente],[Telefono],[Fecha_Prestado],[Fecha_Entrega],[Tecnico_Entrega],[Pago],[Tecnico_Recibe],[Fecha_Recibo]
                ,[Desinfectado],[Fecha_Desinfectado],[Equipo],[Created],[CreatedBy],[Modified],[ModifiedBy])
                VALUES (?,?,?,?,?,?,?,?,?,?,?,getdate(),?,getdate(),?)";
            $dt = str_replace('T', ' ', $fechaPrestado); 
            $dt2 = str_replace('T', ' ', $fecha_Entrega);
            $dt3 = str_replace('T', ' ', $cpapFecha); 
            $dt4 = str_replace('T', ' ', $fRecibe);
            $par = array($exClinico,$pTelefono,$dt,$dt2,ucwords(strtolower($tecEntrega)),$pago50,ucwords(strtolower($techRecibe)),$dt4,$desinfecto,$dt3,$ePrestado,$ur,$ur);
            doSleepDB($tsql,$par,$tb);
        break;
        case 'Sleep_Comunicacion':
            $tsql ="INSERT INTO Sleep_Comunicacion
                    ([Tecnico],[Fecha_Entrega],[Equipo],[Situacion],[Created],[CreatedBy],[Modified],[Modifiedby])
                VALUES (?,?,?,?,getdate(),?,getdate(),?)";
            $dt = str_replace('T', ' ', $comFecha); 
            $par = array($tecComunicacion,$dt,$comPrestado,$comSituacion,$ur,$ur);
            doSleepDB($tsql,$par,$tb);
        break;
        case 'Sleep_Rechazo':
            $tsql ="INSERT INTO Sleep_Rechazo ([Nombre],[Visit_ID],[Fecha],[Razon],[Tecnico],[Created],[CreatedBy],[Modified],[ModifiedBy])
                VALUES (?,?,?,?,?,getdate(),?,getdate(),?)";
            //$dt = str_replace('T', ' ', $fechaRechazo); 
            $par = array(ucwords(strtolower($pacienteRechazo)),$visitRechazo,$fechaRechazo,$razonRechazo,ucwords(strtolower($techRechazo)),$ur,$ur);
            doSleepDB($tsql,$par,$tb);
        break;
        case 'Sleep_Endozime':
            $tsql ="INSERT INTO Sleep_Endozime
            ([Fecha_Preparacion],[Fecha_Expira],[Temperatura],[Tecnico],[Created],[CreatedBy],[Modified],[ModifiedBy])
                VALUES (?,?,?,?,getdate(),?,getdate(),?)";
            $dt = str_replace('T', ' ', $fechaPreparacion);
            $par = array($dt,$expiracionEndozime,$tempEndozime,ucwords(strtolower($etcoTecnico)),$ur,$ur);
            doSleepDB($tsql,$par,$tb);
        break;
        case 'Sleep_Ojos':
            $tsql ="INSERT INTO Sleep_Ojos
            ([Fecha],[Tecnico],[Created],[CreatedBy],[Modified],[ModifiedBy])
                VALUES (?,?,getdate(),?,getdate(),?)";
            $dt = str_replace('T', ' ', $fechaDucha); 
            $par = array($dt,ucwords(strtolower($tecDucha)),$ur,$ur);
            doSleepDB($tsql,$par,$tb);
        break;
        case 'Sleep_ETCO':
            $tsql ="INSERT INTO Sleep_ETCO
            ([Fecha],[Tecnico],[Modelo],[Created],[CreatedBy],[Modified],[ModifiedBy])
                VALUES (?,?,?,getdate(),?,getdate(),?)";
            $par = array($etcoDesinfeccion,ucwords(strtolower($etcoTecnico)),$etcoModelo,$ur,$ur);
            doSleepDB($tsql,$par,$tb);
        break;
        case 'Sleep_Desinfeccion_CPAP':
            $tsql ="INSERT INTO Sleep_Desinfeccion_CPAP
                ([Fecha],[Fecha_Filtro],[Fecha_Cambio],[Camas],[Tecnico],[Created],[CreatedBy],[Modified],[ModifiedBy])
                VALUES (?,?,?,?,?,getdate(),?,getdate(),?)";
            $camas = implode(',',$ckCamas);
            $par = array($fechaDesinfeccion,$DesinfeccionFiltro,$CambioFiltro,$camas,ucwords(strtolower($txtTecnico)),$ur,$ur);
            doSleepDB($tsql,$par,$tb);
        break;
        case 'Sleep_Frasco_Cidex':
            $tsql ="INSERT INTO Sleep_Frasco_Cidex
                ([Fecha],[Temperatura],[Lote_Solucion],[Fecha_Abierto_Solucion],[Fecha_Expira_Solucion],[Lote_Tirillas],[Fecha_Abierto_Tirillas]
                ,[Fecha_Expira_Tirillas],[Resultado_Puro1],[Resultado_Puro2],[Resultado_Puro3],[Resultado_Diluido1],[Resultado_Diluido2]
                ,[Resultado_Diluido3],[Acciones],[Tecnico],[Fecha_Expira_Frasco_Sol],[Fecha_Expira_Frasco_Tir],[Created],[CreatedBy],[Modified],[ModifiedBy])
            VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,getdate(),?,getdate(),?)";//22
            $par = array($fechaDePrueba,$txtTemperatura,$loteFrasco,$frascoAbierto,$expiraSolucion,$loteTirillas,$abiertoTirillas,
                $expiraTirilla,$ddResultadoTirilla1,$ddResultadoTirilla2,$ddResultadoTirilla3,$ddResultadoDiluido1,$ddResultadoDiluido2,
                $ddResultadoDiluido3,$txtAccionesCorrectivas,ucwords(strtolower($techTest)),$expiracionSolucion,$expiracionTirillas,$ur,$ur);//20
            doSleepDB($tsql,$par,$tb);
        break;
        case 'Sleep_Solucion_Cidex':
            $tsql ="INSERT INTO Sleep_Solucion_Cidex
                ([Fecha],[Tecnico],[Fecha_abierto],[No_usar_despues],[Lote_Tirillas],[Resultado_Calidad],[Fecha_Prueba_Calidad],[Probada_por],[Visit_ID]
                ,[Fecha_Comienzo],[Fecha_Expiracion],[Fecha_Prueba_Solucion],[Resultado_Solucion],[Temperatura],[Ausencia_Turbidez]
                ,[Ausencia_Materia],[Accion],[Equipo],[Fecha_Inmersion],[Tiempo_inmersion],[Liqueo],[Realizada_por],[Hora_Inmersion],[Created],[CreatedBy],[Modified],[ModifiedBy])
            VALUES
            (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,getdate(),?,getdate(),?)";//29
            $dt = str_replace('T', ' ', $fechaFrasco); 
            $dt2 = str_replace('T', ' ', $fechaInmersion); 
            $equipo = implode(',',$ckEquipo);
            $par = array($fechaSolucion,$txtDept,$fechaFrasco,$fechaExpiracion,$numeroLote,$ddPruebaRes,$fechaCalidad,ucwords(strtolower($txtProbada)),$visitIdSolucion,$fechaComienzo,
                $fechaExpiraSolucion,$dt,$cpapEquipo,$solTemp,$ddTurbidez,$ddMateria,$txtCorrectivas,$equipo,$dt2,
                $tiempoInmersion,$txtLiqueo,ucwords(strtolower($techPrueba)),$terminacion,$ur,$ur);//
            doSleepDB($tsql,$par,$tb);
        break;
        default:
        break;
    }

}

function doSleepDB($tsql,$params,$tb){
    require_once("cno.php");
    $db = new ServidorBD;
    $conn = $db->Conectar('a');
    $stmt = sqlsrv_prepare( $conn, $tsql, $params); 
    if (!$stmt) {
        die( "<pre>" . print_r( sqlsrv_errors(). "</pre>", true));
    }
    if( sqlsrv_execute($stmt))
    {  
        //sleep(5);
        header("Location:rpt.php?tb=".$tb);
    }else{  
        die( "<pre>".print_r( sqlsrv_errors(), true))."</pre>";
    }
    sqlsrv_free_stmt( $stmt);
    sqlsrv_close( $conn);
    $db->Desconectar();
}

function getRepTittle($tb){
    switch ($tb) {
        case 'Sleep_Studies_Results':
            return 'Sleep Studies Results';
        break;
        case 'Sleep_Listado_Expedientes':
            return 'Listado de Expedientes de la Clínica';
        break;
        case 'Sleep_Listado_Referidos':
            return 'Listado de Referidos';
        break;
        case 'Sleep_Inspeccion_Rutina':
            return 'Inspección Visual de Rutina';
        break;
        case 'Sleep_Registro_Paciente':
            return 'Registro de Paciente-Class/Mask Fitting';
        break;
        case 'Sleep_Valores_Criticos':
            return 'Valores Críticos';
        break;
        case 'Sleep_CPAP_Prestados':
            return 'Log de Auto CPAP Prestados';
        break;
        case 'Sleep_Comunicacion':
            return 'Log de Comunicación';
        break;
        case 'Sleep_Rechazo':
            return 'Log de Rechazo de Tratamiento';
        break;
        case 'Sleep_Endozime':
            return 'Uso y Manejo de Endozime AW Plus';
        break;
        case 'Sleep_Ojos':
            return 'Duchas de lavado de ojos';
        break;
        case 'Sleep_ETCO':
            return 'Desinfección ETCO2 Monitor';
        break;
        case 'Sleep_Desinfeccion_CPAP':
            return 'Desinfección CPAP';
        break;
        case 'Sleep_Frasco_Cidex':
            return 'Registro de Verificación de Frasco de Cidex OPA y Frasco de las Tirillas para las Pruebas Durante el Proceso de Desinfección de Alto Nivel';
        break;
        case 'Sleep_Solucion_Cidex':
            return 'Registro de la Verificación de la Solución Cidex OPA e Inmersión del Equipo Durante el Proceso de Desinfección de Alto Nivel';
        break;
        default:
        break;
    }   
}

