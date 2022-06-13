<?php
require_once('cno.php');
$db = new ServidorBD();
$conn = $db->Conectar('x');
// echo "<pre>";
// var_dump($_POST);
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
        $res = sqlsrv_has_rows( $stmt );
        if($res > 0){
            echo gSleepTable($stmt,$tabla,$tsql, $opt = "0");
        }else{
            echo '<tr><td style="color:red;"><h2>No se generaron resultados</h2><td/></tr>';
        }  
    }elseif($opt =='2'){
        extract($_GET);
        // echo"<pre>";
        // var_dump($_GET);
        // if (!@$tb) {
            $tabla = "$tb";
            $sql = "SELECT * FROM $tb ";
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
        // }else{
        //     $tabla = $_GET['tb'];
        //     $sql = "SELECT * FROM $tabla ";
        // }
        $x=0;
        echo '<table class="hd-table" id="empTable"><tr>';
        $stmt = sqlsrv_query($conn, $sql);
            //echo count($stmt);
        if($stmt){
            $res = sqlsrv_has_rows( $stmt );
            if($res > 0){
                echo gSleepTable($stmt,$tabla,$sql,'0');
            }else{
                echo '<tr><td style="color:red;"><h2>No se generaron resultados</h2><td/></tr>';
            }
        }else{
            echo '<tr><td style="color:red;"><h2>No se generaron resultados, verifique los datos e intente nuevamente</h2><td/></tr>';
        }
    }
}
if($_POST){
    // echo "<pre>";
    // var_dump($_POST);
    // echo "</pre>";
    extract($_POST);
    // echo "((( $tsql )))<br>";
    // echo "[[[ $tsql ]]]<br>";
    if(!$tsql){
        $tsql = "SELECT * FROM $tabla ORDER BY ".$columnName." ".@$sort." ";
    }else{ 
        $pos = strpos($tsql,'order');
        echo '===='. $pos;
        //substr($tsql,0,strpos($tsql,'order'));
        if($pos>0) {
            $newSql = substr($tsql,0,strpos($tsql,'order'));   
            $tsql = $newSql . " ORDER BY ".$columnName." ".@$sort." ";
        }else{
            $tsql .= " ORDER BY ".$columnName." ".@$sort." ";
        }
    }
    $stmt = sqlsrv_query($conn, $tsql);
    // echo "<tr><td colspan='500'>$tabla</td></tr>";
    // echo gSleepTable($stmt,$tabla);
    $html ='';
    $i = 0;
    if($stmt){
        foreach(sqlsrv_field_metadata($stmt) as $field){
            // $html .= '<th><span onclick=\'sortTable("'.$tabla.'","'.$field['Name'].'");\'>'.$field['Name'].'</span></th>';
            $i++;
        }
        // $html .= '</tr>';
        $x = 0;
        $html .= "<tr>";
        while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_BOTH)){
            for ($j = 0; $j < $i; $j++) {
                if($j > 0){
                    if ($row[$j] instanceof DateTime) {
                        $html .= "<td class='hd-table'>".$row[$j]->format('m/d/Y H:i:s')."</td>";
                    }else{
                        $html .= "<td class='hd-table'>".($row[$j] == '' ? '0' : $row[$j]) ."</td>";
                    }
                }else{
                    if(!@$id) $id =$row[$j];
                    $html .= '<td class="noprint hd-table"><a href="#" data-toggle="modal" id="myBtn" class="noprint edit" data-id="sleepedit.php?id='.$id.'&tb='.$tabla.'"><i class="fa-solid fa-pencil"></i></a></td>';
                }
            }
            $x++;
            $html .= '</tr>';
        }
    }else{
        $html .= '<td class="noprint hd-table">No se encontraron resultados, verifique sus datos e intente nuevmente.</td>';
    }
    echo $html;
}

?>
