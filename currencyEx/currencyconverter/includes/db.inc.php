<?php 
	$link = mysqli_connect("localhost", "root", "");
	if(!$link)
	{
		$error = "Unable to connect to database";
		include 'error.html.php';
		exit();
	}
	if(!mysqli_set_charset($link, "utf8"))
	{
		$error = "Unable to set database encoding";
		include 'error.html.php';
		exit();
	}
	if(!mysqli_select_db($link, "converterdb"))
	{
		$error = "Unable to select database";
		include 'error.html.php';
		exit();
	}
?>