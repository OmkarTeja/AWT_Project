<?php
	session_start();
	if(isset($_SESSION["postId"]))
		echo json_encode(array("postId" => $_SESSION["postId"]));
	else
		echo json_encode(array("postId" => "null"));
?>