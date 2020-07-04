<?php
	ini_set("display_errors","OFF");
	$con=mysqli_connect("localhost","root","","shop");
	
	$id=$_REQUEST['p_id'];
	$sql="select * from product where p_id='".$id."'";
	$res=mysqli_query($con,$sql);
	$row=mysqli_fetch_array($res);
?>
<br><br><br>
<table align="center" width="60%">
	<tr>
		<td align="left" width="20%">
			<img src="images/<?=$row[5];?>">
		</td>
		<th align="left" width="20%">
			<?=$row[1];?><br>
			<?=$row[3];?><br>
			₹ <?=$row[4];?>
		</td>
	</tr>
	<tr>
		<td colspan=2>
			<br><br>
			<h3>Description:</h3><br><?=$row[2];?>
		</td>
	</tr>
	<tr>
		<td><br>
			<h4>Brand:</h4>
		</td>
		<td><br>
			<?php 
				$brand_id=$row[8];
				list($brand)=mysqli_fetch_array(mysqli_query($con,"select brand_name from brand where brand_id=".$brand_id)); 
				print $brand;
			?>
		</td>
	</tr>
</table>