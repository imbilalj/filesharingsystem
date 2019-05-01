<?php

  include("db-connect.php");

  // Function to return number of Users, Files
  function countData($column) {
    global $conn;
    $sql = "SELECT * FROM". " " . $column;
    $result = $conn->query($sql);
    if($result->num_rows > 0) {
      $totalno = $result->num_rows;
    } else {
      $totalno = 0;
    }
    return $totalno;
  }

  // Function to return the name and email of all users
  function getUserData() {
    global $conn;
    $sql = "SELECT user_id, firstname, lastname, email FROM users";
    $result = $conn->query($sql);
    return $result;
  }

  function getFileData() {
    global $conn;
    $sql = "SELECT filename, uploaddate, uploadedby FROM files";
    $result = $conn->query($sql);
    return $result;
  }

?>