<?php
require('SimpleXLSXGen.php');
    // Filter the excel data 
    function filterData(&$str){ 
        if (!$str instanceof DateTime) {
            //echo "<td class='hd-table'>".($row[$j] == '' ? '0' : $row[$j]) ."</td>";
            $str = preg_replace("/\t/", "\\t", $str); 
            $str = preg_replace("/\r?\n/", "\\n", $str); 
            if(strstr($str, '"')) $str = '"' . str_replace('"', '""', $str) . '"'; 
        }
    } 
    
    // Excel file name for download 
    $fileName = "testing_" . date('Y-m-d') . ".xlsx"; 
    
    // Column names 

    /* 
    
    SELECT TOP (1000) [id]
      ,[Fecha]
      ,[Modelo]
      ,[Tecnico]
      ,[Created]
      ,[CreatedBy]
      ,[Modified]
      ,[ModifiedBy]
  FROM [WebReports].[dbo].[Sleep_TCPCO]
    */
    $fields = array('ID', 'Fecha', 'Modelo', 'Tecnico', 'Created', 'CreatedBy', 'Modified', 'ModifiedBy'); 
    
    // Display column names as first row 
    $excelData = implode("\t", array_values($fields)) . "\n"; 
    require_once('cno.php');
    $db = new ServidorBD();
    $conn = $db->Conectar('x');

        // Fetch records from database 
    $sql = "SELECT [id],[Fecha],[Modelo],[Tecnico],[Created],[CreatedBy],[Modified],[ModifiedBy] FROM [Sleep_TCPCO]";
    
    $stmt = sqlsrv_query($conn, $sql);
    if(sqlsrv_has_rows( $stmt ) > 0){ 
        // Output each row of the data 
        while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_BOTH)){
        // while($row = $query->fetch_assoc()){ 
            //$status = ($row['status'] == 1)?'Active':'Inactive'; 
            $lineData[] = array($row['id'], $row['Fecha'], $row['Modelo'], $row['Tecnico'], $row['Created'], $row['CreatedBy'], $row['Modified'], $row['ModifiedBy']); 
            //array_walk($lineData, 'filterData'); 
            //$excelData .= implode("\t", array_values($lineData)) . "\n"; 
        } 
    }else{ 
        $excelData .= 'No records found...'. "\n"; 
    } 
    echo "<pre>";
    var_dump($lineData);
    // Headers for download 
    // header("Content-Type: application/vnd.ms-excel"); 
    // header("Content-Disposition: attachment; filename=\"$fileName\""); 
    
    // Render excel data 
    // echo $excelData; 
    
    // exit;


// $books = [
//     ['ISBN', 'title', 'author', 'publisher', 'ctry' ],
//     [618260307, 'The Hobbit', 'J. R. R. Tolkien', 'Houghton Mifflin', 'USA'],
//     [908606664, 'Slinky Malinki', 'Lynley Dodd', 'Mallinson Rendel', 'NZ']
// ];
$xlsx = Shuchkin\SimpleXLSXGen::fromArray( $lineData );
$xlsx->downloadAs('books.xlsx');



// use SimpleXLSXGen;
// SimpleXLSXGen::fromArray( $books )->downloadAs('table.xlsx');

// // Fluid interface, multiple sheets
// SimpleXLSXGen::fromArray( $books )->addSheet( $books2 )->download();

// // Alternative interface, sheet name, get xlsx content
// $xlsx_cache = (string) (new Shuchkin\SimpleXLSXGen)->addSheet( $books, 'Modern style');

// // Classic interface
// $xlsx = new SimpleXLSXGen();
// $xlsx->addSheet( $books, 'Catalog 2021' );
// $xlsx->addSheet( $books2, 'Stephen King catalog');
// $xlsx->downloadAs('books_2021.xlsx');
// exit();
    ?>