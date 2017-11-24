<?php
	include 'connection.php';
	
	$username=$_POST['username'];
	$password=$_POST['password'];
		
	$result=mysqli_query($conn,"Select * from users where email_id='$username' and password='$password'");
	
	if(mysqli_num_rows($result)>0){
		$row=mysqli_fetch_array($result);
		if(!session_id()) session_start();
		$_SESSION["user"]=$row['id'];
		$result=true;
	}
	else{
		$result=false;
	}
	echo json_encode(array("result" => $result));
?>