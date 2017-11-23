<?php
	include 'connection.php';
	
	$post_id=$_GET["post_id"];
	$result=mysqli_query($conn,"select * from answers where post_id=$post_id order by upvotes desc");
	
	while($row=mysqli_fetch_array($result)){
		$answers_array[]=array(
			"id" => $row["id"],
			"category" => $row["post_id"],
			"description" => $row["description"],
			"user_id" => $row["user_id"],
			"upvotes" => $row["upvotes"],
			"downvotes" => $row["downvotes"],
			"appropriate" => $row["appropriate"]
		);
	}
	
	$return=array("answers" => $answers_array);
	
	echo json_encode($return);
?>