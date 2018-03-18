<?php
//Basic DB Functions-----------------------------------------------------------------
	function connectDB(){
		
		
		//parsing doesnt work. 

		$host = "localhost";
		$user = "root";
		$pass = "1234";
		$db = "easykey";
		
		$conn = new mysqli($host, $user, $pass, $db);
		// Check connection
		if ($conn->connect_error) {
			return FALSE;
		} 
		return $conn;
	}
	
	function disconnectDB($conn){
		$conn->close();
	}
	
	function queryDB($conn, $sql){
		$result = $conn->query($sql);
		//return table if its not empty
				return $result;
	}

	function executeDB($conn,$sql){
		if ($conn->query($sql) === TRUE)
			return TRUE;
		else
			echo  $conn->error;
	}
?>
