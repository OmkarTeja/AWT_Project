<?php
	session_start();
	if(isset($_SESSION["user"]))
		echo json_encode(array("result" => $_SESSION["user"]));
	else
		echo json_encode(array("result" => "null"));
?>