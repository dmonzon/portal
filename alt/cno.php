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
?>

