<?php
  $hostname = "sql.njit.edu";
  $username = "kn272";
  $password = "KYhRX7n1z";
  $conn = NULL;

  try{
     $conn = new PDO("mysql:host=$hostname;dbname=kn272",$username,$password);
     echo "Connected successfully<br>";
  }
  catch(PDOException $e) {
     http_error("500 Internal Server Error\n\n" . "There was a SQL error:\n\n" . $e->getMessage() . "<br>");
  }
?>
