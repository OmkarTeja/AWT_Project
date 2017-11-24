<?php
	include 'connection.php';

	$user_id=$_POST['userId'];
	$post_id=$_POST['postId'];
	$description=$_POST['description'];
	
	$result=mysqli_query($conn,"INSERT INTO `answers`(`id`, `post_id`, `user_id`, `description`, `upvotes`, `downvotes`, `appropriate`) VALUES(Null,'$post_id','$user_id',\"$description\",0,0,0)");
	
	echo json_encode(array("result" => $result));
?>