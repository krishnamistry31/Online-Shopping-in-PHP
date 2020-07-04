<head>
	<style>
		.table{
				background-color: rgba(240, 240, 240, 0.8);
				border: 2px solid black;
				border-radius: 5px 50px;
				padding: 50px 5px;
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
		input[type=text] {
			padding: 5px 5px;
			width:80%;
			font-size:15px;
			box-sizing: border-box;
			border: 2px solid #ccc;
			border-radius:4px;
			background-color: #f8f8f8;
			color:#000066 ;
		}
		input[type=file] {
			width:80%;
			font-size:15px;
			box-sizing: border-box;
			border: 2px solid #ccc;
			border-radius:4px;
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
		$p_name = $_REQUEST['p_name'];
		$p_fdesc = $_REQUEST['p_fdesc'];
		$p_sdesc = $_REQUEST['p_sdesc'];
		$p_price = $_REQUEST['p_price'];
		$p_logo=$_FILES['photo']['name'];
		$cat_id = $_REQUEST['category'];
		$subcat_id = $_REQUEST['subcategory'];
		$brand_id = $_REQUEST['brand'];
		$export = $_REQUEST['export'];
		$exportto = ""; 
		foreach($export as $e) 
		{ 
			$exportto .= $e . ","; 
		} 
		if(empty($p_name))
			print "<p class='color'>Name is required</p>";
		elseif(empty($p_fdesc))
			print "<p class='color'>Full Description is required</p>";
		elseif(empty($p_sdesc))
			print "<p class='color'>Short Description is required</p>";
		elseif(empty($p_logo))
			print "<p class='color'>Photo is required";
		else
		{
			$check1="select * from product where p_name='$p_name' and cat_id='$cat_id' and subcat_id='$subcat_id' and brand_id='$brand_id'";
			$check2="select * from product where p_fdesc='$p_fdesc'";
			$check3="select * from product where p_sdesc='$p_sdesc'";
			$q1=mysqli_query($con,$check1);
			$q2=mysqli_query($con,$check2);
			$q3=mysqli_query($con,$check3);
			if(mysqli_num_rows($q1)>0)
				print "<p class='color'>Choose another name</p>";
			elseif(mysqli_num_rows($q2)>0)
				print "<p class='color'>Choose another full description</p>";
			elseif(mysqli_num_rows($q3)>0)
				print "<p class='color'>Choose another short description</p>";
			else
			{
				move_uploaded_file($_FILES['photo']['tmp_name'],"images/".$photo);
				$sql="insert into product (p_name,p_fdesc,p_sdesc,p_price,p_logo,cat_id,subcat_id,brand_id,export) values ('$p_name','$p_fdesc','$p_sdesc','$p_price','$p_logo','$cat_id','$subcat_id','$brand_id','$exportto')";
				$succ=mysqli_query($con,$sql);
				if($succ){
?>
					<script>
					window.location.href ="http://localhost/onlineshop/admin/index.php?view=listproduct.php";
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
		$p_id = $_REQUEST['p_id'];
		$p_name = $_REQUEST['p_name'];
		$p_fdesc = $_REQUEST['p_fdesc'];
		$p_sdesc = $_REQUEST['p_sdesc'];
		$p_price = $_REQUEST['p_price'];
		$p_logo=$_FILES['photo']['name'];
		$cat_id = $_REQUEST['category'];
		$subcat_id = $_REQUEST['subcategory'];
		$brand_id = $_REQUEST['brand'];
		$export = $_REQUEST['export'];
		$exportto = ""; 
		foreach($export as $e) 
		{ 
			$exportto .= $e . ","; 
		}
		if($photo == "")
		{
			$sql="update product set p_name='$p_name',p_fdesc='$p_fdesc',p_sdesc='$p_sdesc',p_price='$p_price',cat_id='$cat_id',subcat_id='$subcat_id',brand_id='$brand_id',export='$exportto' where p_id=".$p_id;	
		}
		else
		{
			move_uploaded_file($_FILES['photo']['tmp_name'],"images/".$photo);
			$sql="update product set p_name='$p_name',p_fdesc='$p_fdesc',p_sdesc='$p_sdesc',p_price='$p_price',p_logo='$p_logo',cat_id='$cat_id',subcat_id='$subcat_id',brand_id='$brand_id',export='$exportto' where p_id='".$p_id."'";
		}
		$succ=mysqli_query($con,$sql);
		if($succ){
			?>
					<script>
					window.location.href ="http://localhost/onlineshop/admin/index.php?view=listproduct.php";
					</script>
		<?php
		}else{
			print mysqli_error();
		}
	}
	
	if(isset($_REQUEST['p_id']))
	{
		$sql = "select * from product where p_id=".$_REQUEST['p_id'];
		$res=mysqli_query($con,$sql);
		$row=mysqli_fetch_array($res);
	}
?>
<form action="index.php?view=addproduct.php" method="post" enctype="multipart/form-data">
	<input type="hidden" name="p_id" value="<?=$row[0]?>">
	<table align="center" width="70%" height="50%" class="table">
		<th colspan="2" class="th"> PRODUCT </th>
		<tr> 
			<td> Product Name: </td>
			<td class="left"> <input type="text" name="p_name" value="<?=$row[1]?>"> </td>
		</tr>
		<tr> 
			<td> Product Full Description: </td>
			<td class="left"> <textarea name="p_fdesc"><?=$row[2]?></textarea> </td>
		</tr>
		<tr> 
			<td> Product Short Description: </td>
			<td class="left"> <textarea name="p_sdesc"><?=$row[3]?></textarea> </td>
		</tr>
		<tr> 
			<td> Product Price: </td>
			<td class="left"> <input type="text" name="p_price" value="<?=$row[4]?>"> </td>
		</tr>
		<tr>
			<td> Product Photo: </td>
			<td class="left"> <input type="file" name="photo"> <img src="images/<?=$row[5];?>" alt="No file Choosen" height="70" width="90"/><br> </td>
		</tr>
		<tr>
			<td> Category: </td>
			<td class="left"> 
				<select name="category">
					<option>--Select--</option>
					<?php 
						$selsql = "select * from category ";
						$selres = mysqli_query($con,$selsql);
						while($selrow = mysqli_fetch_array($selres)) {
								if($row[6] == $selrow[0]){
					?>
					<option value="<?=$selrow[0]?>" selected><?=$selrow[1]?></option>
						<?php }	else { ?>
					<option value="<?=$selrow[0]?>"><?=$selrow[1]?></option>
						<?php }	}?>
				</select>
			</td>
		</tr>
		<tr>
			<td> Subcategory: </td>
			<td class="left"> 
				<select name="subcategory">
					<option>--Select--</option>
					<?php 
						$selsql = "select * from subcategory ";
						$selres = mysqli_query($con,$selsql);
						while($selrow = mysqli_fetch_array($selres)) { 
							if($row[7] == $selrow[0]) {
					?>
					<option value="<?=$selrow[0]?>" selected><?=$selrow[1]?></option>
						<?php } else { ?>
					<option value="<?=$selrow[0]?>"><?=$selrow[1]?></option>
						<?php }} ?>
				</select>
			</td>
		</tr>
		<tr>
			<td> Brand: </td>
			<td class="left"> 
				<select name="brand">
					<option>--Select--</option>
					<?php 
						$selsql = "select * from brand ";
						$selres = mysqli_query($con,$selsql);
						while($selrow = mysqli_fetch_array($selres)) { 
							if($row[8] == $selrow[0]) {
					?>
					<option value="<?=$selrow[0]?>" selected><?=$selrow[1]?></option>
							<?php } else { ?>
					<option value="<?=$selrow[0]?>"><?=$selrow[1]?></option>
							<?php }} ?>
				</select>
			</td>
		</tr>
		<tr>
			<td>Export To:</td>
			<td class="left">
				<?php if(substr_count($row[9],"America") > 0) { ?> 
				<input type="checkbox" name="export[]" value="America" checked>America
				<?php } else { ?>
				<input type="checkbox" name="export[]" value="America">America
				<?php } ?>
				<?php if(substr_count($row[9],"China") > 0) { ?> 
				<input type="checkbox" name="export[]" value="China" checked>China 
				<?php } else { ?>				
				<input type="checkbox" name="export[]" value="China">China 
				<?php } ?>
				<?php if(substr_count($row[9],"Canada") > 0) { ?> 
				<input type="checkbox" name="export[]" value="Canada"checked>Canada 
				<?php } else { ?>				
				<input type="checkbox" name="export[]" value="Canada">Canada 
				<?php } ?>				
			</td>
		</tr>
		<tr><td align="center" colspan="2">
				<?php if($_REQUEST['p_id']) { ?>
							<input type="submit" name="edit" value="EDIT" class="button">
				<?php } else { ?>
							<input type="submit" name="save" value="SAVE" class="button">
				<?php } ?>
		</td></tr>
	</table>
</form>