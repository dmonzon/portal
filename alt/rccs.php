<!DOCTYPE html>
<?php
ini_set('display_errors', 0);
ini_set('log_errors', 0);
error_reporting(E_ALL & ~E_NOTICE);
session_start();
require_once("cno.php");
require_once("control.php");
require_once("funcs.php");
include('header.php');
/********************************************
 * Danny Monzon
 * 20210909
 ********************************************/

if (!isset($_SESSION['username'])) {
    header('location:logout.php');
    exit();
}

?>
<head>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-modal/0.9.1/jquery.modal.min.css" />
    <link rel="stylesheet" type="text/css" href="w.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-modal/0.9.1/jquery.modal.min.js"></script>
    <script src="https://kit.fontawesome.com/2a9ceb1fca.js" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="jsfunc.js"></script>
    <script src="idle.js"></script>
</head>
<body><meta name="viewport" content="width=device-width, initial-scale=1">
    <div id="butns" style="text-align: center;" class="noprint">
        <button onclick="openDiv('forma')" ondblclick="openDiv('forma')">Main</button>
        <button onclick="openDiv('comparativa')">Comparativa</button>
    </div>
    <div id="main">
        <div id="forma" class="divx">
                <form id="main2" action="rccs.php" target="_self" method="POST">
                <table>
                    <thead class="noprint">
                        <tr class="noprint">
                            <th colspan="21"><h3>For the period of:  
                                <input type="text" list="lPeriod" id="ddPeriod" name="ddPeriod" required>
                                <datalist id="lPeriod" name="lPeriod">
                                    <option value="3/31" selected>Ene - Mar</option>
                                    <option value="6/30">May - Jun</option>
                                    <option value="9/30">Jul - Sep</option>
                                    <option value="12/31">Oct - Dic</option>
                                </datalist>
                                <input type="text" name="period" style="width:50px" value="<?php echo date('Y'); ?>" required></h3>
                            </th>
                        </tr>
                        <tr class="noprint">
                            <th colspan="3" style="text-align: center;"><h4>COST CENTER DESCRIPTION #</h4></th>
                            <th style="text-align: center;"><h4>DIRECT LABOR COST</h4></th>
                            <th style="text-align: center;"><h4>RCC</h4></th>
                            <th style="text-align: center;"><h4>INDIRECT LABOR COST</h4></th>
                            <th style="text-align: center;"><h4>RCC</h4></th>
                            <th style="text-align: center;"><h4>OTHER DIRECT COST</h4></h4></th>
                            <th style="text-align: center;"><h4>RCC</h4></th>
                            <th style="text-align: center;"><h4>INDIRECT COST CAPITAL</h4></th>
                            <th style="text-align: center;"><h4>RCC</h4></th>
                            <th style="text-align: center;"><h4>INDIRECT COST ATRIBUIBLE</h4></th>
                            <th style="text-align: center;"><h4>RCC</h4></th>
                            <th style="text-align: center;"><h4>INDIRECT COST IMPUTADOS</h4></th>
                            <th style="text-align: center;"><h4>RCC</h4></th>
                            <th style="text-align: center;"><h4>OTHER GENERAL COST</h4></th>
                            <th style="text-align: center;"><h4>RCC</h4></th>
                            <th style="text-align: center;"><h4>TOTAL COSTS</h4></th>
                            <th style="text-align: center;"><h4>TOTAL CHARGES</h4></th>
                            <th style="text-align: center;" colspan="2"><h4>RCC TOTAL COST</h4>
                            <!-- <label id="total"></label> -->
                        </th>
                            <!--<th style="text-align: center;"><h4>MISC</h4></th>-->
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="noprint">
                            <td colspan="3" style="text-align: left;">
                                <select name="costcenter" id="costcenter" onchange="updCCdata(this);">
                                    <option value="0">Select one...</option>'
                                    <?php
                                        $db = new ServidorBD();
                                        $conn = $db->Conectar('a');
                                        $tsql = "SELECT id,[costcenter],[description],[ccgroup] FROM [CostCenters] order by 2";
                                        $getResults = sqlsrv_query($conn, $tsql);
                                        while ($row = sqlsrv_fetch_array($getResults, SQLSRV_FETCH_ASSOC)) {
                                            $id = $row['id'];
                                            $cc = ($row['costcenter']) ? $row['costcenter'] : 'N/A' ;
                                            $lbl = $row['description'];
                                            echo '<option value="' . $id . '">('.$cc .') '.$lbl.'</option>';
                                        } //end while
                                        ?>
                                </select>
                                <a target="_self" ><i class="fas fa-plus" id="btNw"></i></a>
                                <a target="_self" href="#" class="btnNewCC" ><i class="fas fa-pencil-alt" id="btEd" style="visibility: hidden;"></i></a> 
                                <label id="lblCC" style="visibility: hidden;"></label>
                                <label id="lblDesc" style="visibility: hidden;"></label>
                            </td>
                            <td>
                                <input type="hidden" id="ccDesc" name="ccDesc" placeholder="H">
                                <input type="hidden" id="option" name="option" value="4">
                                <input type="number" name="DCL" step="any" class="tcost" style="width: 70px;">
                            </td>
                            <td><input type="number" min="0" id="RCC1" name="RCC1" class="rccs" step="any" style="width: 70px;"></td>
                            <td><input type="number" min="0" name="ILC" class="tcost" step="any" style="width: 70px;"></td>
                            <td><input type="number" min="0" name="RCC2" class="rccs" step="any" style="width: 70px;"></td>
                            <td><input type="number" min="0" name="OLC" class="tcost" step="any" style="width: 70px;"></td>
                            <td><input type="number" min="0" name="RCC3" class="rccs" step="any" style="width: 70px;"></td>
                            <td><input type="number" min="0" name="ICC" class="tcost" step="any" style="width: 70px;"></td>
                            <td><input type="number" min="0" name="RCC4" class="rccs" step="any" style="width: 70px;"></td>
                            <td><input type="number" min="0" name="ICA" class="tcost" step="any" style="width: 70px;"></td>
                            <td><input type="number" min="0" name="RCC5" class="rccs" step="any" style="width: 70px;"></td>
                            <td><input type="number" min="0" name="ICI" class="tcost" step="any" style="width: 70px;"></td>
                            <td><input type="number" min="0" name="RCC6" class="rccs" step="any" style="width: 70px;"></td>
                            <td><input type="number" min="0" name="OGC" class="tcost" step="any" style="width: 70px;"></td>
                            <td><input type="number" min="0" name="RCC7" class="rccs" step="any" style="width: 70px;"></td>
                            <td><input type="number" min="0" name="TOTCS" class="totals" id="TOTCS" step="any" style="width: 120px;"></td>
                            <td><input type="number" min="0" name="TOTCH" class="totals" id="TOTCH" step="any" style="width: 100px;" onchange="updTotRCC(this);"></td>
                            <td colspan="3"><input type="number" min="0" name="RCCTOT" id="RCCTOT" step="any" style="width: 100px;"></td>
                        </tr>
                        <tr class="noprint">
                            <td colspan="5" style="border-right: 0px;" >
                                <textarea name="note" rows="4" cols="50" placeholder="Notas"></textarea><br>
                                <input type="submit" name="submit" value="Submit"></form>
                            </td>
                            <td colspan="16" style="border-left:0px;" >
                                <div id="ccNew" class="noprint" style="visibility: hidden; text-align: left;">
                                New Cost Center
                                    <form id="nuevoCC" target="iframe_a" action="rccs.php" method="post" >
                                        <input type="text" id="txtNcc" name="txtNcc" placeholder="CostCenter" value="">
                                        <input type="text" id="txtNccD" name="txtNccD" placeholder="Description" value="">
                                        <input type="hidden" id="option" name="option" value="3">
                                        <button class="far fa-save" type="Submit">
                                    </form>
                                </div>
                            </td>
                        </tr>
                    <thead>
                        <?php
                        // resultados
                        $period = false;
                        if ($_POST) {
                            $opt = $_POST['option'];
                            switch ($opt){
                                case ($opt == 1):
                                    $period = $_POST['ddPeriod']. '/' . $_POST['period'];
                                break;
                                case ($opt == 4):
                                    $period = $_POST['ddPeriod']. '/' . $_POST['period'] ;
                                    newRecord($_POST);
                                break;
                                case ($opt == 2):
                                    updateCC($_POST['cid'],$_POST['cname'],$_POST['cdesc']);
                                break;
                                case ($opt == 3):
                                    insertCC($_POST['txtNcc'],$_POST['txtNccD']);                           
                                break;  
                            }
                        } 
                        if(!$period){
                            $mth = date('m');
                            switch (true) {
                                case $mth > 0 and $mth < 4:
                                    $period = '3/31/' . date('Y');
                                    break;
                                case $mth > 3 and $mth < 7:
                                    $period = '6/31/' . date('Y');
                                break;
                                case  $mth > 6 and $mth < 10:
                                    $period = '9/30/' . date('Y');
                                break;
                                case $mth > 9 and $mth < 13:
                                    $period = '12/31/' . date('Y');
                                break;
                            }
                        }
                        $print = "<h3>Entries for period $period </h3>";
                        echo '<th colspan="21" style="text-align: center;">' . $print . '</th>
                            <tr>
                            <th colspan="21" style="text-align: center;" class="noprint">
                                <form id="form_2" action="rccs.php" target="_self" method="POST">
                                <input type="text" id="ddPeriod" name="ddPeriod" class="noprint" list="lPeriod" required>
                                <input type="text" id="period" name="period" class="noprint" style="width: 50px;" value="'.date('Y').'" required>
                                <input type="hidden" name="option" value="1">
                                <input type="submit" name="submit1" value="View period entries" class="noprint">
                                <a href=""><i class="fas fa-print" onclick="javascript:window.print();"></i></a>
                                <a href="./export.php?period='.$period.'"><i class="far fa-file-excel"></i></i></a>                                    
                                <!--<input type="button" name="submit1" value="Print" onclick="javascript:window.print()" class="noprint">-->
                                </form>
                            </th>
                            </tr>';
                        ?>
                    </thead>
                    <tbody>
                        <?php            
                            require_once("selectCC.php");
                            selectAll($period);
                            //sqlsrv_free_stmt($getResults);
                        ?>
                    </tbody>
                </table>
                    </div>
        <div id="comparativa" class="divx" style="display:none">
            <table>
            <?php            
                    require_once("selectCC.php");
                    selectRccs($period);
                    sqlsrv_free_stmt($getResults);
                ?>
            </table>
                    </div>
    </div>
    </div>
</body>
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