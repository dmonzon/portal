<?php
// echo "<pre>";
// print_r($_POST);
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    @$period = $_POST['ddPeriod'].'/'.$_POST['period'];
}elseif ($_SERVER['REQUEST_METHOD'] === 'GET') {
    empty(!$_GET ) ? $period = $_GET['period'] : $period;
}
function selectAll($period){
    require_once("cno.php");
    $db = new ServidorBD;
    $conn = $db->Conectar('a');
    $tsql = "SELECT [rccPeriod]
                ,(select costcenter from CostCenters where id=c.[CostCenter])
                ,(select description from CostCenters where id=c.[CostCenter])
                ,[Direct_Labor_Cost]
                ,[RCC1]
                ,[Indirect_Labor_Cost]
                ,[RCC2]
                ,[Other_Dirct_Cost]
                ,[RCC3]
                ,[Indirect_Cost_Capital]
                ,[RCC4]
                ,[Indirect_Cost_Atribuible]
                ,[RCC5]
                ,[Indirect_Cost_Imputados]
                ,[RCC6]
                ,[Other_General_Cost]
                ,[RCC7]
                ,[Total_Cost]
                ,[Total_Charges]
                ,[RCC_Total_Cost]
                ,[Note] 
            from Cost_for_RCC c
            where rccPeriod like '$period' order by 2";
    $getResults = sqlsrv_query($conn, $tsql);
    if( $getResults === false ) {
        die( print_r( sqlsrv_errors(), true));
    }
    $i = 0;
    echo '<tr>
        <th style="text-align: center;"><h4>Period</h4></th>
        <th style="text-align: center;" colspan="2"><h4>COST CENTER DESCRIPTION</h4></th>
        <th style="text-align: center;"><h4>DIRECT LABOR COST</h4></th>
        <th style="text-align: center;"><h4>RCC</h4></th>
        <th style="text-align: center;"><h4>INDIRECT LABOR COST</h4></th>
        <th style="text-align: center;"><h4>RCC</h4></th>
        <th style="text-align: center;"><h4>OTHER DIRECT COST</h4></h4></th>
        <th style="text-align: center;"><h4>RCC</h4></th>
        <th style="text-align: center;"><h4>INDIRECT COST CAPITAL</h4></th>
        <th style="text-align: center;"><h4>RCC</h4></th>
        <th style="text-align: center;"><h4>INDIRECT COST ATRIBUIBLE</h4></th>
        <th style="text-align: center;"><h4>RCC</h4></th>
        <th style="text-align: center;"><h4>INDIRECT COST IMPUTADOS</h4></th>
        <th style="text-align: center;"><h4>RCC</h4></th>
        <th style="text-align: center;"><h4>OTHER GENERAL COST</h4></th>
        <th style="text-align: center;"><h4>RCC</h4></th>
        <th style="text-align: center;"><h4>TOTAL COSTS</h4></th>
        <th style="text-align: center;"><h4>TOTAL CHARGES</h4></th>
        <th style="text-align: center;"><h4>RCC TOTAL COST</h4></th>
        <th style="text-align: center;"><h4>Note</h4></th></tr>';
    while ($row = sqlsrv_fetch_array($getResults, SQLSRV_FETCH_NUMERIC)) {
        echo '<tr>
        <td style="text-align: center;">'.$row[0].'</td>
        <td style="text-align: center;">'.$row[1].'</td>
        <td style="text-align: left;">'.$row[2].'</td>
        <td style="text-align: right;">'.number_format($row[3], 2).'</td>
        <td style="text-align: right;">'.number_format($row[4], 6).'</td>
        <td style="text-align: right;">'.number_format($row[5], 2).'</td>
        <td style="text-align: right;">'.number_format($row[6], 6).'</td>
        <td style="text-align: right;">'.number_format($row[7], 2).'</td>
        <td style="text-align: right;">'.number_format($row[8], 6).'</td>
        <td style="text-align: right;">'.number_format($row[9], 2).'</td>
        <td style="text-align: right;">'.number_format($row[10], 6).'</td>
        <td style="text-align: right;">'.number_format($row[11], 2).'</td>
        <td style="text-align: right;">'.number_format($row[12], 6).'</td>
        <td style="text-align: right;">'.number_format($row[13], 2).'</td>
        <td style="text-align: right;">'.number_format($row[14], 6).'</td>
        <td style="text-align: right;">'.number_format($row[15], 2).'</td>
        <td style="text-align: right;">'.number_format($row[16], 6).'</td>
        <td style="text-align: right;">'.number_format($row[17], 2).'</td>
        <td style="text-align: right;">'.number_format($row[18], 2).'</td>
        <td style="text-align: right;">'.number_format($row[19], 6).'</td>
        <td style="text-align: center;">'.$row[20].'</td></tr>';
        $i++ ;
    }
    if ($i == 0){
        echo '<tr><td colspan="21"><center><h3>No entries</h3></center></tr></td>';
    }
}

