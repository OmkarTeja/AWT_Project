<?php
	include 'connection.php';

	$name=$_POST['name'];
	$email=$_POST['email'];
	$password=$_POST['password'];
	
	$result=mysqli_query($conn,"INSERT INTO `users`(`id`, `name`, `email_id`, `password`) VALUES (Null,'$name','$email','$password')");
	
	echo json_encode(array("result" => $result));
?>