<?php
	include 'connection.php';
	
	$username=$_POST['username'];
	$password=$_POST['password'];
	
	$result=mysqli_query($conn,"Select * from users where email_id='$username' and password='$password'");
	
	if(mysqli_num_rows($result)>0){
		if(!session_id()) session_start();
		$_SESSION["user"]=$username;
		$result=true;
	}
	else{
		$result=false;
	}
	echo json_encode(array("result" => $result));
?>