<?php
	session_start();
	$_SESSION['user']="";
	header("location:index.php?view=login.php");
?>