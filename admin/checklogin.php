<?php
session_start();

require_once("../db-connect.php");

if(isset($_POST)) {

	$email = mysqli_real_escape_string($conn, $_POST['email']);
	$password = mysqli_real_escape_string($conn, $_POST['password']);

	$password = base64_encode(strrev(md5($password)));

	$sql = "SELECT admin_id, firstname, lastname, email FROM admin WHERE email='$email' AND password='$password'";
	$result = $conn->query($sql);

	if($result->num_rows > 0) {
		while($row = $result->fetch_assoc()) {
			$name = $row["firstname"] . " " . $row["lastname"];
      $admin_id = $row["admin_id"];
      $email = $row["email"];
		}
		$_SESSION['admin_id'] = $admin_id;
    $_SESSION['name'] = $name;
    $_SESSION['email'] = $email;
		
		header("Location: index.php");
 	} else {
 		$_SESSION['loginError'] = 'Incorrect Email/Password';
 		header("Location: login.php");
		exit();
 	}

 	$conn->close();

} else {
	header("Location: login.php");
	exit();
}