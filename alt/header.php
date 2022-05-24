
<?php
//session_start();
if (!isset($_SESSION['username'])) {
    header('location:./logout.php');
    exit();
}
?>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
 <link rel="stylesheet" href="mnu1.css" type="text/css" media="screen" />

 <title></title>
</head>
 <body>
    <div>
    <div>
        <ul id="menu" class="noprint">
            <li><a href="dashboard.php" class="drop"><?php echo $_SESSION['username'];?></a>     
                <div class="dropdown_2columns">
                    <div class="col_2">
                        <img src="./imgs/ham-logo.png" width="230" height="70" alt="" />
                    </div>  
                <div class="col_1">   
                </div>
                <div class="col_2">
                    <h1><a href="logout.php" target="_self">Logout</a></h1>
                </div>
            </div>
            </li>
        <?php echo $_SESSION['nav'];?>
        </ul>
 <!-- <script>
    $(document).inactivityTimeout();
</script> -->