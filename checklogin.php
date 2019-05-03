<?php
session_start();

require_once("db-connect.php");

if(isset($_POST)) {

	$email = mysqli_real_escape_string($conn, $_POST['email']);
	$password = mysqli_real_escape_string($conn, $_POST['password']);

	$password = base64_encode(strrev(md5($password)));

	$sql = "SELECT user_id, firstname, lastname, email FROM users WHERE email='$email' AND password='$password'";
	$result = $conn->query($sql);

	if($result->num_rows > 0) {
		while($row = $result->fetch_assoc()) {
			$name = $row["firstname"] . " " . $row["lastname"];
      $user_id = $row["user_id"];
      $email = $row["email"];
		}
		$_SESSION['user_id'] = $user_id;
    $_SESSION['name'] = $name;
    $_SESSION['email'] = $email;
		
		header("Location: archive.php");
 	} else {
 		$_SESSION['loginError'] = 'Incorrect Email/Password';
 		header("Location: index.php");
		exit();
 	}

 	$conn->close();

} else {
	header("Location: index.php");
	exit();
}