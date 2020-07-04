<?php 
	ini_set("display_errors","OFF");
	$con=mysqli_connect("localhost","root","","shop");
	
	$count=0;
	
	$catsql="select * from category";
	$catres=mysqli_query($con,$catsql);
	
?>
<br><br><br>
<table >
	<tr>
	<?php while($catrow=mysqli_fetch_array($catres)) { ?>
		
			<td>
				<a href="index.php?view=product.php&cat_id=<?=$catrow[0];?>"><img src="images/<?=$catrow[3];?>" style="border:1px solid black"width="250px" height="200px"></a>
			</td>
			<td width="30%">
				<a href="index.php?view=product.php&cat_id=<?=$catrow[0];?>"><?=$catrow[1];?> </a><br><br>
				<?=$catrow[2];?>
			</td>
			<?php $count++; 
				if(($count%2) == 0) { ?>
					<tr>
			<?php } ?>
	<?php } ?>
	</tr>
</table>