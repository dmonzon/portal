<!DOCTYPE html>
<?php 
ini_set('display_errors', 0);
ini_set('log_errors', 0);
error_reporting(E_ALL & ~E_NOTICE);
session_start();
require_once("cno.php");
include('header.php');
include("funcs.php");
/********************************************
 * Danny Monzon
 * 20210630
 ********************************************/
if (!isset($_SESSION['username'])) {
    header('location:logout.php');
    exit();
}
?>
<head>
    <link rel="stylesheet" type="text/css" href="w.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="jsfunc.js"></script>
    <script src="idle.js"></script>
</head>
<body>
    <div>
        <table>
            <thead class="noprint">
                <form id="main" action="confirm.php" method="POST">
                    <tr>
                        <th colspan="4">DAILY CK LIST</th>
                        <th colspan="5" style="text-align: center;">DATE</th>
                    </tr>
                    <tr>
                        <th colspan="4">
                            <span style="font-style:oblique;">
                                <h3>VHAMSL10SVR</h3>
                            </span> 
                        </th>
                        <th colspan="5" style="text-align: center;">
                            <input type="date" id="txtDate" name="txtDate" placeholder="mm/dd/yyyy" value="<?php echo date('Y-m-d'); ?>">
                        </th>
                    </tr>
            </thead>
            <tbody class="noprint">
                <?php
                require_once("cno.php");
                $db= new ServidorBD;
                $conn = $db->Conectar('a');
                if(count($_GET) > 0){
                    if (!$conn)
                        die("<pre>".(sqlsrv_errors())."</pre>");
                    $tsql = "select id,job_name from DailyJobs order by 2";
                    $getResults = sqlsrv_query($conn, $tsql);
                    $dd = '<select name="logid[]">';
                    while ($row = sqlsrv_fetch_array($getResults, SQLSRV_FETCH_ASSOC)) {
                        $dd .= '<option value="' . $row['id'] . '">' . $row['job_name'] . '</option>';
                    } //end while
                    $dd .= '</select>';
                    if (count($_GET) <= 0) {
                        $control = 1;
                    } else {
                        $control = count($_GET);
                    }
                    for ($i = 0; $i < $control; $i++) {
                        echo '<tr>
                            <td colspan="4">' . ($i + 1) . '. ' . $dd . '</td>
                            <td>Time:</td>
                            <td><input type="datetime-local" name="time[]" placeholder="runtime" value="'.date('Y-m-d\T00:00').'" required></td>
                            <td><input type="number" min="0" max="24" name="hh[]" style="width: 50px;"></td>
                            <td><input type="number" min="0" max="59" name="min[]" style="width: 50px;"></td>
                            <td><input type="number" min="0" max="59" name="ss[]" style="width: 50px;" required></td>
                            </tr>';
                    }
                }else{
                    !empty($_POST['txtDate']) ? $logDate=$_POST['txtDate'] : $logDate = date('Y-m-d');
                    $tsql = "select id,job_name from DailyJobs where Active = 1 order by job_Group,priority;";
                    $getResults = sqlsrv_query($conn, $tsql);
                    if ($getResults == FALSE)
                        die("<pre>".(sqlsrv_errors())."</pre>");
                    $i = 0;
                    //building form fields
                    while ($row = sqlsrv_fetch_array($getResults, SQLSRV_FETCH_ASSOC)) {
                        $i++;
                        echo '<tr>
                            <td colspan="4">' . $i . '. ' . $row['job_name'] . '<input type="hidden" name="logid[]" value="' . str_replace(' ', '', $row['id']) . '"></td>
                            <td>Runtime: <input type="datetime-local" name="time[]" placeholder="runtime" value="'.date('Y-m-d\T00:00').'" required></td>
                            <td><input type="number" min="0" max="24" name="hh[]" placeholder="hh" ></td>
                            <td><input type="number" min="0" max="59" name="min[]" placeholder="mm"></td>
                            <td><input type="number" min="0" max="59" name="ss[]" placeholder="ss" required></td>
                            </tr>';
                        
                    } //end while
                }
                ?>
                <tr><td colspan="9"><textarea name="notes" rows="4" cols="100" placeholder="Notas"></textarea></td></tr>
                <tr>
                    <td colspan="10" class="noprint">
                        <input type="hidden" name="total" value="<?php echo ($i - 1); ?>">
                        <button class="dentro" >Submit</button>
                    </form>
                    </td>
                </tr>
            <tfoot style="color: #000; background:#FFF7F9;padding: 10px; border: 1px solid red; text-align: left; font-size: 15px;" class="print">
                <?php
                    if (@$_POST['txtDate']) {
                        $logDate = $_POST['txtDate'];
                        $print = "Logs for " . date('F j, Y', strtotime($logDate));
                    } else {
                        $logDate = date('Y-m-d');
                        $print = "Logs for Today's";
                    }

                    $date = (!empty($_POST['txtDate'])) ? $_POST['txtDate'] : date('Y-m-d');
                    echo '<p><th colspan="9" style="text-align: center;">' . $print . '
                   </th></p>
                        <tr>
                        <td colspan="9" style="text-align: center;" class="noprint">
                            <form id="form2" action="jobs.php" method="POST">
                            <input type="date" id="txtDate" name="txtDate" class="noprint" value="'. $date .'" required>
                            <input type="hidden" name="option" value="1">
                            <button class="dentro">View date logs</button><button onclick="window.print();" class="dentro noprint" style="text-align: right;">Print</button>
                            </form>
                        </td>
                        </tr>';
                    require("selectjobs.php");
                    sqlsrv_free_stmt($getResults);
                    $db->Desconectar();
                    ?>
            </tfoot>
        </table>
    </div>
</body>
 <script>
    $(document).inactivityTimeout();
</script>