<head>
	<style>
		.table{
				background-color: rgba(240, 240, 240, 0.8);
				border: 2px solid black;
				border-radius: 5px 50px;
				padding:50px 5px;
			}
		.th{
			font-family:"Arial Black", Gadget, sans-serif;
			font-size:25px;
			color:#000066;
		    font-style: italic;
		}
		.left{
			text-align:left;
		}
		.color{
			color:red;
		}
		input[type=text],input[type=file] {
			padding: 5px 5px;
			width:80%;
			font-size:15px;
			box-sizing: border-box;
			border: 2px solid #ccc;
			border-radius:4px;
			background-color: #f8f8f8;
			color:#000066 ;
		}
		textarea {
			width: 80%;
			height: 80px;
			padding: 12px 20px;
			box-sizing: border-box;
			border: 2px solid #ccc;
			border-radius: 4px;
			background-color: #f8f8f8;
			font-size: 16px;
			resize: none;
		}
		select {
			width: 80%;
			padding: 16px 20px;
			border: none;
			border-radius: 4px;
			background-color: #f8f8f8;
			color:#000066 ;
		}
		.button {
			background-color: #000080;
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
	
	if(isset($_REQUEST['save']))
	{
		$subcat_name=$_REQUEST['subcat_name'];
		$cat_id=$_REQUEST['category'];
		if(empty($subcat_name))
			print "<p class='color'>Name is required</p>";
		else
		{
			$check="select * from subcategory where subcat_name='$subcat_name' and cat_id='$cat_id'";
			$q=mysqli_query($con,$check);
			if(mysqli_num_rows($q)>0)
				print "<p class='color'>Choose another name</p>";
			else
			{
				$sql="insert into subcategory (subcat_name,cat_id) values ('$subcat_name','$cat_id')";
				$succ=mysqli_query($con,$sql);
				if($succ){
					?>
					<script>
					window.location.href ="http://localhost/onlineshop/admin/index.php?view=listsubcategory.php";
					</script>
		<?php
				}else{
					print mysqli_error();
				}
			}
		}
	}
	
	if(isset($_REQUEST['edit']))
	{
		$subcat_id=$_REQUEST['subcat_id'];
		$subcat_name=$_REQUEST['subcat_name'];
		$cat_id=$_REQUEST['category'];
		$sql="update subcategory set subcat_name='$subcat_name',cat_id=$cat_id where subcat_id=$subcat_id";
		$succ=mysqli_query($con,$sql);
		if($succ){
			?>
					<script>
					window.location.href ="http://localhost/onlineshop/admin/index.php?view=listsubcategory.php";
					</script>
		<?php
		}else{
			print mysqli_error();
		}
	}
	
	if($_REQUEST['subcat_id'])
	{
		$subcat_id=$_REQUEST['subcat_id'];
		$sql="select * from subcategory where subcat_id=$subcat_id";
		$res=mysqli_query($con,$sql);
		$row=mysqli_fetch_array($res);
	}
?>
<form action="index.php?view=addsubcategory.php" method="post">
	<input type="hidden" name="subcat_id" value="<?=$row[0]?>">
	<table align="center" width="70%" height="50%" class="table">
		<th class="th" colspan="2"> SUBCATEGORY </th>
		<tr> 
			<td> Subcategory Name: </td>
			<td class="left"> <input type = "text" name="subcat_name" value="<?=$row[1]?>"></td>
		</tr>
		<tr>
			<td> Category </td>
			<td class="left"> 
				<select name="category">
					<option>--Select--</option>
					<?php 
						$selsql = "select * from category ";
						$selres = mysqli_query($con,$selsql);
						while($selrow = mysqli_fetch_array($selres)) { 
							if($row[2] == $selrow[0]) { 
					?>
					<option value="<?=$selrow[0]?>" selected><?=$selrow[1]?></option>
						<?php } else { ?>
					<option value="<?=$selrow[0]?>"><?=$selrow[1]?></option>
						<?php }} ?>
				</select>
			</td>
		</tr>
		<tr><td align="center" colspan=2> 
			<?php if($_REQUEST['subcat_id']) { ?>
					<input type="submit" name="edit" value="EDIT"class="button"> 
			<?php } else { ?>
					<input type="submit" name="save" value="SAVE"class="button">
			<?php } ?>
		</td></tr>	
	</table>
</form>	