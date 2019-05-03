<?php

session_start();

require_once("../db-connect.php");

if(isset($_POST)) {
	$firstname = mysqli_real_escape_string($conn, $_POST['firstname']);
	$lastname = mysqli_real_escape_string($conn, $_POST['lastname']);
	$email = mysqli_real_escape_string($conn, $_POST['email']);
  $password = mysqli_real_escape_string($conn, $_POST['password']);
  $cpassword = mysqli_real_escape_string($conn, $_POST['cpassword']);

  //Password with confirm password comparison
  if($password != $cpassword) {
    $_SESSION['passwordIncorrect'] = "Password Doesn't Match!";
    header('Location: create-user.php');
    exit();
  }
  //Validation of Email
  if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $_SESSION['invalidEmail'] = "Enter Valid Email Address!";
    header('Location: create-user.php');
    exit();
  }

	$password = base64_encode(strrev(md5($password)));

	$sql = "SELECT email FROM users WHERE email='$email'";
  
  $result = $conn->query($sql);

	if($result->num_rows == 0) {

		$sql = "INSERT INTO users(firstname, lastname, email, password) VALUES ('$firstname', '$lastname', '$email', '$password')";

		if($conn->query($sql)===TRUE) {
			$_SESSION['registerCompleted'] = true;
			header("Location: users.php");
			exit();
		} else {
			echo "Error " . $sql . "<br>" . $conn->error;
		}
	} else {
		$_SESSION['alreadyRegistered'] = "User Already Registered with this Email!";
		header("Location: create-user.php");
		exit();
	}

	$conn->close();

} else {
	header("Location: users.php");
	exit();
}