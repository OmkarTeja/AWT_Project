<?php
	include 'connection.php';
	
	if(isset($_GET["email_id"])){
		$email_id=$_GET["email_id"];
		$query_string="select * from users where email_id='$email_id'";
	}
	else if(isset($_GET["id"])){
		$id=$_GET["id"];
		$query_string="select * from users where id=$id";
	}
	
	$result=mysqli_query($conn,$query_string);
	
	$row=mysqli_fetch_array($result);
	$user=array(
		"id" => $row["id"],
		"name" => $row["name"],
		"email_id" => $row["email_id"],
		"password" => $row["password"]
	);
	
	echo json_encode($user);
?>