<?php 
	session_start();
	require_once "db.php";

	// variable declaration
	$email    = "";
	$password = "";
	$gender = "";
	$errors = array(); 
	$_SESSION['success'] = "";

	

	// REGISTER USER
	if (isset($_POST['reg_user'])) {
		// receive all input values from the form
		$fName = mysqli_real_escape_string($conn, $_POST['txtFN']);
		$lName = mysqli_real_escape_string($conn, $_POST['txtLN']);
		$email = mysqli_real_escape_string($conn, $_POST['email']);
		$phoneNumber = mysqli_real_escape_string($conn, $_POST['txtPN']);
		$zip = mysqli_real_escape_string($conn, $_POST['txtZip']);
		$password_1 = mysqli_real_escape_string($conn, $_POST['password_1']);
		$terms = mysqli_real_escape_string($conn, $_POST['terms']);

		if ($terms == "no") {
			header('location: register.php?msg=termsError');
			exit();
		}
		

		// register user if there are no errors in the form
			$password = md5($password_1);//encrypt the password before saving in the database
			$currentDate = date("Y/m/d");
			$query = "INSERT INTO users (firstname, lastname, email, phonenumber, zip, password, creationdate) 
					  VALUES('".$fName."', '".$lName."', '".$email."', '".$phoneNumber."', '".$zip."', '".$password."', '".$currentDate."')";
			mysqli_query($conn, $query);
			header('location: login.php?msg=registrationSuccess');

	}

	// ... 

	// LOGIN USER
	if (isset($_POST['login_user'])) {
		$email = mysqli_real_escape_string($conn, $_POST['txtEmail']);
		$password = mysqli_real_escape_string($conn, $_POST['txtPassword']);
		
			$password = md5($password);
			$query = "SELECT * FROM users WHERE email='".$email."' AND password='".$password."'";
			$results = mysqli_query($conn, $query);
			if (mysqli_num_rows($results) == 1) {
				$rows=mysqli_fetch_assoc($results);
				print_r($rows);
				$_SESSION['id'] = $rows['id'];
				header('location: home.php');

			}else {
				header('location: login.php?msg=credentials');
				exit();
				
			}
	}

?>