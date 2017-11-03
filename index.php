<?php
  $hostname = "sql.njit.edu";
  $username = "kn272";
  $password = "KYhRX7n1z";
  $conn = NULL;

  try {
     $conn = new PDO("mysql:host=$hostname;dbname=kn272",$username,$password);
     echo "Connected successfully<br>";
     $select = 'SELECT * FROM accounts WHERE `id` < 6';
     $rows = execQuery($select);
     echo count($rows) . ' records have id < 6<br>';
     $header = 'SHOW COLUMNS FROM accounts';
     $heading = execQuery($header);
     echo table($heading,$rows);     
  }
  catch(PDOException $e) {
     http_error("500 Internal Server Error\n\n" . "There was a SQL error:\n\n" . $e->getMessage() . "<br>");
  }

  function execQuery($query){
     global $conn;
     try {
	$sql = $conn->prepare($query);
        $sql->execute();
	$results = $sql->fetchAll(PDO::FETCH_ASSOC);
	$sql->closeCursor();
	return $results;
     }
     catch(PDOException $e) {
        http_error("500 Internal Server Error\n\n" . "There was a SQL error:\n\n" . $e->getMessage() . "<br>");
     }
  }

  function table($heading,$rows) {
     //print_r($heading);
     //echo '<br>';
     $table = NULL;
     $table .= "<table border = 1>";
     /*foreach ($heading as $row) {
        $table .= "<th>";
	foreach ($row as $column) {
           $table .= "<td>$column[Field]</td>";
	}
	$table .= "</th>";

     }*/ 
     foreach ($rows as $row) {
        $table .= "<tr>";
        foreach ($row as $column) {
           $table .= "<td>$column</td>";
        }
        $table .= "</tr>";
     }
     $table .= "</table>";
     return $table;
  }

?>
