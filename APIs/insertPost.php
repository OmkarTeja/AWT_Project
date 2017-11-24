<?php
	include 'connection.php';

	$userId=$_POST['userId'];
	$subject=$_POST['subject'];
	$description=$_POST['description'];
	
	$result=mysqli_query($conn,"INSERT INTO `posts`(`id`, `category`, `subject`, `description`, `user_id`) VALUES (Null,'Infrastructure','$subject',\"$description\",'$userId')");
	
	echo json_encode(array("result" => $result));
?>