<?php
  $hostName = 'localhost'; // Host name
  $user = 'root'; //Database User
  $password = ''; //Database Password
  $dbName = 'filecms'; // Database Name
  
  $conn = new mysqli($hostName, $user, $password, $dbName); //Establishing connection to Database
  
  if ($conn->connect_error) {
    die("Connection Failed: ". $conn->connect_error);
  }
?>