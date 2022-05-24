<html>
<head>
<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="p.css">
    <script src="https://kit.fontawesome.com/2a9ceb1fca.js" crossorigin="anonymous"></script>
    <style>
        .mystyle{
            /* border-bottom: 2px solid red; */
            background-color: #F1C2C2;
            border:red; border-style: solid;
            color: black;
            height: auto;
            /* line-height: 100px; */
            font-size:15px;
            position : fixed;
            width : 98%;
            text-align : center;
            z-index : 99999999;
            top : 8%;
            left : 0;
            display: none;
        }
        .dot {
            height: 17px;
            width: 17px;
            background-color:#C5EDB3;
            border-radius: 50%;
            display: inline-block;
            vertical-align: middle;
        }
        #forma {
            float:left;
            width:79%;
            padding:0px;
            padding-top: 5px;
        }
        #empleados {
            float:right;
            width:20%;
            padding:0px;
            padding-top: 5px;
            padding-left: 2px;
        }
        ul.no-bullets {
            list-style-type: none;
            padding: 0;
            margin: 0;
        }
</style>
</head>
<?php
ini_set('display_errors',0);
ini_set('log_errors',0);
error_reporting(E_ALL & ~E_NOTICE);
session_start();
// echo "<pre>";
// var_dump($_SESSION);
// echo "</br>";
require_once("cno.php");
require_once("ctrlDB.php");
require_once("funcs.php");
include('header.php');
// echo '<pre></br>';
// print_r($_GET);
// echo $_SERVER['REQUEST_METHOD'];
if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $x = $_POST;
    $opt = $x['opt'];
    $qrys = 'values';
    if($opt==1){
        $alta = RegisterAltas();
        for ($i=0; $i < count($x['uid']) ; $i++) { 
            $manejador1  = ($x['manejadora'][$i] === 'false' ? 0 : trim($x['manejadora'][$i]));
            $manejador2  = ($x['manejadorb'][$i] === 'false' ? 0 : trim($x['manejadorb'][$i]));
            $planificador1  = ($x['planificadora'][$i] === 'false' ? 0 : trim($x['planificadora'][$i]));
            $planificador2  = ($x['planificadorb'][$i] === 'false' ? 0 : trim($x['planificadorb'][$i]));
            $qty1  = ($x['qtya'][$i] === 'false' ? 0 : trim($x['qtya'][$i]));
            $qty2  = ($x['qtyb'][$i] === 'false' ? 0 : trim($x['qtyb'][$i]));
            $qty3  = ($x['qtyc'][$i] === 'false' ? 0 : trim($x['qtyc'][$i]));
            $qty4  = ($x['qtyd'][$i] === 'false' ? 0 : trim($x['qtyd'][$i]));
            $tot  = trim($x['hid'][$i]);
            $unidad  = trim($x['uid'][$i]);
            $campos[]=array($unidad,$manejador1,$qty1,$manejador2,$qty2,$planificador1,$qty3,$planificador2,$qty4,$tot);
            $qrys .= '('.$unidad.",'".date('Y-m-d')."',".$manejador1.','.$qty1.','.$manejador2.','.$qty2.','.$planificador1.','.$qty3.','.$tot.','.$planificador2.','.$qty4.','.$alta.",'".$_SESSION['username']."'),";
        }
        $sql=' values';
        $empid  = 'empid';$qty = 'q';$u = 0;$username = $_SESSION['username'];
        //insertar reocrd en tabla de altas y pbtener el id
        // insertar los totales de los empleados
        foreach ($x['revi'] as $key => $value) {
            ($x['plan'][$key] > 0 ? $p = $x['plan'][$key]: $p = 0);
            ($value > 0 ? $r = $value : $r = 0);
            $sql .= '('.$key.','.$r.','.$p.','.$alta.'),'; 
        }
        $sql = substr($sql, 0, -1);
        $qrys = substr($qrys, 0, -1);
        $campos = array($qrys,$sql);
        $date = date('Y-m-d');
        $created = date('Y-m-d H:s:i');
        if($alta > 0){
            $sql = insNewAltaDet($campos,$username,$alta);
            sleep(.5);
            header("Location: ".$_SERVER['PHP_SELF']."?a=$alta");
        }else{
            die(FormatErrors(sqlsrv_errors()));
        }
    }elseif($opt == 2){
        $dia = getAltasRpt($_POST['ddPeriod'],0);
        getEmpTotals(getLastAltas($_POST['ddPeriod']));
        echo getAltas($_POST['ddPeriod']);
    }
}elseif($_SERVER['REQUEST_METHOD'] == 'GET'){
    $alta = (@$_GET['a'] ? $alta = $_GET['a'] : $alta = 0);
    // var_dump(@$dia);
    $dia = (@$_GET['d'] ? $date = $_GET['d'] : $dia = date('Y-m-d'));
    $dia = getAltasRpt(@$dia,$alta);
    getEmpTotals($alta);
    // var_dump($dia);
    echo getAltas($dia);
}

// echo getAltas('',$alta);
//$campos[]=array($u,$manejador1,$qty1,$manejador2,$qty2,$planificador1,$qty3,$planificador2,$qty4,$tot);
                // 0,    1          2      3          4         5          6        7           8    9
?>


</body>

</html>