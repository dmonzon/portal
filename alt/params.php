<!DOCTYPE html>
<?php
    ini_set('display_errors', 0);
    ini_set('log_errors', 0);
    error_reporting(E_ALL & ~E_NOTICE);
    session_start();
    require_once("cno.php");
    require_once("control.php");
    include('header.php');
    if (!isset($_SESSION['username'])) {
        header('location:logout.php');
        exit();
    }
?>
<head>
    <title></title>
    <link rel="stylesheet" type="text/css" href="w.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<script src="jsfunc.js"></script>
	<script src="idle.js"></script>    
</head>
<script type="text/javascript"> 
      $(document).ready( function() {
        $('#msg').delay(1000).fadeOut();
      });
</script>
<script type="text/javascript">
    $(function(){ 
        $("textarea").bind("dblclick", function(){
            alert($(this).text());
        });
    });
</script>
<style>
    .msg{
        border-bottom: 2px solid green;
        background-color: green;
        color: white;
        height: 100px;
        line-height: 100px;
        font-size:20px;
        position : fixed;
        width : 100%;
        text-align : center;
        z-index : 999999;
        top : 30%;
        left : 0;
    }
</style>
<body>
    <div class="contentt noprint">
        <table style="width: 100%;">
            <thead>
                <tr>   
                    <th style="text-align:center; vertical-align: text-top;">
                        Projects
                    </th>
                    <th colspan="5" style="text-align: center;">
                        <form name="main" action="params.php" target="_self" method="POST">
                            <input type="radio" id="tbl1" name="table" value="Var_Proc_Mst" <?php (@$_POST['table'] == 'Var_Proc_Mst') ? 'checked' : '' ;?>>
                                <label for="tbl1">Var_Proc_Mst</label>
                            <input type="radio" id="tbl2" name="table" value="Var_Proc_Email" <?php (@$_POST['table'] == 'Var_Proc_Email') ? 'checked' : '' ;?>>
                                <label for="tbl2">Var_Proc_Email</label>
                            <input type="radio" id="tbl3" name="table" value="Var_Proc_Name" <?php (@$_POST['table'] == 'Var_Proc_Name') ? 'checked' : '' ;?>>
                                <label for="tbl3">Var_Proc_Name</label>
                            <button class="dentro">Go</button>
                            <input type="hidden" name="req" value="1">
                        </form>
                    </th>
                </tr>
            </thead>
    </div>
</table>
    <div>        
    </div>
        <?php
        if($_POST){
            switch ($_POST['req']) {
                case 'updateEm':
                    //echo "updating email ...";
                    updateEmail($_POST);
                    tblParams('',0,$_POST['table']);
                    //echo $_POST['tabl]').">>>>>>>>>>>>";
                    break;
                case 'updateMstr':
                    // echo "updating master ...";
                    updateMstr($_POST);
                    break;
                case 'updateName':
                    // echo "updating name ...";
                    updateName($_POST);
                    break;
                case 'updatePath':
                    // echo "updating path ...";
                    updatePath($_POST);
                    break;
                case 'updateMsg':
                    // echo "updating msg ...";
                    updateMsg($_POST);
                    break;
                case 'updateAttach':
                    // echo "updating attach ...";
                    updateAttach($_POST);
                    break;
                case 'insertAttach':
                    // echo "inserting attach ...";
                    insertAttach($_POST);
                    break;
                case 'insertMsg':
                    // echo "inserting Msg ...";
                    insertMsg($_POST);
                    break;   
                case 'insertPath':
                    // echo "inserting path ...";
                    insertPath($_POST);
                    break;
                case 'insertName':
                    // echo "inserting Name ...";
                    insertName($_POST);
                    break;
                case 'insertEmail':
                    // echo "inserting Email ...";
                    insertEmail($_POST);
                    break;
                case 'insertMst':
                    // echo "inserting Mst ...";
                    insertMst($_POST);
                    break;
                default:
                    break;
            }
            ($_POST['table']) ? $item = $_POST['table'] : $item = '';
            echo tblParams('',0,$item);
        }
         ?>
</body>
<script>
    $(document).inactivityTimeout();
</script>