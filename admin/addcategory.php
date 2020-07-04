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
		input[type=text]{
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
		$name = $_REQUEST['cat_name'];
		$des = $_REQUEST['cat_desc'];
		$photo=$_FILES['photo']['name'];
		
		if(empty($name))
			print "<p class='color'>Name is required</p>";
		elseif(empty($des))
			print "<p class='color'>Description is required</p>";
		elseif(empty($photo))
			print "<p class='color'>Photo is required</p>";
		else
		{
			$check1="select * from category where cat_name='$name'";
			$check2="select * from category where cat_desc='$des'";
			$check3="select * from category where cat_photo='$photo'";
			$q1=mysqli_query($con,$check1);
			$q2=mysqli_query($con,$check2);
			$q3=mysqli_query($con,$check3);
			if(mysqli_num_rows($q1)>0)
				print "<p class='color'>Choose another name</p>";
			elseif(mysqli_num_rows($q2)>0)
				print "<p class='color'>Choose another description</p>";
			elseif(mysqli_num_rows($q3)>0)
				print "<p class='color'>Choose another photo</p>";
			else
			{
				move_uploaded_file($_FILES['photo']['tmp_name'],"images/".$photo);
				$sql="insert into category(cat_name,cat_desc,cat_photo) values ('$name','$des','$photo')";
				$succ=mysqli_query($con,$sql);
				if($succ){
				?>
					<script>
					window.location.href ="http://localhost/onlineshop/admin/index.php?view=listcategory.php";
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
		$id = $_REQUEST['cat_id'];
		$name = $_REQUEST['cat_name'];
		$des = $_REQUEST['cat_desc'];
		$photo=$_FILES['photo']['name'];
		if($photo=="")
		{
			$sql="update category set cat_name='$name',cat_desc='$des' where cat_id='".$id . "'";
		}
		else
		{
			move_uploaded_file($_FILES['photo']['tmp_name'],"images/".$photo);
			$sql="update category set cat_name='$name',cat_desc='$des',cat_photo='$photo' where cat_id=".$id;
		}
		$succ=mysqli_query($con,$sql);
		if($succ){
			?>
					<script>
					window.location.href ="http://localhost/onlineshop/admin/index.php?view=listcategory.php";
					</script>
		<?php
		}else{
			print mysqli_error();
		}
	}
	if(isset($_REQUEST['cat_id']))
	{
		$sql = "select * from category where cat_id=".$_REQUEST['cat_id'];
		$res=mysqli_query($con,$sql);
		$row=mysqli_fetch_array($res);
	}
?>
<form action="index.php?view=addcategory.php" method="post" enctype="multipart/form-data">
	<input type="hidden" name="cat_id" value="<?=$row[0]?>">
	<table align="center" width="70%" height="50%" class="table">
		<th colspan="2" class="th"> CATEGORY </th>
		<tr> 
			<td> Category Name: </td>
			<td  class="left"> <input type="text" name="cat_name" value="<?=$row[1]?>"> </td>
		</tr>
		<tr> 
			<td> Category Description: </td>
			<td  class="left"> <textarea name="cat_desc"><?=$row[2]?></textarea> </td>
		</tr>
		<tr>
			<td> Category Photo: </td>
			<td  class="left"> <input type="file" name="photo">  <img src="images/<?=$row[3];?>" alt="No file Choosen" height="70" width="90"/><br> </td>
		</tr>
		<tr><td align="center" colspan="2">
				<?php if($_REQUEST['cat_id']) { ?>
							<input type="submit" name="edit" class="button" value="EDIT" >
				<?php } else { ?>
							<input type="submit" name="save" class="button" value="SAVE" >
				<?php } ?>
		</td></tr>
	</table>
</form>