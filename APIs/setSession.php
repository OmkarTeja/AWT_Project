<?php
	session_start();
	$_SESSION["user"]=$_GET["user"];
	echo json_encode(array("result" => "Session successfully set"));
?>