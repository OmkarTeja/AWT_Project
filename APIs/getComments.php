<?php
	include 'connection.php';
	
	$post_id=$_GET["post_id"];
	$answer_id=$_GET["answer_id"];
	$result=mysqli_query($conn,"select * from comments where post_id=$post_id and answer_id=$answer_id");
	
	$comments_array[]=null;
	while($row=mysqli_fetch_array($result)){
		$comments_array[]=array(
			"id" => $row["id"],
			"post_id" => $row["post_id"],
			"answer_id" => $row["answer_id"],
			"description" => $row["description"],
			"user_id" => $row["user_id"]
		);
	}
	
	echo json_encode($comments_array);
?>