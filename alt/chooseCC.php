<head>
    <!-- <link rel="stylesheet" type="text/css" href="tabs.css"> -->
    <link rel="stylesheet" type="text/css" href="./m.css">
    <script src="https://kit.fontawesome.com/2a9ceb1fca.js" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="jq.js"></script>
    <script src="idle.js"></script>
</head>
<body><div style="  padding: 200px 0; text-align: center;"><img src="ham.jpg"></br></br></br>
        <?php 
        if($_GET){
            require("cno.php");
            $db = new ServidorBD();
            $conn = $db->Conectar('a');
            $cid = $_GET['cid'];
            $tsql = "SELECT id,[costcenter],[description] FROM [CostCenters] where id = $cid";
            $getResults = sqlsrv_query($conn, $tsql);
            $row = sqlsrv_fetch_array($getResults, SQLSRV_FETCH_ASSOC);
            
            $cname = $row['costcenter'];
            $cdesc = $row['description'];
                echo '<form action="chooseCC.php" id="frmCCu" method="post">
                <input type="hidden" id="cid" name="cid" value="'.$cid.'">
                <input type="hidden" id="option" name="option" value="2">
                <input type="text" id="cname" name="cname" value="'.$cname.'">
                <input type="text" id="cdesc" name="cdesc" value="'.$cdesc.'">
                <input type="Submit" value="Submit"><button onclick="window.history.back();">Cancel</button>';
        }
        if($_POST){
            require("cno.php");
            $db = new ServidorBD();
            $conn = $db->Conectar('a');
            $cid = $_POST['cid'];
            $cname = $_POST['cname'];
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
            header("Location:rccs.php");
        }
?>

</div>
</body>
