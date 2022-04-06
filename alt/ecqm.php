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
// 

?>
<head>
    <meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="w.css">
    <script src="https://kit.fontawesome.com/2a9ceb1fca.js" crossorigin="anonymous"></script>
    <script src="idle.js"></script>
</head>
<html>
    <body><meta name="viewport" content="width=device-width, initial-scale=1">
    <div style="text-align:center;">
        </br></br></br></br></br></br></br>
        <h2>Run ECQM - File Transfer JOB</h2>
        <i class="fa-brands fa-nfc-directional"></i></br>
        <i class="fa-solid fa-arrows-turn-to-dots"></i>
        <i class="fa-solid fa-arrows-rotate"></i>
        <i class="fa-solid fa-tower-cell"></i>
            <a href="#"><img src="./imgs/arrows-rotate-solid.svg" alt="" height="100" weight="100" onclick="return confirm('Está seguro?')"></a>
            <i class="fa-solid fa-building-circle-exclamation"></i>
        </div>
    </body>
</html>
<!-- 

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
</script> -->