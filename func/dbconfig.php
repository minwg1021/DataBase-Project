<?php
  session_start();

  $servername = "localhost:3306";
  $username = "root";
  $password = "Woong5372!@";
  $dbname = "CBMP";

  // Create connection
  $conn = new mysqli($servername, $username, $password, $dbname);

  // Check connection
  if($conn->connect_error){
    die("Connection failed: " + $conn->connect_error);
  }
?>

