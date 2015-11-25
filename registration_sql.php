<?php
	$username = isset($_POST['exampleUsername1']) ? $_POST['exampleUsername1'] : '';
	$password = isset($_POST['examplePassword1']) ? $_POST['examplePassword1'] : '';
	$password2 = isset($_POST['examplePassword2']) ? $_POST['examplePassword2'] : '';
	$email = isset(($_POST['exampleEmail']) ? $_POST['exampleEmail'] : '';
	if($username != '' && $password != '' && $password2 == $password && $email != '')	{
		$servername = "whateveritis";
		$rootusername = "whateveritisNAME";
		$rootpassword = "whateveritisPASS";
		$dbname = "ourdb";
		$successpath = "localhost/test/Project%20Test/home.php"
		
		$conn = new mysqli($servername, $rootusername, $rootpassword, $dbname);
		
		if ($conn->connect_error)	{
			die("Connection failed: " . $conn->connect_error);
		}
		 
		$sql = 
		"SELECT cusername, password from Customer
		WHERE (Customer.cusername='c".$username." || Customer.email=".$email.")
		UNION SELECT musername, password from Management
		WHERE (Management.musername='m".$username.")";
		$result = $conn->query($sql);
		
		if($result->num_rows > 0)	{
			echo ("Failure! The username or email is already taken.");
		} else	{
			$sql2 = 
			"INSERT INTO Customer ('cusername','password','email') VALUES ('".$username."', '".$password."', '".$email."')";
			$conn->query($sql2);
			$_SESSION["username"] = $username;
			$_SESSION["password"] = $password;
			header("Location: ".$successpath);
		}
	} else if ($password2 == $password)	{
		echo("Two given passwords are different")
	}
?>