<?php
	include 'connection.php';
	
	if(isset($_GET["post_id"])){
		$id=$_GET["post_id"];
		$query_string="select * from posts where id=$id";
	}
	else{
		$query_string="select * from posts";
	}
	
	$result=mysqli_query($conn,$query_string);
	
	while($row=mysqli_fetch_array($result)){
		$posts_array[]=array(
			"id" => $row["id"],
			"category" => $row["category"],
			"subject" => $row["subject"],
			"description" => $row["description"],
			"user_id" => $row["user_id"]
		);
	}
	$posts=array("posts" => $posts_array);
	echo json_encode($posts);
?>