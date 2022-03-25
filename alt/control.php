<?php
function floattostr( $val )
{
    preg_match( "#^([\+\-]|)([0-9]*)(\.([0-9]*?)|)(0*)$#", trim($val), $o );
    return $o[1].sprintf('%d',$o[2]).($o[3]!='.'?$o[3]:'');
}

function fCapitado($data){
    require_once("cno.php");
    $db = new ServidorBD();
    $conn = $db->Conectar('a');
    extract($data);
    // echo ' <pre>';
    // var_dump($data);
    $created = date('Y-m-d H:i:s');
    $tsql = "SELECT * from [Capitados] ";
    $stmt = sqlsrv_prepare( $conn, $tsql , array((int) $periodo),array( "Scrollable" => SQLSRV_CURSOR_KEYSET ));  
  
    if( sqlsrv_execute( $stmt ) === false ) {
        die( print_r( sqlsrv_errors(), true));
    }
    if ($stmt !== NULL) {  
        $rows = sqlsrv_has_rows( $stmt );  
    }
    sqlsrv_free_stmt($stmt);
    // echo "$rows record(s)</br>" ;
    if($rows === true){
        $tsql = "UPDATE [dbo].[Capitados] set [modified] = (select GETDATE())";
        //$params[] = $created;
        if ($capiOct >= 0) {$tsql .= ',[CapOct] = ?';$params[] = $capiOct;}
        if ($capiNov >= 0) {$tsql .= ',[CapNov] = ?';$params[] = $capiNov;}
        if ($capiDic >= 0) {$tsql .= ',[CapDic] = ?';$params[] = $capiDic;}
        if ($capiEne >= 0) {$tsql .= ',[CapEne] = ?';$params[] = $capiEne;}
        if ($capiFeb >= 0) {$tsql .= ',[CapFeb] = ?';$params[] = $capiFeb;}
        if ($capiMar >= 0) {$tsql .= ',[CapMar] = ?';$params[] = $capiMar;}
        if ($capiAbr >= 0) {$tsql .= ',[CapAbr] = ?';$params[] = $capiAbr;}
        if ($capiMay >= 0) {$tsql .= ',[CapMay] = ?';$params[] = $capiMay;}
        if ($capiJun >= 0) {$tsql .= ',[CapJun] = ?';$params[] = $capiJun;}
        if ($capiJul >= 0) {$tsql .= ',[CapJul] = ?';$params[] = $capiJul;}
        if ($capiAgo >= 0) {$tsql .= ',[CapAgo] = ?';$params[] = $capiAgo;}
        if ($capiSep >= 0) {$tsql .= ',[CapSep] = ?';$params[] = $capiSep;}
        if ($pagosOct >= 0) {$tsql .= ',[PagosOct] = ?';$params[] = $pagosOct;}
        if ($pagosNov >= 0) {$tsql .= ',[PagosNov] = ?';$params[] = $pagosNov;}
        if ($pagosDic >= 0) {$tsql .= ',[PagosDic] = ?';$params[] = $pagosDic;}
        if ($pagosEne >= 0) {$tsql .= ',[PagosEne] = ?';$params[] = $pagosEne;}
        if ($pagosFeb >= 0) {$tsql .= ',[PagosFeb] = ?';$params[] = $pagosFeb;}
        if ($pagosMar >= 0) {$tsql .= ',[PagosMar] = ?';$params[] = $pagosMar;}
        if ($pagosAbr >= 0) {$tsql .= ',[PagosAbr] = ?';$params[] = $pagosAbr;}
        if ($pagosMay >= 0) {$tsql .= ',[PagosMay] = ?';$params[] = $pagosMay;}
        if ($pagosJun >= 0) {$tsql .= ',[PagosJun] = ?';$params[] = $pagosJun;}
        if ($pagosJul >= 0) {$tsql .= ',[PagosJul] = ?';$params[] = $pagosJul;}
        if ($pagosAgo >= 0) {$tsql .= ',[PagosAgo] = ?';$params[] = $pagosAgo;}
        if ($pagosSep >= 0) {$tsql .= ',[PagosSep] = ?';$params[] = $pagosSep;}
        $tsql .= " where [periodo] = ?";
        $params[] = (int) $periodo;
        $stmt = sqlsrv_prepare( $conn, $tsql, $params);  
        if( sqlsrv_execute( $stmt))  
        {  
            echo '<div id="msg" class="msg">Successfully updated!</div>';  
        }else{ 
            echo '<pre>' ;
            die( print_r( sqlsrv_errors(), true));  
        }
        // aactualizar totales
        $sql = 'update dbo.Capitados set [TotalCapitados] = [CapOct]+[CapNov]+[CapDic]+[CapEne]+[CapFeb]+[CapMar]+[CapAbr]+[CapMay]+[CapJun]+[CapJul]+[CapAgo]+[CapSep],
        [TotalPagos] = [PagosOct]+[PagosNov]+[PagosDic]+[PagosEne]+[PagosFeb]+[PagosMar]+[PagosAbr]+[PagosMay]+[PagosJun]+[PagosJul]+[PagosAgo]+[PagosSep] where periodo=?';
        //sqlsrv_free_stmt($stmt);
        $stmt = sqlsrv_prepare( $conn, $sql , array($periodo),array( "Scrollable" => SQLSRV_CURSOR_KEYSET ));  
        if( sqlsrv_execute( $stmt ) === false ) {
            die( print_r( sqlsrv_errors(), true));
        }else{
            return '<div id="msg" class="msg">Successfully updated!</div>';
        }
        if ($stmt !== NULL) {  
            $rows = sqlsrv_has_rows( $stmt );  
        }
        // var_dump($stmt);
        // echo $rows."..</br>";
        
    }elseif($option == 0){
        $tsql = "INSERT into [dbo].[Capitados]
        ([CapOct],[CapNov],[CapDic],[CapEne],[CapFeb],[CapMar],[CapAbr],[CapMay],[CapJun],[CapJul],[CapAgo],[CapSep]
        ,[PagosOct],[PagosNov],[PagosDic],[PagosEne],[PagosFeb],[PagosMar],[PagosAbr],[PagosMay],[PagosJun],[PagosJul],[PagosAgo],[PagosSep]
        ,[TotalCapitados],[TotalPagos],[Periodo],[created]) Values(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
        $params = array($capiOct,$capiNov,$capiDic,$capiEne,$capiFeb,$capiMar,$capiAbr,$capiMay,$capiJun,$capiJul,$capiAgo,$capiSep,
        $pagosOct,$pagosNov,$pagosDic,$pagosEne,$pagosFeb,$pagosMar,$pagosAbr,$pagosMay,$pagosJun,$pagosJul,$pagosAgo,$pagosSep,$TotalCapitados,$TotalPagos,$periodo,$created);
        // echo count($params).'</br>';
        // echo $tsql;
        $stmt = sqlsrv_prepare( $conn, $tsql, $params);  
        if( sqlsrv_execute( $stmt))  
        {  
            echo '<div id="msg" class="msg">Successfully updated!</div>';  
        }else{ 
            echo '<pre>' ;
            die( print_r( sqlsrv_errors(), true));  
        }
    }

    $db->Desconectar();
}

function newRecord(array $post){
    require_once("cno.php");
    $db = new ServidorBD();
    $conn = $db->Conectar('i');
    $period = $post['ddPeriod']. '/' . $post['period'] ;
    $costcenter = $post['costcenter'] ;
    $dcl = $post['DCL'];$rcc1 = $post['RCC1'];
    $ilc = $post['ILC'];$rcc2 = $post['RCC2'];
    $olc = $post['OLC'];$rcc3 = $post['RCC3'];
    $icc = $post['ICC'];$rcc4 = $post['RCC4'];
    $ica = $post['ICA'];$rcc5 = $post['RCC5'];
    $ici = $post['ICI'];$rcc6 = $post['RCC6'];
    $ogc = $post['OGC'];$rcc7 = $post['RCC7'];
    $totcs = $post['TOTCS'];$totch = $post['TOTCH'];$rccTot  = $post['RCCTOT'];
    $note  = $post['note'];
    $created = date('Y-m-d H:i:s');
    $tsql = "INSERT INTO [dbo].[Cost_for_RCC]
                ([rccPeriod],[CostCenter],[Direct_Labor_Cost],[RCC1],[Indirect_Labor_Cost],[RCC2],[Other_Dirct_Cost]
                ,[RCC3],[Indirect_Cost_Capital],[RCC4],[Indirect_Cost_Atribuible],[RCC5],[Indirect_Cost_Imputados]
                ,[RCC6],[Other_General_Cost],[RCC7],[Total_Cost],[Total_Charges],[RCC_Total_Cost],[created],[Note]) 
             values (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";//20
    $modified = date("Y-m-d H:i:s");
    array_push($post,$modified) ;   
    $params = array($period, $costcenter,$dcl,$rcc1,$ilc,$rcc2,$olc,$rcc3,$icc,$rcc4,$ica,$rcc5,$ici,$rcc6,$ogc,$rcc7,$totcs,$totch,$rccTot,$created,$note);//;$misc,
    $stmt = sqlsrv_prepare( $conn, $tsql, $params);
    if( sqlsrv_execute( $stmt))  
    {  
        return '<div id="msg" class="msg">Successfully updated!</div>';  
    }else{  
        echo "<pre>";
        die( print_r( sqlsrv_errors(), true));  
        echo "</pre>";
    }
    $db->Desconectar();
}

function updateCC($cid,$cname,$cdesc){
    require_once("cno.php");
    $db = new ServidorBD();
    $conn = $db->Conectar('i');
          $tsql = "UPDATE CostCenters 
            SET [description] = ? ,costcenter = ?
                ,modified = (select GETDATE()) 
            WHERE id = ?"; 
    $params = array($cdesc,$cname,$cid);
    // print_r($params);
    // echo $tsql;
    $stmt = sqlsrv_prepare( $conn, $tsql, $params);  
    if( sqlsrv_execute( $stmt))  
    {  
        return '<div id="msg" class="msg">Successfully updated!</div>';  
    }else{  
        //return "Error in executing statement.$val[$i] :: $itemID[$i]\n";  
        die( print_r( sqlsrv_errors(), true));  
    }
    $db->Desconectar();
    header("Refresh:0");
}

function insertCC(){
    require_once("cno.php");
    $db = new ServidorBD();
    $conn = $db->Conectar('i');
    $cc = $_POST['txtNcc'];
    $desc = $_POST['txtNccD'];
    $now = date('Y-m-d H:i:s');
    $tsql = "INSERT into CostCenters
                ([description]
                ,[costcenter]
                ,[modified]) Values(?,?,?)";
    $params = array($desc,$cc,$now);
    $stmt = sqlsrv_prepare( $conn, $tsql, $params);  
    if( sqlsrv_execute( $stmt))  
    {  
        return '<div id="msg" class="msg">Successfully updated!</div>';  
    }else{  
        die( print_r( sqlsrv_errors(), true));  
    }
    $db->Desconectar();
}

function printr($x){
    echo '<pre>';
    print_r($x);
    echo '</pre>';
}

function ddBuilder($name,$size,$class,$tsql,$item){
    require_once("cno.php");
    $db = new ServidorBD();
    $conn = $db->Conectar('i');
    $getResults = sqlsrv_query($conn, $tsql) ;
    $dd = '<select onDblClick="alert(this.value)" name="'.$name.'" size="'.$size.' class="'.$class.' style="width: 80%;"" required>';
    while ($row = sqlsrv_fetch_array($getResults, SQLSRV_FETCH_NUMERIC)) {
        $selected = ($item == $row[0]) ? ' selected>' : ' >';
        $desc = !($row[2]) ? ' (no description)' : " ($row[2] )" ;
        $dd .= '<option value="' . $row[0] . '" '. $selected . $row[1] . $desc .'</option>';
    } //end while
    $dd .= '</select>';
    $db->Desconectar();
    return $dd;
}

function tblParams($tsql,$x,$tbl){
    //echo "$tsql>>$x>>>$tbl";
    switch ($tbl) {
        case 'Var_Proc_Mst':
            $tsql = "SELECT [MstProcId],[MstProcName],[MstProcDesc],[MstProcStatus] FROM [dbo].[Var_Proc_Mst]";
            $tsql2 = "SELECT [ProcEmailId],[ProcNameId],[MstProcId],[ProcName],[ProcDesc],[ProcStatus] FROM [dbo].[Var_Proc_Email]";
            $tsql3 = "SELECT [ProcNameId],[MstProcId],[ProcName],[ProcDesc],[ProcStatus] FROM [dbo].[Var_Proc_Name]";
            $items = get_tbl_Master($tsql,$x,$tbl,$tsql2,$tsql3);
            break;
        case 'Var_Proc_Email':
            $tsql = "SELECT [ProcEmailId],[ProcNameId],[MstProcId],[ProcName],[ProcDesc],[ProcStatus] FROM [dbo].[Var_Proc_Email]";
            $tsql2 = "SELECT [ProcAttchId],[ProcPathId],[ProcEmailId],[ProcName],[ProcDesc],[ProcStatus] FROM [dbo].[Var_Proc_Attachment]";
            $tsql3 = "SELECT [ProcMessgId],[ProcEmailId],[ProcName],[ProcDesc],[ProcStatus] FROM [dbo].[Var_Proc_Message]";
            $items = gettblEmails($tsql,$x,$tbl,$tsql2,$tsql3);
            break;        
        case 'Var_Proc_Name':
            $tsql = "SELECT [ProcNameId],[MstProcId],[ProcName],[ProcDesc],[ProcStatus] FROM [dbo].[Var_Proc_Name]";
            $tsql2= "SELECT [ProcEmailId],[ProcNameId],[MstProcId],[ProcName],[ProcDesc],[ProcStatus] FROM [dbo].[Var_Proc_Email]";
            $tsql3 = "SELECT [ProcPathId],[ProcNameId],[ProcName],[ProcDesc],[ProcStatus] FROM [dbo].[Var_Proc_Path]";
            $items = get_tbl_Names($tsql,$x,$tbl,$tsql2,$tsql3);
            break;            
        default:
            $items = "";
            break;
    }
    return $items;
}

function get_tbl_Master($tsql,$x,$tbl,$tsql2,$tsql3){
    require_once("cno.php");
    $db = new ServidorBD();
    $conn = $db->Conectar('i');
    if( $conn === false ) {
        echo "<pre>";
        die( print_r( sqlsrv_errors(), true));
   }
    $getResults = sqlsrv_query($conn, $tsql, array(), array( "Scrollable" => SQLSRV_CURSOR_KEYSET ));
    if (!$getResults) {
        echo "<pre>";
        print_r( sqlsrv_errors());
        die( "Bye") ;
    }
    $maxID = 0;
    $items = '<details>
    <summary>Table Var_Proc_Mst</summary>
    <div class="contentt">
        <table><tr>';
    $items .= '<th colspan="1" style="text-align: left;">MstProcId</th>';
    $items .= '<th colspan="1" style="text-align: left;">MstProcName</th>';
    $items .= '<th colspan="1" style="text-align: left;">MstProcDesc</th>';
    $items .= '<th colspan="2" style="text-align: left;">MstProcStatus</th>';    
    while ($row = sqlsrv_fetch_array($getResults, SQLSRV_FETCH_NUMERIC)) {
        $items .= '<form name="forma" action="params.php" target="_self" method="POST">
            <tr><td style="text-align: center;" >('. $row[0] .')</td><td>
                <input type="hidden" value="' . $row[0] . '" name="MstProcId">
                <input type="text" size="14" name="MstProcName" value="' . $row[1] . '" ></td>
                <td><textarea name="MstProcDesc" col="10">' . $row[2] . '</textarea></td>
                <td><input type="text" size="2" name="MstProcStatus" value="' . $row[3] . '" ></td>
                <td><button class="dentro">update</button>
                <input type="hidden" name="req" value="updateMstr">
                <input type="hidden" name="table" value="'.$tbl.'">
            </td></tr></form>';
        $maxID = $row[0];
    } //end while

    //echo $f3->get('BASE');
    if(!sqlsrv_num_rows($getResults)>0) {
        $items .= '<tr><td colspan="2" style="text-align: center;">No records</td></tr>';
    }
    //controls for adding new param
    $items .='
        <tr><th colspan="5" style="text-align: center;">New Var_Proc_Mst</th></tr>
        <tr>
            <form name="main1" action="params.php" target="_self" method="POST">
            <td></td>
            <td><input type="text" size="15" name="MstProcName" placeholder="MstProcName" required></td>
            <td><textarea name="MstProcDesc" placeholder="MstProcDesc" required></textarea></td>
            <td>
                <input type="text" size="10" name="MstProcStatus" placeholder="MstProcStatus" required>
                <input type="hidden" name="req" value="insertMst">
                <input type="hidden" name="maxID" value="'.($maxID+1).'">
                <input type="hidden" name="table" value="'.$tbl.'">
                </td>
            <td>
                <button class="dentro">Submit</button>      
            </td>
        </tr>
            </form>
        </tr></table></div></details>';
    $items .= tblEmails($tsql2,$x,'Var_Proc_Email');
    $items .= tblNames($tsql3,$x,'Var_Proc_Name');
    $db->Desconectar();
    return $items;
}

function gettblEmails($tsql,$x,$tbl,$tsql2,$tsql3){
    $items = tblEmails($tsql,$x,$tbl);
    $items .= tblMessage($tsql3,$x,$tbl);
    $items .= tblAttach($tsql2,$tbl);
    return $items;
}

function get_tbl_Names($tsql,$x,$tbl,$tsql2,$tsql3){
    $items = tblNames($tsql,$x,$tbl);
    $items .= tblEmails($tsql2,$x,$tbl);
    $items .= tblPath($tsql3,$x,$tbl);
    return $items;
}

function tblNames($tsql,$x,$tbl){
    require_once("cno.php");
    $db = new ServidorBD();
    $conn = $db->Conectar('i');
    $getResults = sqlsrv_query($conn, $tsql, array(), array( "Scrollable" => SQLSRV_CURSOR_KEYSET ));
    if (!$getResults) {
        die( "<pre>" . print_r( sqlsrv_errors(). "</pre>", true)); ;
    }
    //$items = '</table><table><tr><th colspan="7"></th></tr><tr>';
    $items = '<details>
    <summary>Table Var_Proc_Name</summary>
    <div class="contentt">
        <table><tr>';
    $maxID = 0;
    $items .= '<th colspan="1" style="text-align: left;">ProcNameId</th>';
    $items .= '<th colspan="1" style="text-align: left;">MstProcId</th>';
    $items .= '<th colspan="1" style="text-align: left;">ProcName</th>';
    $items .= '<th colspan="1" style="text-align: left;">ProcDesc</th>';
    $items .= '<th colspan="2" style="text-align: left;">ProcStatus</th>';
    while ($row = sqlsrv_fetch_array($getResults, SQLSRV_FETCH_NUMERIC)) {
        $items .= '<form name="forma" action="params.php" target="_self" method="POST">
            <tr><td style="text-align: center;" >('. $row[0] .')</td><td>
                <input type="hidden" value="' . $row[0] . '" name="ProcNameId">
                <input type="text" size="5" name="MstProcId" value="' . $row[1] . '" ></td>
                <td><input type="text" size="5" name="ProcName" value="' . $row[2] . '" ></td>
                <td><input type="text" size="55" name="ProcDesc" value="' . $row[3] . '"  ></td>
                <td><input type="text" size="2" name="ProcStatus" value="' . $row[4] . '" ></td>
                <td><button class="dentro">update</button>
                <input type="hidden" name="req" value="updateName">
                <input type="hidden" name="table" value="'.$tbl.'">                
            </td></tr></form>';
        $maxID = $row[0];
    } //end while

    $items .='
    <tr><th colspan="6" style="text-align: center;"><h3>Add Var_Proc_Name record</h3></th></tr>
    <tr>
        <form name="main1" action="params.php" target="_self" method="POST">
        <td></td>
        <td><input type="text" name="MstProcId" placeholder="MstProcId" required></td>
        <td><input type="text" name="ProcName" placeholder="ProcName" required>
        <td><textarea name="ProcDesc" placeholder="ProcDesc" required></textarea></td>
        <td>
            <input type="text" name="ProcStatus" placeholder="ProcStatus" required>
            <input type="hidden" name="req" value="insertName">
            <input type="hidden" name="maxID" value="' . ($maxID +1) . '">
            <input type="hidden" name="table" value="'.$tbl.'">
        </td>
        <td><button class="dentro">Submit</button></td>
    </form>
    </tr></table></div></details>';
    $db->Desconectar();
    return $items;
}

function getItems($tsql,$x){
    require_once("cno.php");
    $db = new ServidorBD();
    $conn = $db->Conectar('i');
        $getResults = sqlsrv_query($conn, $tsql . $x, array(), array( "Scrollable" => SQLSRV_CURSOR_KEYSET ));
    if (!$getResults) {
        die( "<pre>" . print_r( sqlsrv_errors(). "</pre>", true)); ;
    }else{
        //print_r($stmt);
    }
    $items = '<tr><th colspan="1" style="text-align: center;">Param Name</th>
    <th colspan="1" style="text-align: center;">Value</th></tr>';
    //$i = 0;
    while ($row = sqlsrv_fetch_array($getResults, SQLSRV_FETCH_NUMERIC)) {
        $items .= '<form name="forma" action="params.php/" target="_self" method="POST">
            <tr><td style="text-align: right;" >
                <input type="hidden" value="' . $row[0] . '" name="optID">
                <label>' . $row[1] . '</td><td>
                <input type="text" name="optVal" value="' . $row[2] . '" style="width: 80%;"></label>
                <button class="dentro">update</button>
                <input type="hidden" name="req" value="2">
                <input type="hidden" name="itemID" value="'.$x.'">
                <input type="hidden" name="oldVal" value="' . $row[2] . '">
            </td></tr></form>';
    } //end while
    if(sqlsrv_num_rows($getResults)>0) {
        //$items .= '<tr><th colspan="2" style="text-align: right;"></th></tr></form>';
    }else{
        $items .= '<tr><th colspan="2" style="text-align: center;">No records</th></tr>';
    }
    //controls for adding new param
    $items .='
        <tr>
            <th colspan="2" style="text-align: center;">New</th>
        </tr>
        <tr>
            <form name="main1" action="params.php" target="_self" method="POST">
            <td>
                <input type="text" name="txtParam" placeholder="Panam Name" style="width: 80%;" required>
            </td>
            <td>
                <input type="text" name="txtValue" placeholder="Panam Value" style="width: 70%;" required>
                <button class="dentro">Submit</button>
                <input type="hidden" name="req" value="3">
                <input type="hidden" name="itemID" value="' . $x . '">
            </td>
            </form>
        </tr>';
        $db->Desconectar();
    return $items;
}

function updateItem($val,$itemID){
    require_once("cno.php");
    $db = new ServidorBD();
    $conn = $db->Conectar('i');
    $tsql = "UPDATE dbo.tbl_PackageOptions SET opt_value = ( ? ), updated = (select GETDATE()) WHERE id = ( ? )"; 
    $params = array($itemID,$val);
    //print_r($params);
    $stmt = sqlsrv_prepare( $conn, $tsql, $params); 
    if (!$stmt) {
        die( "<pre>" . print_r( sqlsrv_errors(). "</pre>", true)); ;
    }
    if( sqlsrv_execute($stmt))  
    {  
        return '<div id="msg" class="msg">Successfully updated!</div>';  
    }else{  
        //return "Error in executing statement.$val[$i] :: $itemID[$i]\n";  
        die( "<pre>".print_r( sqlsrv_errors(), true))."</pre>";//die( "<pre>" . print_r( sqlsrv_errors(). "</pre>", true));  
    }
    $db->Desconectar();
}

function addParam($name,$value,$itemID){
    require_once("cno.php");
    $db = new ServidorBD();
    $conn = $db->Conectar('i');
    $tsql = "INSERT into dbo.tbl_PackageOptions (opt_name,opt_value,pkg_id,active) values (?,?,?,?)";
    $params = array($name,$value,$itemID,'1');
    $stmt = sqlsrv_prepare( $conn, $tsql, $params);  
    if( sqlsrv_execute( $stmt))  
    {  
        return '<div id="msg" class="msg">Successfully updated!</div>';  
    }else{  
        die( "<pre>" . print_r( sqlsrv_errors(). "</pre>", true)); 
    }
    $db->Desconectar();
}

function tblPath($tsql,$x,$tbl){
    require_once("cno.php");
    $db = new ServidorBD();
    $conn = $db->Conectar('i');
    $getResults = sqlsrv_query($conn, $tsql, array(), array( "Scrollable" => SQLSRV_CURSOR_KEYSET ));
    if (!$getResults) {
        die( "<pre>" . print_r( sqlsrv_errors(). "</pre>", true)); ;
    }
    //$items = '</table><table><tr><th colspan="7">Table Var_Proc_Path</th></tr><tr>';
    $items = '<details>
    <summary>Table Var_Proc_Path</summary>
    <div class="contentt">
    <table><tr>';
    $maxID = 0;
    $items .= '<th style="text-align: left;">ProcPathId</th>';
    $items .= '<th style="text-align: left;">ProcNameId</th>';
    $items .= '<th style="text-align: left;">ProcName</th>';
    $items .= '<th style="text-align: left;">ProcDesc</th>';
    $items .= '<th colspan="2" style="text-align: left;">ProcStatus</th>';
    if(!sqlsrv_num_rows($getResults)>0) {
        $items .= '<tr><td colspan="7" style="text-align: center;"><i>No records in table Var_Proc_Path</i></td></tr>';
    }else{
        while ($row = sqlsrv_fetch_array($getResults, SQLSRV_FETCH_NUMERIC)) {
            $items .= '<form name="forma" action="params.php" target="_self" method="POST">
                <tr><td style="text-align: center;" >('. $row[0] .')</td>
                    <td><input type="text" size="5" name="ProcNameId" value="' . $row[1] . '" ></td>
                    <td><input type="text" size="15" name="ProcName" value="' . $row[2] . '" ></td>
                    <td><textarea name="ProcDesc" onDblClick="alert(tdis.value)">'.$row[3] . '</textarea></td>
                    <td><input type="text" size="2" name="ProcStatus" value="' . $row[4] . '" ></td>
                    <td>
                        <button class="dentro">update</button>
                        <input type="hidden" name="req" value="updatePath">
                        <input type="hidden" name="table" value="'.$tbl.'">
                        <input type="hidden" name="ProcPathId" value="'.$row[0].'">
                        <input type="hidden" name="oldVal" value="' . $row[2] . '">
                    </td>
                </tr></form>';
            $maxID = $row[0];
        } //end while
    }//end if
    $items .='
        <tr><th colspan="7" style="text-align: center;"><h3>Add Var_Proc_Path</h3></th></tr>
        <tr><form name="main1" action="params.php" target="_self" method="POST"><td></td>
            <td><input type="text" name="ProcNameId" placeholder="ProcNameId" required></td>
            <td><input type="text" name="ProcName" placeholder="ProcName" required></td>
            <td><textarea name="ProcDesc" placeholder="ProcDesc" required></textarea></td>
            <td><input type="text" name="ProcStatus" placeholder="ProcStatus" required>
            <input type="hidden" name="req" value="insertPath">
            <input type="hidden" name="maxID" value="' . ($maxID + 1) . '">
            <input type="hidden" name="table" value="'.$tbl.'">
            </td>
            <td><button class="dentro">Submit</button></td>
            </form></tr></table></div></details>';
        $db->Desconectar();
    return $items;
}

function tblMessage($tsql,$x,$tbl){
    require_once("cno.php");
    $db = new ServidorBD();
    $conn = $db->Conectar('i');
    $getResults = sqlsrv_query($conn, $tsql, array(), array( "Scrollable" => SQLSRV_CURSOR_KEYSET ));
    if (!$getResults) {
        die( "<pre>" . print_r( sqlsrv_errors(). "</pre>", true)); ;
    }
    $maxID = 0;
    //$items = '</table><table><tr><th colspan="7">Table Var_Proc_Message</th></tr><tr>';
    $items = '<details>
    <summary>Table Var_Proc_Message</summary>
    <div class="contentt">
    <table><tr>';
    $items .= '<th style="text-align: left;">ProcMessgId</th>';
    $items .= '<th style="text-align: left;">ProcEmailId</th>';
    $items .= '<th style="text-align: left;">ProcName</th>';
    $items .= '<th style="text-align: left;">ProcDesc</th>';
    $items .= '<th colspan="2" style="text-align: left;">ProcStatus</th>';
    if(!sqlsrv_num_rows($getResults)>0) {
        $items .= '<tr><td colspan="7" style="text-align: center;"><i>No records in table Var_Proc_Message</i></td></tr>';
    }else{
        while ($row = sqlsrv_fetch_array($getResults, SQLSRV_FETCH_NUMERIC)) {
            $items .= '<form name="forma" action="params.php" target="_self" method="POST">
                <tr><td style="text-align: center;" >('. $row[0] .')</td>
                    <td><input type="text" size="5" name="ProcEmailId" value="' . $row[1] . '" ></td>
                    <td><input type="text" size="15" name="ProcName" value="' . $row[2] . '" ></td>
                    <td><textarea name="ProcDesc" onDblClick="alert(tdis.value)">'.$row[3] . '</textarea></td>
                    <td><input type="text" size="2" name="ProcStatus" value="' . $row[4] . '" ></td>
                    <td>
                        <button class="dentro">update</button>
                        <input type="hidden" name="req" value="updateMsg">
                        <input type="hidden" name="table" value="'.$tbl.'">
                        <input type="hidden" name="ProcMessgId" value="'.$row[0].'">
                        <input type="hidden" name="oldVal" value="' . $row[2] . '">
                    </td>
                </tr></form>';
            $maxID = $row[0];
        } //end while
    }//end if
    $items .='
        <tr><th colspan="7" style="text-align: center;"><h3>Add Var_Proc_Message</h3></th></tr>
        <tr><form name="main1" action="params.php" target="_self" method="POST"><td>'.($maxID + 1).'</td>
            <td><input type="text" name="ProcEmailId" placeholder="ProcEmailId" required></td>
            <td><input type="text" name="ProcName" placeholder="ProcName" required></td>
            <td><textarea name="ProcDesc" placeholder="ProcDesc" required></textarea></td>
            <td><input type="text" name="ProcStatus" placeholder="ProcStatus" required>
            <input type="hidden" name="req" value="insertMsg">
            <input type="hidden" name="maxID" value="'.($maxID + 1).'">
            <input type="hidden" name="table" value="'.$tbl.'">
            </td>
            <td><button class="dentro">Submit</button></td>
            </form></table></div></details>';
            $db->Desconectar();
    return $items;
}

function tblAttach($tsql2,$tbl){
    require_once("cno.php");
    $db = new ServidorBD();
    $conn = $db->Conectar('i');
    $getResults = sqlsrv_query($conn, $tsql2, array(), array( "Scrollable" => SQLSRV_CURSOR_KEYSET ));
    if (!$getResults) {
        die( "<pre>" . print_r( sqlsrv_errors(). "</pre>", true)); ;
    }
    $maxID = 0;
    $items = '<details>
    <summary>Table Var_Proc_Attachment</summary>
    <div class="contentt">
    <table><tr>';
    $items .= '<th style="text-align: left;">ProcAttchId</th>';
    $items .= '<th style="text-align: left;">ProcPathId</th>';
    $items .= '<th style="text-align: left;">ProcEmailId</th>';
    $items .= '<th style="text-align: left;">ProcName</th>';
    $items .= '<th style="text-align: left;">ProcDesc</th>';
    $items .= '<th colspan="2" style="text-align: left;">ProcStatus</th>';
    if(!sqlsrv_num_rows($getResults)>0) {
        $items .= '<tr><td colspan="7" style="text-align: center;"><i>No records in table Var_Proc_Attachment</i></td></tr>';
    }else{
        while ($row = sqlsrv_fetch_array($getResults, SQLSRV_FETCH_NUMERIC)) {
            $items .= '<form name="forma" action="params.php" target="_self" method="POST">
                <tr><td style="text-align: center;" >('. $row[0] .')</td>
                    <td><input type="text" size="5" name="ProcPathId" value="' . $row[1] . '" ></td>
                    <td><input type="text" size="5" name="ProcEmailId" value="' . $row[2] . '" ></td>
                    <td><input type="text" size="15" name="ProcName" value="' . $row[3] . '" ></td>
                    <td><textarea name="ProcDesc" onDblClick="alert(this.value)">'.$row[4] . '</textarea></td>
                    <td><input type="text" size="2" name="ProcStatus" value="' . $row[5] . '" ></td>
                    <td>
                        <button class="dentro">update</button>
                        <input type="hidden" name="req" value="updateAttach">
                        <input type="hidden" name="table" value="'.$row[0].'">
                        <input type="hidden" name="ProcAttchId" value="'.$row[0].'">
                        <input type="hidden" name="table" value="'.$tbl.'">
                    </td>
                </tr></form>';
                $maxID = $row[0];
        } //end while
    }//end if
    $items .='
        <tr><th colspan="7" style="text-align: center;"><h3>Add Var_Proc_Attachment +</h3></th></tr>
        <tr><form name="main1" action="params.php" target="_self" method="POST"><td></td>
            <td><input type="text" name="ProcPathId" placeholder="ProcPathId" required></td>
            <td><input type="text" name="ProcEmailId" placeholder="ProcEmailId" required></td>
            <td><input type="text" name="ProcName" placeholder="ProcName" required></td>
            <td><textarea name="ProcDesc" placeholder="ProcDesc" required></textarea></td>
            <td><input type="text" name="ProcStatus" placeholder="ProcStatus" required>
            <input type="hidden" name="maxID" value="'.($maxID + 1).'">                
            <input type="hidden" name="table" value="'.$tbl.'">
            <input type="hidden" name="req" value="insertAttach">
            </td>
            <td><button class="dentro">Submit</button></td>
            </form></tr></table></div></details>';
            $db->Desconectar();
    return $items;
}

function tblEmails($tsql,$x,$tbl){
    require_once("cno.php");
    $db = new ServidorBD();
    $conn = $db->Conectar('i');
    $getResults = sqlsrv_query($conn, $tsql, array(), array( "Scrollable" => SQLSRV_CURSOR_KEYSET ));
    if (!$getResults) {
        die( "<pre>" . print_r( sqlsrv_errors(). "</pre>", true)); ;
    }
    $items = '<details>
    <summary>Table Var_Proc_Email</summary>
    <div class="contentt">
    <table><tr>';
    $items .= '<th style="text-align: left;">ProcEmailId</th>';
    $items .= '<th style="text-align: left;">ProcNameId</th>';
    $items .= '<th style="text-align: left;">MstProcId</th>';
    $items .= '<th style="text-align: left;">ProcName</th>';
    $items .= '<th style="text-align: left;">ProcDesc</th>';
    $items .= '<th colspan="2" style="text-align: left;">ProcStatus</th>';
    $maxID = 0;
    while ($row = sqlsrv_fetch_array($getResults, SQLSRV_FETCH_NUMERIC)) {
        $items .= '<form name="forma" action="params.php" target="_self" method="POST">
            <tr><td style="text-align: center;" >('. $row[0] .')</td>
                <input type="hidden" name="ProcEmailId" value="'.$row[0].'">
                <td><input type="text" size="5" name="ProcNameId" value="' . $row[1] . '" ></td>
                <td><input type="text" size="5" name="MstProcId" value="' . $row[2] . '" ></td>
                <td><input type="text" size="15" name="ProcName" value="' . $row[3] . '" ></td>
                <td><textarea name="ProcDesc" onDblClick="alert(this.value)">'.$row[4] . '</textarea></td>
                <td><input type="text" size="2" name="ProcStatus" value="' . $row[5] . '"></td>
                <td><button class="dentro">update</button>
                <input type="hidden" name="req" value="updateEm">
                <input type="hidden" name="table" value="'.$tbl.'">
            </td></tr></form>';
        $maxID = $row[0];
    } //end while
    $items .='
        <tr><th colspan="7" style="text-align: center;"><h3>Add Var_Proc_Email</h3></th></tr>
        <tr><form name="main1" action="params.php" target="_self" method="POST"><td></td>
            <td><input type="text" name="ProcNameId" placeholder="ProcNameId" required></td>
            <td><input type="text" name="MstProcId" placeholder="MstProcId" required></td>
            <td><input type="text" name="ProcName" placeholder="ProcName" required></td>
            <td><textarea name="ProcDesc" placeholder="ProcDesc" required></textarea></td>
            <td><input type="text" name="ProcStatus" placeholder="ProcStatus" required>
                <input type="hidden" name="req" value="insertEmail">
                <input type="hidden" name="table" value="'.$tbl.'">
                <input type="hidden" name="maxID" value="' . ($maxID + 1) . '"></td>
            <td><button class="dentro">Submit</button></td>
            </form>
        </tr></table></div></details>';
        $db->Desconectar();
    return $items;
}

function updateEmail($data){
    require_once("cno.php");
    $db = new ServidorBD();
    $conn = $db->Conectar('i');
    extract($data);
    //print_r($data);
    $tsql = "UPDATE Var_Proc_Email set ProcNameId = ?
                ,MstProcId = ?
                ,[ProcName] = ?
                ,[ProcDesc] = ?
                ,[ProcStatus] = ?
            where ProcEmailId = ?";
    //echo $tsql;
    $params = array($ProcNameId,$MstProcId,$ProcName,$ProcDesc,$ProcStatus,$ProcEmailId);
    $stmt = sqlsrv_prepare( $conn, $tsql, $params); 
    if (!$stmt) {
        die( "<pre>" . print_r( sqlsrv_errors(). "</pre>", true)); ;
    }
    if( sqlsrv_execute($stmt))  
    {  
        echo '<div id="msg" class="msg">Successfully updated!</div>';  
    }else{  
        //return "Error in executing statement.$val[$i] :: $itemID[$i]\n";  
        die( "<pre>".print_r( sqlsrv_errors(), true))."</pre>";//die( "<pre>" . print_r( sqlsrv_errors(). "</pre>", true));  
    }
    $db->Desconectar();
}

function updateMstr($data){
        require_once("cno.php");
    $db = new ServidorBD();
    $conn = $db->Conectar('i');
    extract($data);
    $tsql = "UPDATE Var_Proc_Mst set MstProcName = ?
                ,MstProcDesc = ?
                ,MstProcStatus = ?
            where MstProcId = ?";
    //echo $tsql;
        $params = array($MstProcName,$MstProcDesc,$MstProcStatus,$MstProcId);
    $stmt = sqlsrv_prepare( $conn, $tsql, $params); 
    if (!$stmt) {
        die( "<pre>" . print_r( sqlsrv_errors(). "</pre>", true)); ;
    }
    if( sqlsrv_execute($stmt))  
    {  
        echo '<div id="msg" class="msg">Successfully updated!</div>';  
    }else{  
        //return "Error in executing statement.$val[$i] :: $itemID[$i]\n";  
        die( "<pre>".print_r( sqlsrv_errors(), true))."</pre>";//die( "<pre>" . print_r( sqlsrv_errors(). "</pre>", true));  
    }
    $db->Desconectar();
}

function updateName($data){
        require_once("cno.php");
    $db = new ServidorBD();
    $conn = $db->Conectar('i');
    extract($data);
    $tsql = "UPDATE Var_Proc_Name set MstProcId = ?
                ,ProcName = ?
                ,ProcDesc = ?
                ,ProcStatus = ?
            where ProcNameId = ?";
        $params = array($MstProcId,$ProcName,$ProcDesc,$ProcStatus,$ProcNameId);
    $stmt = sqlsrv_prepare( $conn, $tsql, $params); 
    if (!$stmt) {
        die( "<pre>" . print_r( sqlsrv_errors(). "</pre>", true)); ;
    }
    if( sqlsrv_execute($stmt))  
    {  
        echo '<div id="msg" class="msg">Successfully updated!</div>';  
    }else{  
        //return "Error in executing statement.$val[$i] :: $itemID[$i]\n";  
        die( "<pre>".print_r( sqlsrv_errors(), true))."</pre>";//die( "<pre>" . print_r( sqlsrv_errors(). "</pre>", true));  
    }
    $db->Desconectar();
}

function updatePath($data){
        require_once("cno.php");
    $db = new ServidorBD();
    $conn = $db->Conectar('i');
    extract($data);
    $tsql = "UPDATE Var_Proc_Path set ProcNameId = ?
                ,ProcName = ?
                ,ProcDesc = ?
                ,ProcStatus = ?
            where ProcPathId = ?";
        $params = array($ProcNameId,$ProcName,$ProcDesc,$ProcStatus,$ProcPathId);
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
    $db->Desconectar();
}

function updateMsg($data){
        require_once("cno.php");
    $db = new ServidorBD();
    $conn = $db->Conectar('i');
    extract($data);
    $tsql = "UPDATE Var_Proc_Message set ProcEmailId = ?
                ,ProcName = ?
                ,ProcDesc = ?
                ,ProcStatus = ?
            where ProcMessgId = ?";
        $params = array($ProcEmailId,$ProcName,$ProcDesc,$ProcStatus,$ProcMessgId);
    $stmt = sqlsrv_prepare( $conn, $tsql, $params); 
    if (!$stmt) {
        die( "<pre>" . print_r( sqlsrv_errors(). "</pre>", true)); ;
    }
    if( sqlsrv_execute($stmt))  
    {  
        echo '<div id="msg" class="msg">Successfully updated!</div>';  
    }else{  
        //return "Error in executing statement.$val[$i] :: $itemID[$i]\n";  
        die( "<pre>".print_r( sqlsrv_errors(), true))."</pre>";//die( "<pre>" . print_r( sqlsrv_errors(). "</pre>", true));  
    }
    $db->Desconectar();
}

function updateAttach($data){
        require_once("cno.php");
    $db = new ServidorBD();
    $conn = $db->Conectar('i');
    extract($data);
    //print_r($data);
    $tsql = "UPDATE Var_Proc_Attachment set ProcPathId = ?
                ,ProcEmailId = ?
                ,ProcName = ?
                ,ProcDesc = ?
                ,ProcStatus = ?
            where ProcAttchId = ?";
        $params = array($ProcPathId,$ProcEmailId,$ProcName,$ProcDesc,$ProcStatus,$ProcAttchId);
    $stmt = sqlsrv_prepare( $conn, $tsql, $params); 
    if (!$stmt) {
        die( "<pre>" . print_r( sqlsrv_errors(). "</pre>", true)); ;
    }
    if( sqlsrv_execute($stmt))  
    {  
        echo '<div id="msg" class="msg">Successfully updated!</div>';  
    }else{  
        //return "Error in executing statement.$val[$i] :: $itemID[$i]\n";  
        die( "<pre>".print_r( sqlsrv_errors(), true))."</pre>";//die( "<pre>" . print_r( sqlsrv_errors(). "</pre>", true));  
    }
    $db->Desconectar();
}

function insertAttach($data){
        require_once("cno.php");
    $db = new ServidorBD();
    $conn = $db->Conectar('i');
    extract($data);
    //print_r($data);
    $tsql = "INSERT into Var_Proc_Attachment (ProcAttchId,ProcPathId ,ProcEmailId,ProcName,ProcDesc,ProcStatus)
        values (?,?,?,?,?,?)";
        $params = array($maxID,$ProcPathId,$ProcEmailId,$ProcName,$ProcDesc,$ProcStatus);
    $stmt = sqlsrv_prepare( $conn, $tsql, $params); 
    if (!$stmt) {
        die( "<pre>" . print_r( sqlsrv_errors(). "</pre>", true)); ;
    }
    if( sqlsrv_execute($stmt))  
    {  
        echo '<div id="msg" class="msg">Successfully updated!</div>';  
    }else{  
        //return "Error in executing statement.$val[$i] :: $itemID[$i]\n";  
        die( "<pre>".print_r( sqlsrv_errors(), true))."</pre>";//die( "<pre>" . print_r( sqlsrv_errors(). "</pre>", true));  
    }
    $db->Desconectar();
}

function insertMsg($data){
        require_once("cno.php");
    $db = new ServidorBD();
    $conn = $db->Conectar('i');
    extract($data);
    $tsql = "INSERT into Var_Proc_Message (ProcMessgId,ProcEmailId,ProcName,ProcDesc,ProcStatus) values (?,?,?,?,?) ";
        $params = array($maxID,$ProcEmailId,$ProcName,$ProcDesc,$ProcStatus);
    $stmt = sqlsrv_prepare( $conn, $tsql, $params); 
    if (!$stmt) {
        die( "<pre>" . print_r( sqlsrv_errors(). "</pre>", true)); ;
    }
    if( sqlsrv_execute($stmt))  
    {  
        echo '<div id="msg" class="msg">Successfully updated!</div>';  
    }else{  
        //return "Error in executing statement.$val[$i] :: $itemID[$i]\n";  
        die( "<pre>".print_r( sqlsrv_errors(), true))."</pre>";//die( "<pre>" . print_r( sqlsrv_errors(). "</pre>", true));  
    }
    $db->Desconectar();
}

function insertPath($data){
        require_once("cno.php");
    $db = new ServidorBD();
    $conn = $db->Conectar('i');
    extract($data);
    $tsql = "INSERT into Var_Proc_Path (ProcPathId,ProcNameId,ProcName,ProcDesc,ProcStatus) values (?,?,?,?,?)";
        $params = array($maxID,$ProcNameId,$ProcName,$ProcDesc,$ProcStatus);
    $stmt = sqlsrv_prepare( $conn, $tsql, $params); 
    if (!$stmt) {
        die( "<pre>" . print_r( sqlsrv_errors(). "</pre>", true)); ;
    }
    if( sqlsrv_execute($stmt))  
    {  
        echo '<div id="msg" class="msg">Successfully updated!</div>';  
    }else{  
        //return "Error in executing statement.$val[$i] :: $itemID[$i]\n";  
        die( "<pre>".print_r( sqlsrv_errors(), true))."</pre>";//die( "<pre>" . print_r( sqlsrv_errors(). "</pre>", true));  
    }
    $db->Desconectar();
}

function insertName($data){
        require_once("cno.php");
    $db = new ServidorBD();
    $conn = $db->Conectar('i');
    extract($data);
    $tsql = "INSERT into Var_Proc_Name (ProcNameId,MstProcId,ProcName,ProcDesc,ProcStatus) values(?,?,?,?,?)";
        $params = array($maxID,$MstProcId,$ProcName,$ProcDesc,$ProcStatus);
    $stmt = sqlsrv_prepare( $conn, $tsql, $params); 
    if (!$stmt) {
        die( "<pre>" . print_r( sqlsrv_errors(). "</pre>", true)); ;
    }
    if( sqlsrv_execute($stmt))  
    {  
        echo '<div id="msg" class="msg">Successfully updated!</div>';  
    }else{  
        die( "<pre>".print_r( sqlsrv_errors(), true))."</pre>";
    }
    $db->Desconectar();
}

function insertEmail($data){
    require_once("cno.php");
    $db = new ServidorBD();
    $conn = $db->Conectar('i');
    extract($data);
    $tsql = "INSERT into Var_Proc_Email (ProcEmailId,ProcNameId,MstProcId,ProcName,ProcDesc,ProcStatus) values(?,?,?,?,?,?)";
        $params = array($maxID,$ProcNameId,$MstProcId,$ProcName,$ProcDesc,$ProcStatus);
    $stmt = sqlsrv_prepare( $conn, $tsql, $params); 
    if (!$stmt) {
        die( "<pre>" . print_r( sqlsrv_errors(). "</pre>", true)); ;
    }
    if( sqlsrv_execute($stmt))  
    {  
        echo '<div id="msg" class="msg">Successfully updated!</div>';  
    }else{  
        die( "<pre>".print_r( sqlsrv_errors(), true))."</pre>";
    }
    $db->Desconectar();
}

function insertMst($data){
        require_once("cno.php");
    $db = new ServidorBD();
    $conn = $db->Conectar('i');
    extract($data);
    $tsql = "INSERT into Var_Proc_Mst (MstProcId,MstProcName,MstProcDesc,MstProcStatus) values(?,?,?,?)";
        $params = array($maxID,$MstProcName,$MstProcDesc,$MstProcStatus);
    $stmt = sqlsrv_prepare( $conn, $tsql, $params); 
    if (!$stmt) {
        die( "<pre>" . print_r( sqlsrv_errors(). "</pre>", true)); ;
    }
    if( sqlsrv_execute($stmt))  
    {  
        echo '<div id="msg" class="msg">Successfully updated!</div>';  
    }else{  
        die( "<pre>".print_r( sqlsrv_errors(), true))."</pre>";
    }
    $db->Desconectar();
}

