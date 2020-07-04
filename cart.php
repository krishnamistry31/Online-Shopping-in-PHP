<?php
	ini_set("display_errors","ON");
	$con=mysqli_connect("localhost","root","","shop");
	
	$id=$_REQUEST['p_id'];
	$sql="select * from product where p_id='".$id."'";
	$res=mysqli_query($con,$sql);
	$row=mysqli_fetch_array($res);
?>
<img src="/admin/images/<?=$row[5];?>">