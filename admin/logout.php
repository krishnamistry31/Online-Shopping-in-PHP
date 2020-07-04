<?php
	session_start();
	$_SESSION['admuser']="";
	header("location:login.php");
?>