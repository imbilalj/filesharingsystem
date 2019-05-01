<?php

session_start();

if(empty($_SESSION['admin_id'])) {
	header("Location: login.php");
	exit();
}

require_once("../db-connect.php");

if(isset($_GET)) {
	$sql = "DELETE FROM users WHERE user_id = '$_GET[id]'";
	if($conn->query($sql)) {
		header("Location: users.php");
		exit();
	} else {
		echo "Error";
	}
}