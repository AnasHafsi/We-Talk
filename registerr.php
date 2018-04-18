<?php
		/* Attempt MySQL server connection. Assuming you are running MySQL
		server with default setting (user 'root' with no password) */
		$link = mysqli_connect("localhost", "root", "", "chatdb");
		 
		// Check connection
		if($link === false){
		    die("ERROR: Could not connect. " . mysqli_connect_error());
		}
		 
		// Escape user inputs for security
		$Username = mysqli_real_escape_string($link, $_REQUEST['Username']);
		$Password = mysqli_real_escape_string($link, $_REQUEST['Password']);
		$Email = mysqli_real_escape_string($link, $_REQUEST['Email']);
		$PasswordMD5 = md5($Password);
		// attempt insert query execution

		$sql = "INSERT INTO users (Username, Password, PasswordMD5, Email) VALUES ('$Username', '$Password','$PasswordMD5', '$Email')";
		if(mysqli_query($link, $sql)){
		    echo "Successfully Registered.";
		    header("Location: index.html");
			die();
		} else{
		    echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
		}
		 
		// close connection
		mysqli_close($link);
?>