function selectRccs($period){
    require_once("cno.php");
    $db = new ServidorBD;
    $conn = $db->Conectar('a');
    $x = explode('/',$period);
    switch ($x[0]) {
        case '3':
            $prev = '12/31/' . $x[2] - 1;
        break;
        case '6':
            $prev = '3/31/' . $x[2];
        break;
        case '9':
            $prev = '6/30/' . $x[2];
        break;
        case '12':
            $prev = '9/30/' . $x[2];
        break;
        default:
            # code...
            break;
    }
    //***************************** qry anterior sin la comparativa **************************//
    // $tsql = "SELECT (select [description] from CostCenters where id=c.[CostCenter]),
    //                 (select costcenter from CostCenters where id=c.[CostCenter]),
    //                 Total_Cost
    //         FROM Cost_for_RCC c
    //         WHERE rccperiod = '$period'";
    //***************************** qry anterior sin la comparativa **************************//
    $tsql = "SELECT 
            (select [description] from CostCenters where id=t1.[CostCenter]) 'Desc'
            ,(select costcenter from CostCenters where id=t1.[CostCenter]) 'C.C.'
            ,t1.[CostCenter],t1.Total_Cost 'Total Cost $prev'
            ,t2.[CostCenter],t2.Total_Cost 'Total Cost $period'
            ,COALESCE(t2.[CostCenter], 0) AS 'CC'
            ,t2.Total_Cost - t1.Total_Cost
    FROM 
        (select [CostCenter],Total_Cost from Cost_for_RCC where rccperiod ='$prev') t1
    LEFT JOIN
        (select [CostCenter],Total_Cost from Cost_for_RCC where rccperiod ='$period') t2
    ON (t1.[CostCenter] = t2.[CostCenter]);";
    $getResults = sqlsrv_query($conn, $tsql);
    if( $getResults === false ) {
        die( print_r( sqlsrv_errors(), true));
    }
    $i = 0;
    echo '<tr><th colspan="7">Period: '.$period.' vs '.$prev.'</th></tr>
        <th style="text-align: center;"><h4>COST CENTER DESCRIPTION</h4></th>
        <th style="text-align: center;"><h4>C.C.</h4></th>
        <th style="text-align: center;"><h4>TOTAL COSTS '.$prev.'</h4></th>
        <th style="text-align: center;"><h4>TOTAL COSTS '.$period.'</h4></th>
        <th style="text-align: center;"><h4>COMPARATIVA</h4></th>
        <th style="text-align: center;"><h4>Percentage</h4></th>
        </th></tr>';
    while ($row = sqlsrv_fetch_array($getResults, SQLSRV_FETCH_NUMERIC)) {
        echo "<tr>";
        echo '<td style="text-align: left;">'.$row[0].'</td>
              <td style="text-align: center;">'.$row[1].'</td>
              <td style="text-align: right;">'.$row[3].'</td>
              <td style="text-align: right;">'.$row[5].'</td>
              <td style="text-align: right;">'.$row[7].'</td>
              <td style="text-align: right;">'.number_format($row[7] * 100,2).'%</td>';
        echo "</tr>";
        $i++ ;
    }
    if ($i == 0){
        echo '<tr><td colspan="6"><center><h3>No entries</h3></center></td></tr>';
    }
    $db->Desconectar();
}

?>
