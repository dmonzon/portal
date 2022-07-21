<!DOCTYPE html>        
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<!-- <link rel="stylesheet" type="text/css" href="w.css"> -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<link href="jquery-ui.css" rel="stylesheet">
<script src="https://kit.fontawesome.com/f95af9be80.js" crossorigin="anonymous"></script>
<script src="sleeplogs.js"></script>
<script src="idle.js"></script>
<script>
    function sortTable(tabla,columnName){
        var sort = $("#sort").val();
        var tsql = $("#tsql").val();
        // alert(tsql);
        $.ajax({
        url:'info_details.php',
        type:'post',
        data:{tabla:tabla,columnName:columnName,sort:sort,tsql:tsql},
        success: function(response){

        // $("#empTable tr:not(:first)").remove();
        $("#empTable tr:gt(1)").remove();

        $("#empTable").append(response);
        if(sort == "asc"){
            $("#sort").val("desc");
        }else{
            $("#sort").val("asc");
        }

        }
        });
    }
    $(document).ready(function(){
        $(".edit").click(function(){
            url = $(this).attr("data-id");
            // alert(url);
            $("#myModal").modal();
            load_page(url);
        });
    });

    function load_page(url){
        $('#modal-body').load(url,function(){});
    }
</script>
<style type = "text/css">
    a:link {
	    color: red;
	}
	
	/* visited link */
	a:visited {
	    color: red;
	}
	
	/* mouse over link */
	a:hover {
	    color:darkred;
	}
	
	/* selected link */
	a:active {
	    color: chocolate;
    }
    @media screen,print{
        body { font-family: "Open Sans", sans-serif; font-size:12px; }
        .tab {
            tab-size: 4;
            background:#FEE5E5;
            border:none;
        }
        table {
            border-collapse: collapse;
            width: 95%;
            margin-left: auto;
            margin-right: auto;
        }
        span:hover{
            cursor:pointer;
            color:red;
        }
        th, td {
            text-align: left;
            padding: 5px;
            border: 1px solid red; 
        }        
        tr:nth-child(even) {background-color: #FEE5E5 !important;}
    }
    @media print
        {
        .noprint {display: none !important;}
        }
    }
</style>
</head>
<body>
<?php
ini_set('display_errors',0);
ini_set('log_errors',0);
error_reporting(E_ALL & ~E_NOTICE);
session_start();
require_once('cno.php');
include('header.php');
$db = new ServidorBD();
$conn = $db->Conectar('x');
if($_GET){
    // echo "<pre>GET";
    // var_dump($_GET);
    $tabla = $_GET['tb'];
    if($_GET['tb'] === 'fnd')
    {

    }else{
        $tsql = "SELECT * FROM $tabla 
                WHERE DATEPART(YEAR, [Created]) = DATEPART(YEAR, CURRENT_TIMESTAMP)
                or    DATEPART(YEAR, [Modified]) = DATEPART(YEAR, CURRENT_TIMESTAMP)
                ORDER by Modified desc" ;
        //$tsql = $sql . "order by Modified desc" ;
    }
}
if($_POST){
    // echo '<pre>';
    // var_dump($_POST);
    $tabla = @$_POST['tb'];
    extract($_POST);
    if($tb ==='s'){
        echo 'under construction';
    }else{
        SleepQrys($_POST);
        $tsql = "SELECT * FROM $tabla order by Modified desc" ;
    }
}
?>
    <div style="text-align:center;width=95%;">
        <img src="imgs/ham-logo.png"></br></br>
        <!-- para el titulo se llama la funcion getRepTittle en cno.php -->
        <?php echo '<span style="color:red;font-style:oblique;font-size: 30px;font-stretch: expanded;font-weight: bold;">'.getRepTittle($tabla).'</span>';?></br></br>
        <!-- <button class="noprint" style="border:none;color:red;background:none;" alt="Back" onclick="javascript:history.back();"><i class="fa-solid fa-arrow-left-long fa-lg"></i></button> -->
        <button class="noprint" style="border:none;color:red;background:none;" alt="Back" onclick="window.location.href = 'sleeplogs.php';"><i class="fa-solid fa-house-crack fa-lg"></i></button>
        <button class="noprint" style="border:none;color:red;background:none;" alt="Print" onclick="javascript:window.print();"><i class="fa-solid fa-print fa-lg"></i></button>
        <a class="noprint" href="sleepfnd.php?tb=<?php echo $tabla ?>" target="_self"><i class="fa-solid fa-magnifying-glass fa-lg"></i></a>
    </div>
    <div style="width=95%;">
        </br>
        <input type='hidden' id='sort' value='asc'>
        <input type='hidden' id='tsql' value='<?php echo $tsql?>'>
        <?php 
            // echo '<table class="hd-table" id="empTable"><tr><td colspan="500"><center><b><h4>'.getRepTittle($tabla).' - '.$opt."</h4></b></center></td></tr></table>";
            echo '<table class="hd-table" id="empTable">';//<table width='95%' id='empTable'>
            $getResults = sqlsrv_query($conn, $tsql);
            $i =0;
            echo '<tr>'; //#FFF7F9
            if($getResults){
                $res = sqlsrv_has_rows( $getResults );
                if($res > 0){
                    echo gSleepTable($getResults,$tabla,$tsql,'0');
                }else{
                    echo '<td style="color:#000;" colspan="100"><b>No se generon resultados.</b></br></td></tr>';
                }
            }
    ?>
    </table>
</div>
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
      <div class="modal-body" id="modal-body">
      </div>
</div>
</body>
<script>
    $(document).inactivityTimeout();
</script>