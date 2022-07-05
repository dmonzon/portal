<!DOCTYPE html> 
<?php
include_once('header.php');
/********************************************
 * Danny Monzon
 * created:20210607     updated: 20210622
 ********************************************/
?>
<head>
    <link rel="stylesheet" type="text/css" href="w.css">
</head>
<body>
    <div>
        <table>
            <thead>
            <tr>
                <th colspan="4">DAILY CK LIST</th>
                <th colspan="2">DATE: <?php echo $_POST['txtDate']; ?></th>
                <th><div class="noprint"><button id="btnPrint" onclick="javascript:window.print()" class="dentro">Print</button></div></th>
            </tr>
            <tr>
                <th colspan="4">Server:<span style="font-style:oblique;"><h3>VHAMSL10SVR</h3></span> </th>
                <th colspan="2" style="text-align: left;">STARTED</th><th>DURATION</th>
            </tr>
            <tr></tr><tr></tr>
            </thead>
            <tbody>
                <?php 
                    if($_POST){
                        //connect to DB
                        echo "<pre>";
                        require_once("cno.php");
                        $db = new ServidorBD();
                        $conn = $db->Conectar('a');
                        if( $conn === false ){
                            echo "Could not connect.\n";
                            die( print_r( sqlsrv_errors(), true));
                        }
                        //preparing to insert
                        //print_r($_POST);
                        $logDate = $_POST['txtDate'];$logid = $_POST['logid'];
                        $tot = $_POST['total'];
                        $duration='';
                        for ($i=0; $i <= $tot; $i++) { 
                            $hh = !($_POST['hh'][$i]) ? '00' : $_POST['hh'][$i] ;
                            $min = !($_POST['min'][$i]) ? '00' : $_POST['min'][$i] ;
                            $ss = !($_POST['ss'][$i]) ? '00' : $_POST['ss'][$i] ;
                            $duration = date('H:i:s', strtotime($hh . ':' .  $min . ':' . $ss));
                            $time = str_replace('T', ' ', $_POST['time'][$i]);//$_POST.time')[$i]; 
                            $tsql = "insert into DailyJobsDet (JobID,job_date,runtime,duration) values (?,?,?,?)";
                            $params = array($logid[$i],"$logDate","$time","$duration");
                            $getResults= sqlsrv_query($conn, $tsql, $params);
                            if( $getResults === false ) {
                                die( print_r( sqlsrv_errors(), true));
                            }
                            //inserting note
                            if($_POST['notes']){
                                $notes = !($_POST['notes']) ? '' : $_POST['notes'];
                                $tsql = "insert into DailyJobsNotes (jobs_date,note) values (?,?)";
                                $params = array("$logDate","$notes");
                                //print_r($params); 
                                $getResults= sqlsrv_query($conn, $tsql, $params);
                                if( $getResults === false ) {
                                    die( print_r( sqlsrv_errors(), true));
                                }
                            }
                        }
                        //echo "inserted!!";
                        $db->Desconectar();
                        require_once("selectjobs.php");
                    }else{
                        $logDate = $_GET['d'];
                        require_once("cno.php");
                        require("selectjobs.php");
                        $db->Desconectar();
                    }
                    echo "</pre>";
                ?>
            </tbody>    
        </table>
    </div>
</body>