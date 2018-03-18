<?php
	$response = array();
	$dbc = mysqli_connect("localhost","root","1234","easykey");
    $email = $_POST['email'];
	$result = mysqli_query($dbc,"select * from log") or die(mysql_error());
	
	if(mysqli_num_rows($result) > 0){
		$response["values"] = array();
		
		while($row = mysqli_fetch_array($result)){
			$val = array();
			
			$val["website"] = $row["website"];
			
			array_push($response["values"],$val);
		}
		
		$response["success"] = 1;
		
		echo json_encode($response);
	}
	else{
		$response["success"] = 0;
		$response["message"] = "No values found.";
		
		echo json_encode($response);
	}
?>
