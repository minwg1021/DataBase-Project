<?php
  session_start();

  $servername = "localhost:3306";
  $username = "root";
  $password = "1121";
  $dbname = "testdb";

  // Create connection
  $conn = new mysqli($servername, $username, $password, $dbname);

  // Check connection
  if($conn->connect_error){
    die("Connection failed: " + $conn->connect_error);
  }
?>
