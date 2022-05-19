<?php
    // include('header.php');
    require_once("ctrlDB.php");
    header('Content-Type: text/html; charset=utf-8');
?>
<head>
    <link rel="stylesheet" type="text/css" href="w.css">
    <script src="https://kit.fontawesome.com/2a9ceb1fca.js" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="jq.js"></script>
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
<body><meta name="viewport" content="width=device-width, initial-scale=1"><div style="padding: 200px 0; text-align: center;"><img src="ham.jpg"></br></br></br>
        <?php 
        //echo '<pre>';

        if($_GET){
            require("cno.php");
            $db = new ServidorBD();
            $conn = $db->Conectar('a');
            $cid = $_GET['cid'];
            $tsql = "SELECT id,nombre,descripcion,misc FROM Utilizacion_Empleados where id = $cid";
            $getResults = sqlsrv_query($conn, $tsql);
            $row = sqlsrv_fetch_array($getResults, SQLSRV_FETCH_ASSOC);
            
            echo '<form action="utilnew.php" id="frmCCu" method="post">
            <input type="hidden" id="opt" name="opt" value="1"><input type="text" id="nombre" name="nombre" placeholder="Nombre">
            <input type="text" id="desc" name="desc" placeholder="Descripcion">
            <input type="text" id="misc" name="misc" placeholder="">
            <input type="Submit" value="Actualizar"><button onclick="window.history.back();">Cancelar</button>';
        }else{
            echo '<form action="utilnew.php" id="frmCCu" method="post">
            <input type="hidden" id="opt" name="opt" value="0">
            <input type="text" id="nombre" name="nombre" placeholder="Nombre">
            <input type="text" id="desc" name="desc" placeholder="Descripcion">
            <input type="text" id="misc" name="misc" placeholder="">
            <button onclick="submit;">Someter</button><button onclick="window.history.back();">Cancelar</button>';
        }

        if($_POST){
            switch ($_POST['opt']) {
                case 0: #insert new employee
                    doEmpleado($_POST);
                    //header("Location:utilnew.php");
                    break;
                case 1: # update employee
                    require("cno.php");
                    $db = new ServidorBD();
                    $conn = $db->Conectar('a');
                    $cid = utf8_encode($_POST['cid']);
                    $cname = utf8_encode($_POST['cname']);
                    $cdesc = $_POST['cdesc'];
                    $tsql = "UPDATE CostCenters 
                            SET [description] = ? ,costcenter = ?
                                ,modified = (select GETDATE()) 
                            WHERE id = ?"; 
                    $params = array($cdesc,$cname,$cid);
                    $stmt = sqlsrv_prepare( $conn, $tsql, $params);  
                    if( sqlsrv_execute( $stmt))  
                    {  
                        echo '<h1 style="color:green;"> Successfully updated!</h1>';  
                    }else{  
                        die( print_r( sqlsrv_errors(), true));  
                    }
                    sqlsrv_free_stmt( $stmt);  
                    sqlsrv_close( $conn);
                    header("Location:censo.php");
                    break;
                    
                default:
                    # select area
                    break;
            }

        }
?>

</div>
</body>
