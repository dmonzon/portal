<?php
require_once('cno.php');
$db = new ServidorBD();
$conn = $db->Conectar('x');
$opt = @$_POST['opt'];

if($_GET){
    extract($_GET);
    // echo "<pre>GET</br>";
    // var_dump($_GET);
    if($opt=='3'){
        $tsql = "SELECT * FROM $tabla ORDER BY ".$columnName." ".$sort." ";
        //echo "<br>$tsql<br>";
        $stmt = sqlsrv_query($conn, $tsql);
        $html = '<tr>';
        $i = 0;
        foreach(sqlsrv_field_metadata($stmt) as $field){
            $html .= '<th><span onclick=\'sortTabla("'.$tabla.'","'.$field['Name'].'","3");\'>'.$field['Name'].'</span></th>';
            $i++;
        }
        // $html .= '</tr>';
        $x = 0;
        echo '<tr><input type="hidden" id="sort" value="asc">';
        while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_BOTH)){
            for ($j = 0; $j < $i; $j++) {
            if ($row[$j] instanceof DateTime) {
                echo "<td class='hd-table'>".$row[$j]->format('m/d/Y H:i:s')."</td>";
            }else{
                echo "<td class='hd-table'>".($row[$j] == '' ? '0' : $row[$j]) ."</td>";
            }
            }
            $x++;
            echo '</tr>';
        }
    }elseif($opt =='2'){
        extract($_GET);
        // echo"<pre>";
        // var_dump($_GET);
        if (!@$tb) {
            $tabla = "$selTable";
            $sql = "SELECT * FROM $selTable ";
            if($selOpt1 === 'like') {
                $sql .= "WHERE $selField like '%$txtValue%'";
            }else{
                $sql .= "WHERE $selField $selOpt1 '$txtValue'";
            }

            if($selOperator == 'and' || $selOperator == 'or'){
                if($selOpt1 === 'like') {
                    $sql .= " $selOperator $selField2 like '%$txtValue2%'";
                }else{
                    $sql .= " $selOperator $selField2 $selOpt2 '$txtValue2'";
                }
            }
            
            if($selOperator2 == 'and' || $selOperator2 == 'or'){
                if($selOpt3 === 'like') {
                    $sql .= " $selOperator2 $selField3 like '%$txtValue3%'";
                }else{
                    $sql .= " $selOperator2 $selField3 $selOpt3 '$txtValue3'";
                }
            }
            $sql .= " order by $selField4 $selOrderby";
        }else{
            $tabla = $_GET['tb'];
            $sql = "SELECT * FROM $tabla ";
        }
        $x=0;
        echo '<table class="hd-table" id="empTable"><tr>';
        $stmt = sqlsrv_query($conn, $sql);
        foreach(sqlsrv_field_metadata($stmt) as $field){
            echo '<th><span onclick=\'sortTabla("'.$tabla.'","'.$field['Name'].'");\'>'.$field['Name'].'</span></th>';
            $x++;
        }
        echo '</tr>';
        while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_BOTH)){
            for ($j = 0; $j < $x; $j++) {
                if ($row[$j] instanceof DateTime) {
                    echo "<td class='hd-table'>".$row[$j]->format('m/d/Y H:i:s')."</td>";
                }else{
                    echo "<td class='hd-table'>".($row[$j] == '' ? '0' : $row[$j]) ."</td>";
                }
            }
            //$x++;
            echo '</tr><br>';
        }
        echo "</table><br>";
    }
}
if($_POST){
    // echo "<pre>";
    // var_dump($_POST);
    extract($_POST);
    $tsql = "SELECT * FROM $tabla ORDER BY ".$columnName." ".@$sort." ";
    //echo "<br>$tsql<br>";
    $stmt = sqlsrv_query($conn, $tsql);
    $html = '<tr>';
    $i = 0;
    foreach(sqlsrv_field_metadata($stmt) as $field){
    // $html .= '<th><span onclick=\'sortTable("'.$tabla.'","'.$field['Name'].'");\'>'.$field['Name'].'</span></th>';
        $i++;
    }
    // $html .= '</tr>';
    $x = 0;
    echo '<tr>';
    while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_BOTH)){
        for ($j = 0; $j < $i; $j++) {
            if ($row[$j] instanceof DateTime) {
                echo "<td class='hd-table'>".$row[$j]->format('m/d/Y H:i:s')."</td>";
            }else{
                echo "<td class='hd-table'>".($row[$j] == '' ? '0' : $row[$j]) ."</td>";
            }
        }
        $x++;
        echo '</tr>';
    }
// echo "<pre>";
// var_dump($_POST);
}

?>
