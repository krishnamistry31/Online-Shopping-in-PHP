<head>
	<style>
	.table{
				background-color: rgba(240, 240, 240, 0.8);
				border-radius: 5px 5px;
				padding: 50px 5px;
	}
	.th{
			font-family:"Arial Black", Gadget, sans-serif;
			font-size:25px;
			color:#000066;
		    font-style: italic;
			border-bottom: 3px solid #000066;			
	}
	.tr{
			font-size:20px;
			border-bottom: 3px solid #000066;
	}
	input[type=text] {
			padding: 5px 5px;
			width:30%;
			font-size:15px;
			box-sizing: border-box;
			border: 2px solid #ccc;
			border-radius:4px;
			background-color: #f8f8f8;
			color:#000066 ;
		}
	.button {
			background-color: rgba(100,100,255,0.5);
			border: none;
			color: rgb(255,255,255);
			padding: 10px 30px;
			text-align: center;
			text-decoration: none;
			display: inline-block;
			font-size: 15px;
			margin: 4px 2px;
			cursor: pointer;
	}
	</style>
</head>	
<?php
	ini_set("display_errors","OFF");
	$con=mysqli_connect("localhost","root","","shop");
	if(isset($_REQUEST['search']))
	{
		$name=$_REQUEST['item'];
		if(empty($name))
			header("location:index.php?view=listproduct.php");
		$sql = "select * from product where p_name like '$name%' or p_fdesc like '$name%' or p_sdesc like '$name%'";
		$res=mysqli_query($con,$sql);
	}
	else
	{
		$sql = "select * from product";
		$res=mysqli_query($con,$sql);
	}
	
	if(isset($_REQUEST['Delete']))
	{
		$del = $_REQUEST['del'];
		
		$d = implode(",",$del);
		
		$delsql = "delete from product where p_id in (".$d.") ";
		mysqli_query($con,$delsql);
		 	
		?>
					<script>
					window.location.href ="http://localhost/onlineshop/admin/index.php?view=listproduct.php";
					</script>
	<?php

	}
	
	if(isset($_REQUEST['all']))
	{
		header("location:index.php?view=listcategory.php");
	}
?>
<!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

<!-- Latest compiled JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script>
$(document).ready(function () {
	
    $("#ckbCheckAll").click(function () {
        $(".checkBoxClass").prop('checked', $(this).prop('checked'));
    });
});
</script>

<form method="post" action="index.php?view=listproduct.php">
<input type="text" name="item" value="<?=$_REQUEST['item'];?>"><input type="submit" name="search" value="Search" class="button">
<table width="90%" align="center" class="table">
	<th colspan=12 class="th">LIST OF PRODUCTS </th>
	<tr>
		<td class="tr">ID</td>
		<td class="tr">Name</td>
		<td class="tr">Full Description</td>
		<td class="tr">Short Description</td>
		<td class="tr">Price</td>
		<td class="tr">Photo</td>
		<td class="tr">Category</td>
		<td class="tr">Subcategory</td>
		<td class="tr">Brand</td>
		<td class="tr">Export to</td>
		<td class="tr">Edit</td>
		<td class="tr">Delete</td>
	</tr>
	<tr>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td>	
			 <input type="checkbox" id="ckbCheckAll" name="all" value="SelectAll"/>	SelectAll
		</td>
	</tr>

	<?php while($row=mysqli_fetch_array($res)) { ?>
	<tr>
		<td><?=$row[0];?></td>
		<td><?=$row[1];?></td>
		<td><?=$row[2];?></td>
		<td><?=$row[3];?></td>
		<td><?=$row[4];?></td>
		<td><img src="images/<?=$row[5];?>" height="70" width="90"  /></td>
		<td>
			<?php 
				$cat_id=$row[6];
				list($cat)=mysqli_fetch_array(mysqli_query($con,"select cat_name from category where cat_id=".$cat_id)); 
				print $cat;
			?>
		</td>
		<td>
			<?php 
				$subcat_id=$row[7];
				list($subcat)=mysqli_fetch_array(mysqli_query($con,"select subcat_name from subcategory where subcat_id=".$subcat_id)); 
				print $subcat;
			?>
		</td>
		<td>
			<?php 
				$brand_id=$row[8];
				list($brand)=mysqli_fetch_array(mysqli_query($con,"select brand_name from brand where brand_id=".$brand_id)); 
				print $brand;
			?>
		</td>
		<td><?=$row[9];?></td>
		<td><a style="width:40%" href="index.php?view=addproduct.php&p_id=<?=$row[0];?>">Edit</a></td>
		<td>
			<?php if(isset($_REQUEST['all'])) { ?>
			<input type="checkbox" name="del[]" class="checkBoxClass" id="Checkbox1" value="<?=$row[0];?>" checked>
			
				<?php } else { ?>
			<input type="checkbox" name="del[]" class="checkBoxClass" id="Checkbox1" value="<?=$row[0];?>">
			<?php } ?>
		</td>
	</tr>
	<?php } ?>
	<tr>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td>	
			<input type="submit" name="Delete" value="Delete" class="button"/> 
		</td>
	</tr>
</table>	
</form>