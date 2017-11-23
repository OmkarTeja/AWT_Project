<?php
	session_start();
	$_SESSION["postId"]=$_GET["id"];
	echo json_encode(array("result" => true));
?>