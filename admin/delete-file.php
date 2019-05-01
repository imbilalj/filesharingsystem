<?php

session_start();

if(empty($_SESSION['admin_id'])) {
	header("Location: login.php");
	exit();
}

require_once("../db-connect.php");

if(isset($_GET)) {
  //Script to be written to delete the file from the directory too
	$sql = "DELETE FROM files WHERE file_id = '$_GET[id]'";
	if($conn->query($sql)) {
		header("Location: files.php");
		exit();
	} else {
		echo "Error";
	}
}