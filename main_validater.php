<?php
	$failpath = "localhost/test/Project%20Test/home.php";
	if($_SESSION["username"] == '' || $_SESSION["password"] == '')	{
		header("Location: ".$failpath);
	} else	{
		$username = substr($_SERVER['REQUEST_URI'], pos+3);
		$password = substr($_SERVER['REQUEST_URI'], pos2+3);
		
		$servername = "whateveritis";
		$rootusername = "whateveritisNAME";
		$rootpassword = "whateveritisPASS";
		$dbname = "ourdb";
		
		$conn = new mysqli($servername, $rootusername, $rootpassword, $dbname);
		
		if ($conn->connect_error)	{
			die("Connection failed: " . $conn->connect_error);
		}
		 
		$sql = 
		"SELECT cusername, password from Customer
		WHERE (Customer.cusername='c".$_SESSION["username"]."' && Customer.password='".$_SESSION["password"]."')
		UNION SELECT musername, password from Management
		WHERE (Management.musername='m".$_SESSION["username"]."' && Management.password='".$_SESSION["password"]."')";
		$result = $conn->query($sql);
		
		if($result->num_rows <= 0)	{
			header("Location: ".$failpath);
		}
	}
?>