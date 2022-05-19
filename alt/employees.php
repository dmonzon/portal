<head>
    <link rel="stylesheet" type="text/css" href="./m.css">
    <script src="https://kit.fontawesome.com/2a9ceb1fca.js" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="jq.js"></script>
    <script src="idle.js"></script>

</head>
<body><div style="padding: 200px 0; text-align: center;"><img src="ham.jpg"></br></br></br>
        <?php 
		ini_set('display_errors',1);
		ini_set('log_errors',0);
		error_reporting(E_ALL & ~E_NOTICE);
		session_start();
        if($_GET){
			extract($_GET);
			if($opt == 'newE'){
				$data = array();
				$ename = $_GET['nombre'.$id];
				$eactive = $_GET['active'.$id];
				require("cno.php");
				$db = new ServidorBD();
				$conn = $db->Conectar('a');
				echo '<pre';
				//$cdesc = $_POST['edesc'];
				$tsql = "UPDATE Utilizacion_Empleados 
						SET [nombre] = ? ,active = ?
							,modified = (select GETDATE()) 
						WHERE id = ?"; 
				$params = array($ename,$eactive,$id);
				$stmt = sqlsrv_prepare( $conn, $tsql, $params);  
				if( sqlsrv_execute($stmt))  
				{  
					echo '<h1 style="color:green;"> Successfully updated!</h1>';
					$data['status']= 'ok';
				}else{  
					die( print_r( sqlsrv_errors(), true));  
					$data['status']= 'error';
				}
				sqlsrv_free_stmt( $stmt);  
				sqlsrv_close( $conn);
				//header("Location:rccs.php");
			}else{
				require("cno.php");
				$db = new ServidorBD();
				$conn = $db->Conectar('a');
				$cid = $_GET['id'];
				$tsql = "SELECT id,[nombre],[active] FROM [Utilizacion_Empleados] where id = $cid";
				$getResults = sqlsrv_query($conn, $tsql);
				$row = sqlsrv_fetch_array($getResults, SQLSRV_FETCH_ASSOC);
				
				$cname = $row['nombre'];
				$cdesc = $row['active'];
                echo '<form action="employees.php" id="frmCCu" method="post">
                <input type="hidden" id="cid" name="cid" value="'.$cid.'">
                <input type="hidden" id="option" name="option" value="2">
                <input type="text" id="cname" name="cname" value="'.$cname.'">
                <input type="text" id="cdesc" name="cdesc" value="'.$cdesc.'">
                <input type="Submit" value="Submit"><button onclick="window.history.back();">Cancel</button>';
			}
		}
        if($_POST){
			require("cno.php");
			$db = new ServidorBD();
			$conn = $db->Conectar('a');
			// echo '<pre>';
			// print_r($_POST);
			extract($_POST);
			if($opt == 'regAu'){
				$mydate = date('Y-m-d H:i:s');
				$user = $_SESSION['user_name'];
				//$ename = $_POST['nombre'.$id];
				$tsql = "INSERT into Utilizacion_AusenciasDet
						([id_Ausencia],[Desde],[Hasta],[Created],[Modified],[Modifier],[id_Empleado])
					VALUES (?,?,?,?,?,?,?)";
				$params = array($auid,$desde,$hasta,$mydate,$mydate,$user,$empida);
			}else{
				if($opt == 'acEmp'){
					$_POST['eactive'] == 'on' ? $eactive = 1 :  $eactive = 0;
					//$eactive = $_POST['eactive'];
					$ename = $_POST['nombre'.$id];
					$empid = $_POST['empid'.$id];
					//$cdesc = $_POST['edesc'];
				}
				$tsql = "UPDATE Utilizacion_Empleados 
					SET [nombre] = ? ,[Active] = ?
					,modified = (select GETDATE()) 
					WHERE id = ?";
				$params = array($ename,$eactive,$empid);
			}
			$stmt = sqlsrv_prepare( $conn, $tsql, $params);  
			if( sqlsrv_execute( $stmt))  
			{  
				echo '<h1 style="color:green;"> Successfully updated!</h1>';
				$data['status']= 'ok';
			}else{  
				$data['status']= 'error';
				die( print_r( sqlsrv_errors(), true));
			}
			sqlsrv_free_stmt( $stmt);  
			sqlsrv_close( $conn);
			//sheader("Location:censo.php");
        }
?>

</div>
</body>