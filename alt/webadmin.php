<!DOCTYPE html>
<head>
    <title>Server <?php echo $serverName?></title>
    <link rel="stylesheet" type="text/css" href="w.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<script src="jsfunc.js"></script>
	<script src="idle.js"></script>    
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
    </style>
</head>
<body>
<?php
    ini_set('display_errors', 1);
    ini_set('log_errors', 0);
    error_reporting(E_ALL & ~E_NOTICE);
    session_start();
    require_once("ctrlDB.php");
    include('header.php');
    if (!isset($_SESSION['username'])) {
        header('location:logout.php');
        exit();
    }
            $item = '';
            
    if($_POST){
        // echo "<pre>";
        // print_r($_POST);
        // echo "</pre>";
        switch ($_POST['req']) {
            case 'doGroup':
                doGroup($_POST);
                break;
            case 'doOption':
                doOption($_POST);
                break;
            case 'doLogic':
                doLogic($_POST);
                break;
            default:
                break;
        }
        // ($_POST['table']) ? $item = $_POST['table'] : $item = '';
    }
    echo gGroups($item);
    echo gOptions($item);
    echo gGxO($item);
?>

</body>
<script>
    $(document).inactivityTimeout();
</script>