<?php
class ServidorBD {
    public function __CONSTRUCT(){
        print_r(sqlsrv_errors(SQLSRV_ERR_ERRORS));
        // die("no se pudo conectar");
    }

    public function Conectar($s){
        /////////////////////////////////////////////////////////////// PRODUCCION /////////////////////////////////////////////////////////////
        // $serverName = "VHAMSQL10SVR"; 
        ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
        
        ////////////////////////////////////////////////////////////// DESARROLLO (LOCAL) //////////////////////////////////////////////////////
        $serverName = "DCDL78D9773";
        ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
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
    $ur = $_SESSION['username'];
    extract($_POST);
    // echo "<pre>";
    // var_dump($_POST);
    switch ($tb) {
        /*
        case 'Sleep_Studies_Results':
            if($update){
                $tsql = "UPDATE Sleep_Studies_Results
                    SET [Expediente] = ?,[Nombre] = ?,[Apellidos] = ?,[Fecha_Estudio] = ?,[Fecha_Entrega] = ?,[Medico] = ?,[Visit_ID] = ?,[DED] = ?
                    ,[Plan_Medico] = ?,[Plan_Medico2] = ?,[Modified] = GETDATE(),[ModifiedBy] = ?
                    WHERE id = ?";
                $par = array($expedienteResults,ucwords(strtolower($nombreResultados)),ucwords(strtolower($txtApellidos))
                ,$txtfechaEstudio,$fechaEntrega,ucwords(strtolower($txtMedico)),$txtVisitID,$txtDED,$txtPlan,$txtOtroPlan,$ur,$id);
                $par= array_map('trim', $par);
            }else{
                $tsql ="INSERT INTO [Sleep_Studies_Results]
                    ([Expediente],[Nombre],[Apelidos],[Fecha_Estudio],[Fecha_Entrega],[Medico],[Visit_ID]
                    ,[DED],[Plan_Medico],[Plan_Medico2],[Created],[Modified],[CreatedBy],[ModifiedBy])
                VALUES (?,?,?,".($txtfechaEstudio == '' ?  'NULL' : "'".$txtfechaEstudio."'")."
                    ,".($fechaEntrega == '' ?  'NULL' : "'".$fechaEntrega."'").
                    ",?,?,?,?,?,GETDATE(),GETDATE(),?,?)";//;SELECT SCOPE_IDENTITY() as 'id';";
                $par = array($expedienteResults,ucwords(strtolower($nombreResultados)),ucwords(strtolower($txtApellidos))
                    ,ucwords(strtolower($txtMedico)),$txtVisitID,$txtDED,$txtPlan,$txtOtroPlan,$ur,$ur);
                $par= array_map('trim', $par);
            }
            doSleepDB($tsql,$par,$tb);
        break;
        case 'Sleep_Listado_Expedientes':
            if($update){
                $tsql = "UPDATE Sleep_Listado_Expedientes
                        SET [num_expediente] = ?,[Nombre] = ?,[Apellidos] = ?,[Telefono1] = ?,[Telefono2] = ?,[modified] = getdate(),[ModifiedBy] = ?
                            WHERE id = ?";
                $par = array($numExpediente,ucwords(strtolower($nombre2)),ucwords(strtolower($apellidos2)),$txtTelefono,$txtTelefono2,$ur,$id);
                $par= array_map('trim', $par);
            }else{
                $tsql ="INSERT INTO [dbo].[Sleep_Listado_Expedientes]
                    ([num_expediente],[Nombre],[Apellidos],[Telefono1],[Telefono2],[created],[modified],[CreatedBy],[ModifiedBy]) 
                VALUES (?,?,?,?,?,getdate(),getdate(),?,?)";
                $par = array($numExpediente,ucwords(strtolower($nombre2)),ucwords(strtolower($apellidos2)),$txtTelefono,$txtTelefono2,$ur,$ur);
            }
            $par= array_map('trim', $par);
            doSleepDB($tsql,$par,$tb);
        break;
        case 'Sleep_Listado_Referidos':
            if($update){
                $tsql = 'UPDATE Sleep_Listado_Referidos
                    SET [Num_expediente] = ?,[Nombre] = ?,[Apellidos] = ?,[Dia_Estudio] = ?,[Visit_ID] = ?,[Plan_Medico] = ?,[Plan_Medico2] = ?,[Referido_Por_MD] = ?,[modified] = getdate(),[ModifiedBy] = ?
                    WHERE id = ?';
                $par = array($expediente,ucwords(strtolower($nombreReferido)),ucwords(strtolower($apellidosReferido)),$fechaEstudio,$visitRef,$planReferido,$otroPlanReferido,$ddReferidoMD,$ur,$ur);
            }else{
                $tsql ="INSERT INTO [dbo].[Sleep_Listado_Referidos]
                        ([Num_expediente],[Nombre],[Apellidos],[Dia_Estudio],[Visit_ID],[Plan_Medico],[Plan_Medico2],[Referido_Por],[created],[CreatedBy],[modified],[ModifiedBy])
                    VALUES (?,?,?,?,?,?,?,?,getdate(),?,getdate(),?)";
                $par = array($expediente,ucwords(strtolower($nombreReferido)),ucwords(strtolower($apellidosReferido)),$fechaEstudio,$visitRef,$planReferido,$otroPlanReferido,$ddReferidoMD,$ur,$ur);
            }
            $par= array_map('trim', $par);
            doSleepDB($tsql,$par,$tb);
        break;
        */
        case 'Sleep_Inspeccion_Rutina':
            if($update =='1'){
                $tsql ="UPDATE Sleep_Inspeccion_Rutina
                SET [Fecha_Inspeccion] = ".($fechaInspeccion == '' ?  'NULL' : "'".str_replace('T', ' ', $fechaInspeccion)."'").",[Habitacion] =?,[Amplificador] = ?,[Headbox] = ?,[Oximetro] =?,[CPAP] = ?,[Cama] = ?,[Bandas] = ?,[Sensores] =?,[Electrodos] = ?,
                    [Oxigeno] =?,[Intercome] = ?,[PC] =?,[Accion_Tomada] = ?,[Iniciales_Tecnico] =?,[ETCO] = ?,[Transcutaneo] =?,[Modified] = getdate(),[ModifiedBy] = ?
                    where id = ?";
                    // $dt = str_replace('T', ' ', $fechaInspeccion);
                    // echo $tsql;
                $par = array($ddHabitacion,$ddAmplificador,$ddHeadbox,$ddOximetro,$ddCPAP,$ddCama1,$ddBandas,$ddSensores,
                    $ddElectrodos,$ddOxigeno,$ddIntrcome,$ddPC,$accionTomada,FormatearNombre($techRutina),$ddTrans,$ddETCO,$ur,$id);   
            }else{

                $tsql ="INSERT INTO Sleep_Inspeccion_Rutina
                        ([Fecha_Inspeccion],[Habitacion],[Amplificador],[Headbox],[Oximetro],[CPAP],[Cama],[Bandas],[Sensores]
                        ,[Electrodos],[Oxigeno],[Intercome],[PC],[Accion_Tomada],[Iniciales_Tecnico],[Transcutaneo],[ETCO],[Created],[CreatedBy],[Modified],[ModifiedBy])
                    VALUES (".($fechaInspeccion == '' ?  'NULL' : "'".str_replace('T', ' ', $fechaInspeccion)."'").",?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,getdate(),?,getdate(),?)";
                // $dt = str_replace('T', ' ', $fechaInspeccion);
                $par = array($ddHabitacion,$ddAmplificador,$ddHeadbox,$ddOximetro,$ddCPAP,$ddCama1,$ddBandas,$ddSensores,
                $ddElectrodos,$ddOxigeno,$ddIntrcome,$ddPC,$accionTomada,FormatearNombre($techRutina),$ddTrans,$ddETCO,$ur,$ur);
            }
            $par= array_map('trim', $par);
            doSleepDB($tsql,$par,$tb);
        break;
        case 'Sleep_Registro_Paciente':
            if($update){
                $tsql ="UPDATE Sleep_Registro_Paciente
                SET [Nombre] = ?,[Apellidos] = ?,[Fecha] = ".($fechaMask == '' ?  'NULL' : "'".$fechaMask."'").",[Plan_Medico] = ?,[Procedimiento] = ?,[Otro_Procedimiento] = ?,[Referido] = ?,[Tecnico] = ?,[Modified] = getdate(),[ModifiedBy] = ?
                   where id =?";
                $par = array(FormatearNombre($nombreMask),FormatearNombre($apellidosMask),$ddPlanMedico,$ddProcedimiento1,$ddProcedimiento2,FormatearNombre($mdRefiere),FormatearNombre($tecnicoMask),$ur,$id);
            }else{
                $tsql ="INSERT INTO Sleep_Registro_Paciente
                ([Nombre],[Apellidos],[Fecha],[Plan_Medico],[Procedimiento],[Otro_Procedimiento],[Referido],[Tecnico],[Created],[CreatedBy],[Modified],[ModifiedBy])
                VALUES (?,?,".($fechaMask == '' ?  'NULL' : "'".$fechaMask."'").",?,?,?,?,?,getdate(),?,getdate(),?)";
                $par = array(FormatearNombre($nombreMask),FormatearNombre($apellidosMask),$ddPlanMedico,$ddProcedimiento1,$ddProcedimiento2,FormatearNombre($mdRefiere),FormatearNombre($tecnicoMask),$ur,$ur);
            }
            $par= array_map('trim', $par);
            doSleepDB($tsql,$par,$tb);
        break;
        case 'Sleep_Valores_Criticos':
            if($update=='1'){
                $tsql ="UPDATE Sleep_Valores_Criticos
                    SET [Tecnico] = ?,[Fecha] = ".($valFecha == '' ?  'NULL' : "'".str_replace('T', ' ', $valFecha)."'").",[Num_Paciente] = ?,[Valor_Critico] = ?,[ReportadoA] = ?,[Accion] =?
                        ,[Accion_MD] = ?,[Fecha_Reportado] = ".($valReportado == '' ?  'NULL' : "'".str_replace('T', ' ', $valReportado)."'").",[Modified] = getdate(),[ModifiedBy] = ?
                    where id =?";
                // $dt = str_replace('T', ' ', $valFecha); $dt2 = str_replace('T', ' ', $valReportado);
                $par = array(FormatearNombre($valExpediente),$valPaciente,$valorCritico,FormatearNombre($repotadoa),$valAccion,$mdAccion,$ur,$id);
            }else{
                $tsql ="INSERT INTO Sleep_Valores_Criticos
                ([Tecnico],[Fecha],[Num_Paciente],[Valor_Critico],[ReportadoA],[Accion],[Accion_MD],[Fecha_Reportado],[Created],[CreatedBy],[Modified],[ModifiedBy])
                VALUES (?,".($valFecha == '' ?  'NULL' : "'".str_replace('T', ' ', $valFecha)."'").",?,?,?,?,?,".($valReportado == '' ?  'NULL' : "'".str_replace('T', ' ', $valReportado)."'").",getdate(),?,getdate(),?)";
                $dt = str_replace('T', ' ', $valFecha); $dt2 = str_replace('T', ' ', $valReportado);
                $par = array(FormatearNombre($valExpediente),$valPaciente,$valorCritico,FormatearNombre($repotadoa),$valAccion,$mdAccion,$ur,$ur);
            }
            $par= array_map('trim', $par);
            doSleepDB($tsql,$par,$tb);
        break;
        case 'Sleep_CPAP_Prestados':
            if($update){
                $tsql ="UPDATE Sleep_CPAP_Prestados
                SET [Num_Expediente] = ?,[Telefono] = ?,[Fecha_Prestado] = ".($fechaPrestado == '' ?  'NULL' : "'".str_replace('T', ' ', $fechaPrestado)."'").
                    ",[Fecha_Entrega] = ".($fecha_Entrega == '' ?  'NULL' : "'".str_replace('T', ' ', $fecha_Entrega)."'").",[Tecnico_Entrega] = ?,[Pago] = ?,[Tecnico_Recibe] = ?,
                    [Fecha_Recibo] = ".($cpapFecha == '' ?  'NULL' : "'".str_replace('T', ' ', $cpapFecha)."'")."
                    ,[Desinfectado_Por] = ?,[Fecha_Desinfectado] =".($fRecibe == '' ?  'NULL' : "'".str_replace('T', ' ', $fRecibe)."'").",[Equipo] = ?,[Modified] = getdate(),[ModifiedBy] = ? WHERE id =?";
                // $dt = str_replace('T', ' ', $fechaPrestado);    $dt2 = str_replace('T', ' ', $fecha_Entrega);
                // $dt3 = str_replace('T', ' ', $cpapFecha);       $dt4 = str_replace('T', ' ', $fRecibe);
                $par = array(FormatearNombre($cpacpName),$pTelefono,FormatearNombre($tecEntrega),$pago50,FormatearNombre($techRecibe),FormatearNombre($desinfecto),$ePrestado,$ur,$id);
            }else{
                $tsql ="INSERT INTO Sleep_CPAP_Prestados
                ([Num_Expediente],[Telefono],[Fecha_Prestado],[Fecha_Entrega],[Tecnico_Entrega],[Pago],[Tecnico_Recibe],[Fecha_Recibo]
                ,[Desinfectado_Por],[Fecha_Desinfectado],[Equipo],[Created],[CreatedBy],[Modified],[ModifiedBy])
                VALUES (?,?,".($fechaPrestado == '' ?  'NULL' : "'".str_replace('T', ' ', $fechaPrestado)."'").",".($fecha_Entrega == '' ?  'NULL' : "'".str_replace('T', ' ', $fecha_Entrega)."'").
                ",?,".($fRecibe == '' ?  'NULL' : "'".str_replace('T', ' ', $fRecibe)."'").",?,".($cpapFecha == '' ?  'NULL' : "'".str_replace('T', ' ', $cpapFecha)."'").",?,?,?,getdate(),?,getdate(),?)";
                // $dt = str_replace('T', ' ', $fechaPrestado);    $dt2 = str_replace('T', ' ', $fecha_Entrega);
                // $dt3 = str_replace('T', ' ', $cpapFecha);       $dt4 = str_replace('T', ' ', $fRecibe);
                $par = array(FormatearNombre($cpacpName),$pTelefono,FormatearNombre($tecEntrega),$pago50,FormatearNombre($techRecibe),FormatearNombre($desinfecto),$ePrestado,$ur,$ur);
            }
            $par= array_map('trim', $par);
            doSleepDB($tsql,$par,$tb);
        break;
        case 'Sleep_Comunicacion':
            if($update =='1'){
                $tsql = "UPDATE Sleep_Comunicacion
                SET [Tecnico] = ?,[Contacto] = ?,[Fecha_Entrega] = ".($comFecha == '' ?  'NULL' : "'".str_replace('T', ' ', $comFecha)."'").",[Situacion] = ?,[Modified] = getdate(),[Modifiedby] = ?
                WHERE id =?";
                // $dt = str_replace('T', ' ', $comFecha); 
                $par = array(FormatearNombre($tecComunicacion),FormatearNombre($txtLlama),$comSituacion,$ur,$id);                
            }else{
                $tsql ="INSERT INTO Sleep_Comunicacion
                    ([Tecnico],[Fecha_Entrega],[Contacto],[Situacion],[Created],[CreatedBy],[Modified],[Modifiedby])
                VALUES (?,".($comFecha == '' ?  'NULL' : "'".str_replace('T', ' ', $comFecha)."'").",?,?,getdate(),?,getdate(),?)";
                $dt = str_replace('T', ' ', $comFecha); 
                $par = array(FormatearNombre($tecComunicacion),FormatearNombre($txtLlama),$comSituacion,$ur,$ur);
            }
            $par= array_map('trim', $par);
            doSleepDB($tsql,$par,$tb);
        break;
        case 'Sleep_Comunicacion_HSAT':
            if($update){
                $tsql ="UPDATE Sleep_Comunicacion_HSAT
                    SET [Fecha] = ".($chFecha == '' ?  'NULL' : "'".str_replace('T', ' ', $chFecha)."'").",[Nombre_Paciente] = ?,[Llama_al_centro] = ?,[Num_Identificacion] = ?,[Asunto] = ?,[Solucion] = ?
                        ,[Tecnico] = ?,[Modified] = getdate(),[ModifiedBy] = ?
                    WHERE id=?";
                // $dt = str_replace('T', ' ', $chFecha); 
                $par = array(FormatearNombre($chName),FormatearNombre($chCaller),$chDispositivo,$chAsunto,$chSolucion,FormatearNombre($chTecnico),$ur,$id);
            }else{
                $tsql ="INSERT INTO Sleep_Comunicacion_HSAT
                    ([Fecha],[Nombre_Paciente],[Llama_al_centro],[Num_Identificacion],[Asunto],[Solucion],[Tecnico],[Created],[CreatedBy],[Modified],[ModifiedBy])
                VALUES (".($chFecha == '' ?  'NULL' : "'".str_replace('T', ' ', $chFecha)."'").",?,?,?,?,?,?,getdate(),?,getdate(),?)";
                // $dt = str_replace('T', ' ', $chFecha); 
                $par = array(FormatearNombre($chName),FormatearNombre($chCaller),$chDispositivo,$chAsunto,$chSolucion,FormatearNombre($chTecnico),$ur,$ur);
            }
            doSleepDB($tsql,$par,$tb);
        break;
        case 'Sleep_Registro_HSAT':
            if($update == '1'){
                $tsql = "UPDATE Sleep_Registro_HSAT
                    SET [Visit_id]=?,[Fecha] =".($rhFecha == '' ?  'NULL' : "'".str_replace('T', ' ', $rhFecha)."'").",[Nombre_Paciente] = ?,[Equipo] =?
                        ,[Inspeccion] = ?,[Comentarios] = ?
                        ,[Tecnico] = ?,[Modified] = getdate(),[ModifiedBy] = ?
                WHERE id=?";
                $par = array($vstId,FormatearNombre($rhName),$rhEquipo,$rhInspeccion,$rhComentarios,FormatearNombre($rhTecnico),$ur,$id);
            }else{
                $tsql ="INSERT INTO Sleep_Registro_HSAT
                    ([Visit_id],[Fecha],[Nombre_Paciente],[Equipo],[Inspeccion],[Comentarios],[Tecnico],[Created],[CreatedBy],[Modified],[ModifiedBy])
                VALUES (?,".($rhFecha == '' ?  'NULL' : "'".str_replace('T', ' ', $rhFecha)."'").",?,?,?,?,?,getdate(),?,getdate(),?)";
                $par = array($vstId,FormatearNombre($rhName),$rhEquipo,$rhInspeccion,$rhComentarios,FormatearNombre($rhTecnico),$ur,$ur);
            }
            //ucwords(strtolower($tecComunicacion)),$dt,ucwords(strtolower($txtLlama)),$comSituacion,$ur,$ur);
            $par= array_map('trim', $par);
            doSleepDB($tsql,$par,$tb);
        break;
        case 'Sleep_Devolucion_HSAT':
            if($update == '1'){
                $tsql = "UPDATE Sleep_Devolucion_HSAT
                    SET [Visit_id]=?,[Fecha] =".($rhFecha == '' ?  'NULL' : "'".str_replace('T', ' ', $rhFecha)."'").",[Nombre_Paciente] = ?,[Equipo] =?
                        ,[Inspeccion] = ?,[Comentarios] = ?
                        ,[Tecnico] = ?,[Modified] = getdate(),[ModifiedBy] = ?
                WHERE id=?";
                $par = array($vstId,FormatearNombre($rhName),$rhEquipo,$rhInspeccion,$rhComentarios,FormatearNombre($rhTecnico),$ur,$id);
            }else{
                $tsql ="INSERT INTO Sleep_Devolucion_HSAT
                    ([Visit_id],[Fecha],[Nombre_Paciente],[Equipo],[Inspeccion],[Comentarios],[Tecnico],[Created],[CreatedBy],[Modified],[ModifiedBy])
                VALUES (?,".($rhFecha == '' ?  'NULL' : "'".str_replace('T', ' ', $rhFecha)."'").",?,?,?,?,?,getdate(),?,getdate(),?)";
                $par = array($vstId,FormatearNombre($rhName),$rhEquipo,$rhInspeccion,$rhComentarios,FormatearNombre($rhTecnico),$ur,$ur);
            }
            //ucwords(strtolower($tecComunicacion)),$dt,ucwords(strtolower($txtLlama)),$comSituacion,$ur,$ur);
            $par= array_map('trim', $par);
            doSleepDB($tsql,$par,$tb);
        break;
        case 'Sleep_Rechazo':
            if($update){
                $tsql ="UPDATE Sleep_Rechazo
                    SET [Visit_ID] = ?,[Paciente]=?,[Fecha] = ".($fechaRechazo == '' ?  'NULL' : "'".str_replace('T', ' ', $fechaRechazo)."'").",[Razon] = ?,[Pasos_Adaptacion] = ?,[Firmado] = ?,[Tecnico] = ?,[Modified] = getdate(),[ModifiedBy] = ?
                    WHERE id=?";
                // echo $tsql ;
                    $par = array($visitRechazo,FormatearNombre($paciente),$razonRechazo,$radPasos,$radFirma,FormatearNombre($techRechazo),$ur,$id);
            }else{
                $tsql ="INSERT INTO Sleep_Rechazo ([Visit_ID],[Paciente],[Fecha],[Razon],[Pasos_Adaptacion],[Firmado],[Tecnico],[Created],[CreatedBy],[Modified],[ModifiedBy])
                    VALUES (?,?,".($fechaRechazo == '' ?  'NULL' : "'".$fechaRechazo."'").",?,?,?,?,getdate(),?,getdate(),?)";
                $par = array($visitRechazo,FormatearNombre($paciente),$razonRechazo,$radPasos,$radFirma,FormatearNombre($techRechazo),$ur,$ur);
            }
            $par= array_map('trim', $par);
            doSleepDB($tsql,$par,$tb);
        break;
        case 'Sleep_Endozime':
            if($update){
                $tsql="UPDATE Sleep_Endozime
                SET [Fecha_Preparacion] = ".($fechaPreparacion == '' ?  'NULL' : "'".str_replace('T', ' ', $fechaPreparacion)."'").
                    ",[Fecha_Expira] = ".($expiracionEndozime == '' ?  'NULL' : "'".$expiracionEndozime."'").",[Temperatura] = ?,[Tecnico] = ?,[Modified] = getdate(),[ModifiedBy] = ?
                WHERE id=?";
                //$dt = str_replace('T', ' ', $fechaPreparacion);
                $par = array($tempEndozime,FormatearNombre($etcoTecnico),$ur,$id);    
            }else{
                $tsql ="INSERT INTO Sleep_Endozime
                ([Fecha_Preparacion],[Fecha_Expira],[Temperatura],[Tecnico],[Created],[CreatedBy],[Modified],[ModifiedBy])
                    VALUES (".($fechaPreparacion == '' ?  'NULL' : "'".str_replace('T', ' ', $fechaPreparacion)."'").",".
                              ($expiracionEndozime == '' ?  'NULL' : "'".$expiracionEndozime."'").",?,?,getdate(),?,getdate(),?)";
                //$dt = str_replace('T', ' ', $fechaPreparacion);
                $par = array($tempEndozime,FormatearNombre($etcoTecnico),$ur,$ur);
            }
            $par= array_map('trim', $par);
            doSleepDB($tsql,$par,$tb);
        break;
        case 'Sleep_Ojos':
            if($update){
                $tsql='UPDATE [dbo].[Sleep_Ojos]
                SET [Fecha] = ?,[Tecnico] = ?,[Modified] = getdate(),[ModifiedBy] = ? WHERE id=?';
                //$dt = str_replace('T', ' ', $fechaDucha); 
                $par = array($fechaDucha,FormatearNombre($tecDucha),$ur,$id);
            }else{
                $tsql ="INSERT INTO Sleep_Ojos
                ([Fecha],[Tecnico],[Created],[CreatedBy],[Modified],[ModifiedBy])
                    VALUES (?,?,getdate(),?,getdate(),?)";
                // $dt = str_replace('T', ' ', $fechaDucha); 
                $par = array($fechaDucha,FormatearNombre($tecDucha),$ur,$ur);
            }
            $par= array_map('trim', $par);
            doSleepDB($tsql,$par,$tb);
        break;
        case 'Sleep_ETCO':
            if($update == '1'){
                $tsql = 'UPDATE Sleep_ETCO
                    SET [Fecha] = '.($etcoDesinfeccion == '' ?  'NULL' : "'".$etcoDesinfeccion."'").',[Tecnico] = ?,[Modelo] = ?,[Modified] = GETDATE(),[ModifiedBy] = ? WHERE id=?';
                $par = array(FormatearNombre($etcoTecnico),$etcoModelo,$ur,$id);
            }else {
                $tsql ="INSERT INTO Sleep_ETCO
                ([Fecha],[Tecnico],[Modelo],[Created],[CreatedBy],[Modified],[ModifiedBy])
                    VALUES (".($etcoDesinfeccion == '' ?  'NULL' : "'".$etcoDesinfeccion."'").",?,?,getdate(),?,getdate(),?)";
                $par = array(FormatearNombre($etcoTecnico),$etcoModelo,$ur,$ur);
            }
            $par= array_map('trim', $par);
            doSleepDB($tsql,$par,$tb);
        break;
        case 'Sleep_Desinfeccion_CPAP':
            //si tiene menos de 5 caracteres se cambia a todas mayuscaulas entendiendo que son iniciales, de lo contrario solo la primera leta de cada palabra a mayuscula
            if($update == "1"){
                $tsql = "UPDATE Sleep_Desinfeccion_CPAP
                    SET [Fecha] = ".($fechaDesinfeccion == '' ?  'NULL' : "'".$fechaDesinfeccion."'").
                        ",[Fecha_Filtro] = ".($DesinfeccionFiltro == '' ?  'NULL' : "'".$DesinfeccionFiltro."'").
                        ",[Fecha_Cambio] = ".($CambioFiltro == '' ?  'NULL' : "'".$CambioFiltro."'").",[Camas] = ?,[Tecnico] = ?,[Modified] = getdate(),[ModifiedBy] = ?
                        WHERE id = ?";       
                $camas = implode(',',$ckCamas);
                $par = array($camas,FormatearNombre($txtTecnico),$ur,$id);
            }else {
                $tsql ="INSERT INTO Sleep_Desinfeccion_CPAP
                    ([Fecha],[Fecha_Filtro],[Fecha_Cambio],[Camas],[Tecnico],[Created],[CreatedBy],[Modified],[ModifiedBy])
                        VALUES (".($fechaDesinfeccion == '' ?  'NULL' : "'".$fechaDesinfeccion."'")."
                                ,".($DesinfeccionFiltro == '' ?  'NULL' : "'".$DesinfeccionFiltro."'")."
                                ,".($CambioFiltro == '' ?  'NULL' : "'".$CambioFiltro."'").",?,?, getdate(),?,getdate(),?)";
                $camas = implode(',',$ckCamas);
                $par = array($camas,FormatearNombre($txtTecnico),$ur,$ur);
            } 
            $par= array_map('trim', $par);
            doSleepDB($tsql,$par,$tb);
        break;
        case 'Sleep_Frasco_Cidex':
            if($update =='1'){
                $tsql = "UPDATE [dbo].[Sleep_Frasco_Cidex]
                    SET [Fecha] = ".($fechaDePrueba == '' ?  'NULL' : "'".$fechaDePrueba."'").",[Temperatura] = ?,[Lote_Solucion] = ?
                    ,[Fecha_Abierto_Solucion] = ".($frascoAbierto == '' ?  'NULL' : "'".$frascoAbierto."'")."
                    ,[Fecha_Expira_Solucion] = ".($expiraSolucion == '' ?  'NULL' : "'".$expiraSolucion."'")."
                    ,[Lote_Tirillas] = ?
                    ,[Fecha_Abierto_Tirillas] = ".($abiertoTirillas == '' ?  'NULL' : "'".$abiertoTirillas."'")."
                    ,[Fecha_Expira_Tirillas]  = ".($expiraTirilla == '' ?  'NULL' : "'".$expiraTirilla."'")."
                    ,[Resultado_Puro1] = ?,[Resultado_Puro2] = ?,[Resultado_Puro3] = ?,[Resultado_Diluido1] = ?,[Resultado_Diluido2] = ?,[Resultado_Diluido3] = ?
                    ,[Acciones] = ?,[Tecnico] = ?
                    ,[Fecha_Expira_Frasco_Sol] = ".($expiracionSolucion == '' ?  'NULL' : "'".$expiracionSolucion."'")."
                    ,[Fecha_Expira_Frasco_Tir] = ".($expiracionTirillas == '' ?  'NULL' : "'".$expiracionTirillas."'")."
                    ,[Modified] = getdate(),[ModifiedBy] = ?
                WHERE id = ?";
                $par = array($txtTemperatura,$loteFrasco,$loteTirillas,
                    $ddResultadoTirilla1,$ddResultadoTirilla2,$ddResultadoTirilla3,$ddResultadoDiluido1,$ddResultadoDiluido2,
                    $ddResultadoDiluido3,$txtAccionesCorrectivas,FormatearNombre($techTest),$ur,$id);//13
            }else{
                $tsql ="INSERT INTO Sleep_Frasco_Cidex
                    ([Fecha],[Temperatura],[Lote_Solucion],[Fecha_Abierto_Solucion],[Fecha_Expira_Solucion],[Lote_Tirillas],[Fecha_Abierto_Tirillas]
                    ,[Fecha_Expira_Tirillas],[Resultado_Puro1],[Resultado_Puro2],[Resultado_Puro3],[Resultado_Diluido1],[Resultado_Diluido2]
                    ,[Resultado_Diluido3],[Acciones],[Tecnico],[Fecha_Expira_Frasco_Sol],[Fecha_Expira_Frasco_Tir],[Created],[CreatedBy],[Modified],[ModifiedBy])
                VALUES (".($fechaDePrueba == '' ?  'NULL' : "'".$fechaDePrueba."'").",?,?
                    ,".($frascoAbierto == '' ?  'NULL' : "'".$frascoAbierto."'")."
                    ,".($expiraSolucion == '' ?  'NULL' : "'".$expiraSolucion."'")."
                    ,?
                    ,".($abiertoTirillas == '' ?  'NULL' : "'".$abiertoTirillas."'")."
                    ,".($expiraTirilla == '' ?  'NULL' : "'".$expiraTirilla."'")."
                    ,?,?,?,?,?,?,?,?,".($expiracionSolucion == '' ?  'NULL' : "'".$expiracionSolucion."'")."
                    ,".($expiracionTirillas == '' ?  'NULL' : "'".$expiracionTirillas."'").",getdate(),?,getdate(),?)";//22
                    $par = array($txtTemperatura,$loteFrasco,$loteTirillas,$ddResultadoTirilla1,$ddResultadoTirilla2,$ddResultadoTirilla3,
                    $ddResultadoDiluido1,$ddResultadoDiluido2,$ddResultadoDiluido3,$txtAccionesCorrectivas,FormatearNombre($techTest),$ur,$ur);//13
                    // $par = array($fechaDePrueba,$txtTemperatura,$loteFrasco,$frascoAbierto,$expiraSolucion,$loteTirillas,$abiertoTirillas,
                    //     $expiraTirilla,$ddResultadoTirilla1,$ddResultadoTirilla2,$ddResultadoTirilla3,$ddResultadoDiluido1,$ddResultadoDiluido2,
                    //     $ddResultadoDiluido3,$txtAccionesCorrectivas,FormatearNombre($techTest),$expiracionSolucion,$expiracionTirillas,$ur,$ur);//20
            }
            $par= array_map('trim', $par);
            doSleepDB($tsql,$par,$tb);
        break;
        case 'Sleep_Solucion_Cidex':
            if($update){
                $tsql = "UPDATE Sleep_Solucion_Cidex
                    SET [Fecha] = ".($fechaSolucion == '' ?  'NULL' : "'".$fechaSolucion."'").
                        ",[Departamento] = ?
                        ,[Fecha_abierto] = ".($fechaFrasco == '' ?  'NULL' : "'".str_replace('T', ' ', $fechaFrasco)."'")."
                        ,[No_usar_despues] = ".($fechaExpiracion == '' ?  'NULL' : "'".$fechaExpiracion."'")."
                        ,[Lote_Tirillas] =?
                        ,[Resultado_Calidad] = ?
                        ,[Fecha_Prueba_Calidad] = ".($fechaCalidad == '' ?  'NULL' : "'".$fechaCalidad."'")."
                        ,[Probada_por] = ?
                        ,[Visit_ID] = ?
                        ,[Fecha_Comienzo] = ".($fechaComienzo == '' ?  'NULL' : "'".$fechaComienzo."'")."
                        ,[Fecha_Expiracion] = ".($fechaExpiraSolucion == '' ?  'NULL' : "'".$fechaExpiraSolucion."'")."
                        ,[Fecha_Prueba_Solucion] =".($fechaPrueba == '' ?  'NULL' : "'".str_replace('T', ' ', $fechaPrueba)."'")."
                        ,[Resultado_Solucion] = ?
                        ,[Temperatura] = ?
                        ,[Ausencia_Turbidez] = ?
                        ,[Ausencia_Materia] = ?
                        ,[Accion] = ?
                        ,[Equipo] = ?
                        ,[Fecha_Inmersion] = ".($fechaInmersion == '' ?  'NULL' : "'".str_replace('T', ' ', $fechaInmersion)."'")."
                        ,[Tiempo_inmersion] = ?,[Liqueo] = ?,[Realizada_por] =?
                        ,[Hora_Inmersion] = ".($terminacion == '' ?  'NULL' : "'".$terminacion."'")."
                        ,[Modified] = getdate(),[ModifiedBy] = ?
                    WHERE id=?";
                // $dt = str_replace('T', ' ', $fechaFrasco);
                // $dt2 = str_replace('T', ' ', $fechaInmersion);
                $equipo = implode(',',$ckEquipo);
                $par = array($txtDept,$numeroLote,$ddPruebaRes,FormatearNombre($txtProbada),$visitIdSolucion,$cpapEquipo,$solTemp,$ddTurbidez,$ddMateria,$txtCorrectivas,$equipo,
                    $tiempoInmersion,$txtLiqueo,FormatearNombre($techPrueba),$ur,$id);//
            }else{
                $tsql ="INSERT INTO Sleep_Solucion_Cidex
                    ([Fecha],[Departamento],[Fecha_abierto],[No_usar_despues],[Lote_Tirillas],[Resultado_Calidad],[Fecha_Prueba_Calidad],[Probada_por],[Visit_ID]
                    ,[Fecha_Comienzo],[Fecha_Expiracion],[Fecha_Prueba_Solucion],[Resultado_Solucion],[Temperatura],[Ausencia_Turbidez]
                    ,[Ausencia_Materia],[Accion],[Equipo],[Fecha_Inmersion],[Tiempo_inmersion],[Liqueo],[Realizada_por],[Hora_Inmersion],[Created],[CreatedBy],[Modified],[ModifiedBy])
                VALUES (".($fechaSolucion == '' ?  'NULL' : "'".$fechaSolucion."'").
                        ",?
                        ,".($fechaFrasco == '' ?  'NULL' : "'".str_replace('T', ' ', $fechaFrasco)."'")."
                        ,".($fechaExpiracion == '' ?  'NULL' : "'".$fechaExpiracion."'")."
                        ,?,?,".($fechaCalidad == '' ?  'NULL' : "'".$fechaCalidad."'")."
                        ,?,?,".($fechaComienzo == '' ?  'NULL' : "'".$fechaComienzo."'")."
                        ,".($fechaExpiraSolucion == '' ?  'NULL' : "'".$fechaExpiraSolucion."'")."
                        ,".($fechaPrueba == '' ?  'NULL' : "'".str_replace('T', ' ', $fechaPrueba)."'")."
                        ,?,?,?,?,?,?
                        ,".($fechaInmersion == '' ?  'NULL' : "'".str_replace('T', ' ', $fechaInmersion)."'")."
                        ,?,?,?
                        ,".($terminacion == '' ?  'NULL' : "'".$terminacion."'").",getdate(),?,getdate(),?)";
                $dt = str_replace('T', ' ', $fechaFrasco); 
                $dt2 = str_replace('T', ' ', $fechaInmersion); 
                $equipo = implode(',',$ckEquipo);
                $par = array($txtDept,$numeroLote,$ddPruebaRes,FormatearNombre($txtProbada),$visitIdSolucion,$cpapEquipo,$solTemp,$ddTurbidez,$ddMateria,$txtCorrectivas,$equipo,
                    $tiempoInmersion,$txtLiqueo,FormatearNombre($techPrueba),$ur,$ur);//
                // $par = array($txtDept,$fechaFrasco,$fechaExpiracion,$numeroLote,$ddPruebaRes,$fechaCalidad,ucwords(strtolower($txtProbada)),$visitIdSolucion,$fechaComienzo,
                //     $fechaExpiraSolucion,$dt,$cpapEquipo,$solTemp,$ddTurbidez,$ddMateria,$txtCorrectivas,$equipo,$dt2,
                //     $tiempoInmersion,$txtLiqueo,ucwords(strtolower($techPrueba)),$terminacion,$ur,$ur);//
            }
            $par= array_map('trim', $par);
            doSleepDB($tsql,$par,$tb);
        break;
        case 'Sleep_HSAT':
            if($update){
                $tsql = "UPDATE Sleep_HSAT
                SET [Fecha] = ".($hsatFecha == '' ?  'NULL' : "'".$hsatFecha."'").",[Modelo] = ?,[Tecnico] = ?,[Modified] = GETDATE(),[ModifiedBy] = ? WHERE id=?";
                $par = array($hsatModelo,FormatearNombre($hsatTecnico),$ur,$id);
            }else{
                $tsql ="INSERT INTO Sleep_HSAT
                ([Fecha],[Tecnico],[Modelo],[Created],[CreatedBy],[Modified],[ModifiedBy])
                    VALUES (".($hsatFecha == '' ?  'NULL' : "'".$hsatFecha."'").",?,?,GETDATE(),?,GETDATE(),?)";
                $par = array(FormatearNombre($hsatTecnico),$hsatModelo,$ur,$ur);
            }           
            $par= array_map('trim', $par);
            doSleepDB($tsql,$par,$tb);
        break;
        case 'Sleep_TCPCO':
            // echo $update;
            if($update){
                $tsql ="UPDATE Sleep_TCPCO
                    SET [Fecha] = ".($tcpcFecha == '' ?  'NULL' : "'".$tcpcFecha."'").",[Modelo] = ?,[Tecnico] = ?,[Modified] = getdate(),[ModifiedBy] = ?
                    WHERE id=?";
                $par = array($tcpcModelo,FormatearNombre($tcpcTecnico),$ur,$id);
            }else{
                $tsql ="INSERT INTO Sleep_TCPCO
                ([Fecha],[Tecnico],[Modelo],[Created],[CreatedBy],[Modified],[ModifiedBy])
                    VALUES (".($tcpcFecha == '' ?  'NULL' : "'".$tcpcFecha."'").",?,?,getdate(),?,getdate(),?)";
                $par = array(FormatearNombre($tcpcTecnico),$tcpcModelo,$ur,$ur);
            }
            $par= array_map('trim', $par);
            doSleepDB($tsql,$par,$tb);
        break;
        case 'Sleep_Mant_Cap':
            if($update == '1') {
                $tsql ="UPDATE Sleep_Mant_Cap
                    SET [Fecha] = ".($fechaMant == '' ?  'NULL' : "'".str_replace('T', ' ', $fechaMant)."'").",[Equipo] = ?,[Notas] = ?,[Tecnico] = ?,[Modified] = getdate(),[ModifiedBy] = ? WHERE id=?";
                $par = array($equipo,$notas,FormatearNombre($tecnico),$ur,$id);

            } else {
                $tsql ="INSERT INTO Sleep_Mant_Cap
                    ([Fecha],[Equipo],[Notas],[Tecnico],[Created],[CreatedBy],[Modified],[ModifiedBy])
                    VALUES (".($fechaMant == '' ?  'NULL' : "'".str_replace('T', ' ', $fechaMant)."'").",?,?,?,getdate(),?,getdate(),?)";
                $par = array($equipo,$notas,FormatearNombre($tecnico),$ur,$ur);
            }
            $par= array_map('trim', $par);
            doSleepDB($tsql,$par,$tb);
        break;
        case 'Sleep_Mant_PAP':
            if($update == '1') {
                $tsql ="UPDATE Sleep_Mant_PAP
                    SET [Fecha] = ".($fechaMant == '' ?  'NULL' : "'".str_replace('T', ' ', $fechaMant)."'").",[Equipo] = ?,[Cama] = ?,
                        [Notas] = ?,[Tecnico] = ?,[Modified] = getdate(),[Modifiedby] = ? WHERE id=?";
                $par = array($equipo,$cama,$notas1,FormatearNombre($txtTecnico),$ur,$id);
            } else {
                $tsql ="INSERT INTO Sleep_Mant_PAP
                        ([Fecha],[Equipo],[Cama],[Notas],[Tecnico],[Created],[Createdby],[Modified],[Modifiedby])
                    VALUES (".($fechaMant == '' ?  'NULL' : "'".str_replace('T', ' ', $fechaMant)."'").",?,?,?,?,getdate(),?,getdate(),?)";
                $par = array($equipo,$cama,$notas1,FormatearNombre($txtTecnico),$ur,$ur);
            }
            $par= array_map('trim', $par);
            doSleepDB($tsql,$par,$tb);
        break;
        case 'Sleep_Mant_HA':
            if($update == '1') {
                $tsql ="UPDATE Sleep_Mant_HA
                    SET [Fecha] = ".($fechaMant == '' ?  'NULL' : "'".str_replace('T', ' ', $fechaMant)."'")." ,[Headbox] = ?,[Cama1] = ?,[Amplificadores] = ?
                        ,[Cama2] = ?,[Notas] = ?,[Tecnico] = ?,[Modified] = getdate(),[Modifiedby] = ? WHERE id=?";
                $par = array($Headbox,$cama1,$amplificadores,$cama2,$notas1,FormatearNombre($txtTecnico),$ur,$id);

            } else {
                $tsql ="INSERT INTO Sleep_Mant_HA
                        ([Fecha],[Headbox],[Cama1],[Amplificadores],[Cama2],[Notas],[Tecnico],[Created],[Createdby],[Modified],[Modifiedby])
                    VALUES (".($fechaMant == '' ?  'NULL' : "'".str_replace('T', ' ', $fechaMant)."'").",?,?,?,?,?,?,getdate(),?,getdate(),?)";
                $par = array($Headbox,$cama1,$amplificadores,$cama2,$notas1,FormatearNombre($txtTecnico),$ur,$ur);
            }
            $par= array_map('trim', $par);
            doSleepDB($tsql,$par,$tb);
        break;
        case 'Sleep_Mant_Equipos':
            $equipos = implode(',',$ckEquipo);
            if($update == '1') {
                $tsql ="UPDATE Sleep_Mant_Equipos
                    SET [Fecha] = ".($fechaMant == '' ?  'NULL' : "'".str_replace('T', ' ', $fechaMant)."'").",[Equipos] = ?,
                        [Notas] = ?,[Tecnico] = ?,[Modified] = getdate(),[Modifiedby] = ? WHERE id=?";
                    $par = array($equipos,$notas1,FormatearNombre($txtTecnico),$ur,$id);
                    } else {
                $tsql ="INSERT INTO Sleep_Mant_Equipos
                        ([Fecha],[Equipos],[Notas],[Tecnico],[Created],[Createdby],[Modified],[Modifiedby])
                    VALUES (".($fechaMant == '' ?  'NULL' : "'".str_replace('T', ' ', $fechaMant)."'").",?,?,?,getdate(),?,getdate(),?)";
                $par = array($equipos,$notas1,FormatearNombre($txtTecnico),$ur,$ur);
            }
            $par= array_map('trim', $par);
            doSleepDB($tsql,$par,$tb);
        break;
        case 'Sleep_Biomedica_Equipos':
            if($update == '1') {
                $tsql ="UPDATE Sleep_Biomedica_Equipos
                    SET [Equipo] = ?,[Problema] = ?,[Reportado] = ".($reportado == '' ?  'NULL' : "'".str_replace('T', ' ', $reportado)."'").",[Reporto] =?,
                        [Envio] = ".($fechaEnvio == '' ?  'NULL' : "'".str_replace('T', ' ', $fechaEnvio)."'").",[Tracking] = ?,
                        [Recibido] = ".($recibido == '' ?  'NULL' : "'".str_replace('T', ' ', $recibido)."'").",[Notas] = ?,[Tecnico] = ?,[Modified] = getdate(),[Modifiedby] = ? WHERE id=?";
                $par = array($equipo,$problema,$reporto,$tracking,$notas1,FormatearNombre($biomedico),$ur,$id);
            } else {
                $tsql ="INSERT INTO Sleep_Biomedica_Equipos
                        ([Equipo],[Problema],[Reportado],[Reporto],[Envio],[Tracking],[Recibido],[Notas],[Tecnico],[Created],[Createdby],[Modified],[Modifiedby])
                    VALUES (?,?,".($reportado == '' ?  'NULL' : "'".str_replace('T', ' ', $reportado)."'").",?,".($fechaEnvio == '' ?  'NULL' : "'".str_replace('T', ' ', $fechaEnvio)."'").",
                        ?,".($recibido == '' ?  'NULL' : "'".str_replace('T', ' ', $recibido)."'").",?,?,getdate(),?,getdate(),?)";
                $par = array($equipo,$problema,$reporto,$tracking,$notas1,FormatearNombre($biomedico),$ur,$ur);
            }
            $par= array_map('trim', $par);
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
    $stmt = sqlsrv_prepare($conn, $tsql, $params); 
    // echo $tb;
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

function getRepTittle($tb){
    //Titulos para el listados de datos en rpt.php
    switch ($tb) {
        case 'Sleep_Comunicacion_HSAT':
            return 'Log de Desinfección del HSAT';
        break;
        case 'Sleep_Devolucion_HSAT':
            return 'Registro de Devolucion del HSAT';
        break;
        case 'Sleep_Registro_HSAT':
            return 'Log de Registro y Mantenimiento del HSAT';
        break;
        case 'Sleep_HSAT':
            return 'Log de Desinfección del HSAT';
        break;
        case 'Sleep_TCPCO':
            return 'Log de Desinfección de tcPCO2';
        break;
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
        case 'Sleep_Biomedica_Equipos':
            return 'Equipos enviados para reparación';
        break;
        case 'Sleep_Mant_Equipos':
            return 'Mantenimiento Equipos';
        break;
        case 'Sleep_Mant_HA':
            return 'Mantenimiento Preventivo Headbox y Amplificadores';
        break;
        case 'Sleep_Mant_PAP':
            return 'Mantenimiento Preventivo PAP';
        break;
        case 'Sleep_Mant_Cap':
            return 'Mantenimiento Preventivo Capnografo';
        break;
        default:
        break;
    }   
}

function getEditLnk($tb){
    switch ($tb) {
        case 'Sleep_Comunicacion_HSAT':
            return 'logComunicacionHSAT';
        break;
        case 'Sleep_Registro_HSAT':
            return 'logResgistroHSAT';
        break;
        case 'Sleep_Devolucion_HSAT':
            return 'logDevolucionHSAT';
        break;
        case 'Sleep_HSAT':
            return 'HSAT';
        break;
        case 'Sleep_TCPCO':
            return 'tcPCO2';
        break;
        case 'Sleep_Studies_Results':
            return 'SleepStudies';
        break;
        case 'Sleep_Listado_Expedientes':
            return 'lstExpedientes';
        break;
        case 'Sleep_Listado_Referidos':
            return 'lstReferidos';
        break;
        case 'Sleep_Inspeccion_Rutina':
            return 'InspeccionVisual';
        break;
        case 'Sleep_Registro_Paciente':
            return 'MaskFitting';
        break;
        case 'Sleep_Valores_Criticos':
            return 'ValCriticos';
        break;
        case 'Sleep_CPAP_Prestados':
            return 'LogCPAP';
        break;
        case 'Sleep_Comunicacion':
            return 'logComunicacion';
        break;
        case 'Sleep_Rechazo':
            return 'logRechazo';
        break;
        case 'Sleep_Endozime':
            return 'UsoManejo';
        break;
        case 'Sleep_Ojos':
            return 'DuchasOjos';
        break;
        case 'Sleep_ETCO':
            return 'ETCO2';
        break;
        case 'Sleep_Desinfeccion_CPAP':
            return 'CPAP';
        break;
        case 'Sleep_Frasco_Cidex':
            return 'frascoCIdex';
        break;
        case 'Sleep_Solucion_Cidex':
            return 'solucionCidex';
        break;
        case 'Sleep_Mant_Cap':
            return 'MantCAP';
        break;
        case 'Sleep_Mant_PAP':
            return 'MantPAP';
        break;
        case 'Sleep_Mant_HA':
            return 'MantHA';
        break;
        case 'Sleep_Mant_Equipos':
            return 'MantEq';
        break;
        case 'Sleep_Biomedica_Equipos':
            return 'BioEq';
        break;
        default:
        break;
    }
}

function gSleepTable($data,$tabla,$tsql, $opt = "0" ){
    // var_dump($data);
    // echo $tsql;
    $x=0; $html ='';
    // echo "<tr><td colspan='500'><center><b><h4>".getRepTittle($tabla).' - '.$opt."</h4></b></center></td></tr>";
    foreach(sqlsrv_field_metadata($data) as $field){
        $campos[]= $field['Name'];
        $titulo = str_replace("_"," ",$field['Name']);
        if($x == 0){
            $html .='<th class="noprint" ><span onclick=\'sortTable("'.$tabla.'","'.$field['Name'].'");\'></span></th>';
        }else{      
            $html .= '<th><span onclick=\'sortTable("'.$tabla.'","'.$field['Name'].'");\'>'.$titulo.'</span></th>';
        }
        $x++;
    }
    echo '</tr>';
    if($opt =='0') echo $html;
    echo '<tr>'; //#FFF7F9
    while ($row = sqlsrv_fetch_array($data, SQLSRV_FETCH_BOTH)){
        for ($j = 0; $j < $x; $j++) {
            $fld = $campos[$j];
            if($j > 0){
                if ($row[$j] instanceof DateTime) {
                    $d = $row[$j]->format('m/d/Y H:i:s');
                    $d = str_replace("00:00:00","",$d);
                    echo "<td class='hd-table'>".$d.'<input type="hidden" name="'.$fld.'_'.$id.'" id="'.$fld.'_'.$id.'" value="'.$d.'"></td>';
                }else{
                    $value = ($row[$j] == '' ? '-' : $row[$j]) ;
                    echo "<td class='hd-table'>".$value.'<input type="hidden" name="'.$fld.'_'.$id.'" id="'.$fld.'_'.$id.'" value="'.$value.'"></td>';
                }
            }else{
                $id =$row[$j] ;
                // echo '<td class="noprint hd-table"><a href="#" data-toggle="modal" id="myBtn" class="noprint edit" data-id="sleepedit.php?id='.$id.'&tb='.$tabla.'">'.$id.'</a></td>';
                echo '<td class="noprint hd-table"><a href="#" data-toggle="modal" id="myBtn" class="noprint edit" data-id="sleepedit.php?id='.$id.'&tb='.$tabla.'"><i class="fa-solid fa-pencil"></i></a></td>';
            }
        }
        //$x++;
        echo '</form></tr>';
    }
    // echo "<tr><td colspan='5000'>$tsql</td></tr>";
    echo "</table>";

}

function gRegistrosSEA($visit){
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

function FormatearNombre($string){
    if(strlen($string) < 5){
        return strtoupper($string);
    }else{
        return ucwords(strtolower($string));
    }
}
