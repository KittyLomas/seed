<?php
require 'connectDatabase.php';

session_start();
	// When Sign Up is used
    if (isset($_POST["newname"]) && isset($_POST["newemail"]) && isset($_POST["newpass"]) && isset($_POST["newrepeatpass"])) {

    	$db = new MySQLDatabase();
    	$db->connect();
    	$newname = $_POST["newname"];
    	$newemail = $_POST["newemail"];
    	$newpword = $_POST["newpass"];
		$newrpword = $_POST["newrepeatpass"];
		$log = $_POST["log"];
		$bytes = 10;
		// Creating a random password salt
		$salt = random_bytes($bytes);

		// Hashing password with salt
		$newpword = md5($newpword.$salt);
		// Creating query
		$query = "SELECT * FROM USER WHERE Email='$newemail'";
		// Sending query
		$result = $db->query($query);
		// Catch if the email already exists within the database
    	if ($row = mysqli_fetch_array($result)) {
    		if ($newemail == $row['Email']) {
				echo "<script>alert('User already exists!');</script>";
				echo "<script>window.location='../signup.html';</script>";    			
    		}
    	} else {
			// Email doesn't exist in database yet
			// Creating query to insert new user details
    		$sql = "INSERT INTO USER (Email, Password, Name, Password_Salt) VALUES ('$newemail', '$newpword', '$newname', '$salt')";
			// Sending query
			$insert = $db->query($sql);
			// Creating query that initialises the first 'deposit' of user
			$sql2 = "INSERT INTO DEPOSIT (Email, Log, Amount) VALUES ('$newemail', '$log', 0)";
			// Sending query
			$insert2 = $db->query($sql2);
			// Saves this user's details as session variables
    		$_SESSION["email"] = $_POST["newemail"];
    		$_SESSION["pass"] = $_POST["newpass"];
			$_SESSION["name"] = $_POST["newname"];
			echo "<script>window.location='../goals.html';</script>";
    	}
    	$db->disconnect(); 
    }

	// When Sign In is used
	if (isset($_POST["email"]) && isset($_POST["pass"])) {
    	$db = new MySQLDatabase();
    	$db->connect();
    	$email = $_POST["email"];
		$pass = $_POST["pass"];
		// Creating query
		$query = "SELECT * FROM USER WHERE Email = '$email'";
		// Sending query
		$result = $db->query($query);
		
		// If the email has been registered and the password matches
    	if ($row = mysqli_fetch_array($result)) {
    		if (md5($pass.$row['Password_Salt']) == $row['Password']) {
				// Set session variables
				$_SESSION["email"] = $_POST["email"];
				$_SESSION["name"] = $_POST["name"];
				$_SESSION["pass"] = $_POST["pass"];
				header("Location: ../profile.php");   			
    		} else {
				echo "<script>alert('Incorrect Password');</script>";
				echo "<script>window.location='../signin.html';</script>";
			}
    	} else {
			// The login credentials isn't in the database
			echo "<script>alert('Email hasn't been registered!');</script>";
			echo "<script>window.location='../signin.html';</script>";
		}
    	$db->disconnect(); 
	}
	
	// If the logout button was pressed
	if (isset($_GET["logout"])) {
		session_destroy();
        header("Location: ../signin.html");
    }
?>
