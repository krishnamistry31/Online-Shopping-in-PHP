<?php 
	ini_set("display_errors","OFF");
	$con=mysqli_connect("localhost","root","","shop");
	
	if($_REQUEST['cat_id'])
	{
		$id=$_REQUEST['cat_id'];
		$prosql="select * from product where cat_id='" .$id . "'";
	}
	else
	{
		$prosql="select * from product";
	}
	$prores=mysqli_query($con,$prosql);
	
?>
<br><br><br>
<table align="left" width="50%">
	<?php while($prorow=mysqli_fetch_array($prores)) { ?>
		<tr>
			<td>
				<center><a href="index.php?view=viewproduct.php&p_id=<?=$prorow[0];?>"><img src="images/<?=$prorow[5];?>" width="200px"></a><br> ₹ <?=$prorow[4];?></center>
			</td>
			<td><a href="index.php?view=viewproduct.php&p_id=<?=$prorow[0];?>">
				<?=$prorow[1];?></a><br><br>
				<?=$prorow[3];?>
			</td>
		</tr>
	<?php } ?>
</table>
