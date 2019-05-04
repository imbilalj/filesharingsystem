<?php

  include("db-connect.php");

  // Function to return number of Users, Files
  function countData($table) {
    global $conn;
    $sql = "SELECT * FROM". " " . $table;
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
    $sql = "SELECT * FROM files";
    $result = $conn->query($sql);
    return $result;
  }

  //Returns full name by ID
  function getUserNameById($id) {
    global $conn;
    $name = "";
    $sql = "SELECT firstname, lastname FROM users WHERE user_id=" . $id;
    $result = $conn->query($sql);
    if($result->num_rows > 0) {
      while($row = $result->fetch_assoc()) {
        $name = $row["firstname"] . " " . $row["lastname"];
      }
    }
    return $name;
  }

?>