<!DOCTYPE html>
<?php
ini_set('display_errors',1);
ini_set('log_errors',0);
error_reporting(E_ALL & ~E_NOTICE);
session_start();
require_once("cno.php");
require_once("ctrlDB.php");
// require_once("funcs.php");
include('header.php');

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    runSpEcqm();
}
?>
<head>
    <meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="w.css">
    <script src="https://kit.fontawesome.com/2a9ceb1fca.js" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="idle.js"></script>
    <script src="ecqm.js"></script>
    <script type="text/javascript"> 
      $(document).ready( function() {
        $('#msg').delay(1000).fadeOut();
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
        .mystyle{
            /* border-bottom: 2px solid red; */
            background-color: #F1C2C2;
            border:red; border-style: solid;
            color: black;
            height: 90%;
            /* line-height: 100px; */
            font-size:18px;
            position : fixed;
            width : 98%;
            text-align : center;
            z-index : 99999999;
            top : 8%;
            left : 0;
            display: none;
        }

</style>
</head>
<html>
    <body><meta name="viewport" content="width=device-width, initial-scale=1">
    <div style="text-align:center;">
        </br></br></br>
        <h2>Run ECQM - File Transfer JOB</h2>
        <i class="fa-brands fa-nfc-directional"></i></br>
        <i class="fa-solid fa-arrows-turn-to-dots"></i>
        <i class="fa-solid fa-arrows-rotate"></i>
        <i class="fa-solid fa-tower-cell"></i>
    <form id="frmM" method="post">
        <button id="btnSm"><img src="./imgs/arrows-rotate-solid.svg" alt="" height="100" weight="100" onclick="return confirm('Está seguro?')"></button>
    </form>
    </div>
    <div id="msg" class="msg" style="display: none">Job Initiated.</div>
    </body>
</html>
<script>
    $(document).inactivityTimeout();    
</script>
<script>
function openDiv(divName){
    var i;
    var x = document.getElementsByClassName("divx");
    for (i = 0; i < x.length; i++) {
        x[i].style.display = "none";  
    }
    document.getElementById(divName).style.display = "block";  
}
</script>