<html>
<head>
    <link rel="stylesheet" type="text/css" href="alt/style.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="alt/jq.js"></script>
    <script src="alt/idle.js"></script>
</head>
<body></br></br>
  <center>
    <h2>
    <p><img src="alt/imgs/ham.jpg"></p></br></br>
    <?php
      echo isset($_GET['expired']) ? 'You\'ve been logged out due to inactivity, please login again.</br>' : 'Please login.</br>' ;
    ?>
    </h2>
</center>
  <center>
  <form action="index.php" method="post">
      <input type="text" name="username" placeholder="Username" required/><br>
      <input type="password" name="password" placeholder="Password" required/></br>
      <input type="submit" value="Login" />
    </form>
</center>
</body>
</html>
<?php
// iniciar sesion
session_start();
ini_set('display_errors', 0);
ini_set('log_errors',0);
error_reporting(E_ALL & ~E_NOTICE);
// include('alt/header.php');
if($_POST){
  $ldaprdn  = $_POST["username"];
  $domain = '@auxiliomutuo.com';
  $ldappass = $_POST["password"];
  require_once('alt/funcs.php');
  require_once("alt/cno.php");
  $db = new ServidorBD();
  $conn = $db->Conectar('a');
  $tsql = "SELECT [id],[GroupName],[GroupOU] FROM [dbo].[WebGroups]";  
  $getResults = sqlsrv_query($conn, $tsql);
  if( $getResults === false ) {
      die( print_r( sqlsrv_errors(), true));
  }
  while ($row = sqlsrv_fetch_array($getResults, SQLSRV_FETCH_NUMERIC)){
      $opciones[] = trim($row[1]);
  }
  $groups = get_groups($ldaprdn,$ldappass);
  foreach ($groups as &$str) {
    //echo "</br>$str";
    $str = str_replace('CN=', '', strtok($str, ","));
    //echo "$str</br>";
  }
  // echo '<pre>u';
  // print_r($groups);
  if(in_array("MIS Database",$groups)){
    $temp = allGroups($ldaprdn,$ldappass);
    $final = array_values(array_diff($temp,$groups));
    $_SESSION['Grupox'] = $final;
  }

  $menu = [];
  // $tstart = microtime(true);
  $menu = array_intersect($opciones,$groups);
  // echo '<pre>Menu';
  // print_r($menu);
  // $tend = microtime(true);
  // $time = $tend - $tstart;
  // echo "Totsl: ".count($menu)."</br>Took $time";
  if(count($menu) > 0){
    //crear menu
    $html = buildMenu($menu,$conn);
    if($html){
        // guardando valores de la sesion
        $_SESSION["user_id"] = $_POST["username"].date('His');
        $_SESSION["user_name"] = $_POST["username"];
        $_SESSION['loggedin_time'] = time();
        $_SESSION["nav"] = $html;
        // redirigir al dashboard o desconectar
        if(isset($_SESSION["user_name"]))
            header("Location:alt/dashboard.php");
        else
            header("Location:alt/logout.php?session_expired=1");
        // echo '<pre>';
  }
  }else{
      echo  '</br><h2 style="text-align:center;">Acceso requerido, comuniquese con su supervisor.</br>';
  }
}

?>