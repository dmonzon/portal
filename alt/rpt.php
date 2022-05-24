<!DOCTYPE html>        
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<!-- <link rel="stylesheet" type="text/css" href="w.css"> -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<link href="jquery-ui.css" rel="stylesheet">
<script src="https://kit.fontawesome.com/f95af9be80.js" crossorigin="anonymous"></script>
<script src="sleeplogs.js"></script>
<script src="idle.js"></script>
<script>
    $(document).on('click','.btn',function() {
        num = this.id;
        $.ajax({
        type:'GET',
        url: "info.php",
        dataType: "json",
        data: {num:num},
            success: function(dataResult){
                var dataResult = JSON.parse(dataResult);
                if(dataResult.statusCode=='ok'){
                    //$('#editEmployeeModal').modal('hide');
                    // alert('Data updated successfully !'); 
                    //location.reload();						
                }
                else if(dataResult.statusCode=='error'){
                    alert(dataResult);
                }
            }
        });
    });

    function sortTable(tabla,columnName){
        var sort = $("#sort").val();
        $.ajax({
        url:'info_details.php',
        type:'post',
        data:{tabla:tabla,columnName:columnName,sort:sort},
        success: function(response){

        $("#empTable tr:not(:first)").remove();

        $("#empTable").append(response);
        if(sort == "asc"){
            $("#sort").val("desc");
        }else{
            $("#sort").val("asc");
        }

        }
        });
    }
</script>
<style type = "text/css">
    a:link {
	    color: red;
	}
	
	/* visited link */
	a:visited {
	    color: red;
	}
	
	/* mouse over link */
	a:hover {
	    color:darkred;
	}
	
	/* selected link */
	a:active {
	    color: chocolate;
    }
    @media screen,print{
        .tab {
            tab-size: 4;
            background:#FEE5E5;
            border:none;
        }
        table {
            border-collapse: collapse;
            width: 95%;
            margin-left: auto;
            margin-right: auto;
        }
        span:hover{
            cursor:pointer;
            color:red;
        }
        th, td {
            text-align: left;
            padding: 5px;
        }        
        tr:nth-child(odd) {background-color: #FEE5E5 !important;}
    }
    @media print
        {
        .noprint {display: none !important;}
        }
    }
</style>
</head>
<body>
<?php
require_once('cno.php');

$db = new ServidorBD();
$conn = $db->Conectar('x');
if($_GET){
    // echo "<pre>GET";
    // var_dump($_GET);
    $tabla = $_GET['tb'];
    if($_GET['tb'] === 'fnd')
    {

    }else{
        $tsql = "SELECT * FROM $tabla" ;
    ?>
        <div style="text-align:center;width=95%;">
            <img src="imgs/ham-logo.png"></br></br>
            <?php echo '<span style="color:red;font-style:oblique;font-size: 30px;font-stretch: expanded;font-weight: bold;">'.getRepTittle($tabla).'</span>';?></br></br>
            <button class="noprint" style="border:none;color:red;background:none;" alt="Back" onclick="javascript:history.back();"><i class="fa-solid fa-arrow-left-long fa-lg"></i></button>
            <button class="noprint" style="border:none;color:red;background:none;" alt="Print" onclick="javascript:window.print();"><i class="fa-solid fa-print fa-lg"></i></button>
            <a href="sleepfnd.php?tb=<?php echo $tabla ?>" target="_self"><i class="fa-solid fa-magnifying-glass fa-lg"></i></a>
        </div>
        <div style="width=95%;">
        </br>
        <input type='hidden' id='sort' value='asc'>
        <table width='90%' id='empTable'>
        <?php 
        $getResults = sqlsrv_query($conn, $tsql);
        $i =0;
        echo '<tr>'; //#FFF7F9
        if($getResults){
            $res = sqlsrv_has_rows( $getResults );
            if($res > 0){
                foreach(sqlsrv_field_metadata($getResults) as $field){
                    $titulo = str_replace("_"," ",$field['Name']);
                    echo '<th><span onclick=\'sortTable("'.$tabla.'","'.$field['Name'].'");\'>'.$titulo.'</span></th>';
                    $i++;
                }
                echo '</tr>';
                echo "<tr>";
                $x =0;
                // var_dump(sqlsrv_num_rows($getResults));
                while ($row = sqlsrv_fetch_array($getResults, SQLSRV_FETCH_BOTH)){
                    for ($j = 0; $j < $i; $j++) {
                        //if($j==0) {'<td><button></button></td>'}
                        if ($row[$j] instanceof DateTime) {
                            echo "<td>".str_replace( ' 00:00:00','',$row[$j]->format('m/d/Y H:i:s'))."</td>";
                        }else{
                            echo "<td>".$row[$j]."</td>";
                        }
                    }
                    $x++;
                    echo '</tr>';
                }
            }
            // echo '<tr><td style="color:red;"><h2>No se generaron resultados</h2><td/></tr>';
        }else{
            echo '<td style="color:#000;" colspan="100"><b>No se generon resultados.</b></br></td></tr>';
        }
    }
}
if($_POST){
    // echo '<pre>';
    // var_dump($_POST);
    // $tb = @$_POST['tb'];
    extract($_POST);
    if($tb ==='s'){
        echo 'zumba yandellll';
    }else{
        SleepQrys($_POST);
    }
}

    ?>
  </table>
</div>
</body>