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
		$coun_name=$_REQUEST['coun_name'];
		$coun_des=$_REQUEST['coun_des'];
		if(empty($coun_name))
			print "<p class='color'>Name is required</p>";
		elseif(empty($coun_des))
			print "<p class='color'>Description is required</p>";
		else
		{
			$check1="select * from country where coun_name='$coun_name'";
			$check2="select * from country where coun_desc='$coun_des'";
			$q1=mysqli_query($con,$check1);
			$q2=mysqli_query($con,$check2);
			if(mysqli_num_rows($q1)>0)
				print "<p class='color'>Choose another name</p>";
			elseif(mysqli_num_rows($q2)>0)
				print "<p class='color'>Choose another description</p>";
			else
			{
				$sql="insert into country (coun_name,coun_desc) values ('$coun_name','$coun_des')";
				$succ=mysqli_query($con,$sql);
				if($succ){
				?>
					<script>
					window.location.href ="http://localhost/onlineshop/admin/index.php?view=listcountry.php";
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
		$coun_id=$_REQUEST['coun_id'];
		$coun_name=$_REQUEST['coun_name'];
		$coun_des=$_REQUEST['coun_des'];
		$sql="update country set coun_name='$coun_name',coun_desc='$coun_des' where coun_id='".$coun_id."'";
		$succ=mysqli_query($con,$sql);
		if($succ){
?>
					<script>
					window.location.href ="http://localhost/onlineshop/admin/index.php?view=listcountry.php";
					</script>
		<?php		}else{
			print mysqli_error();
		}
	}	
	
	if($_REQUEST['coun_id'])
	{
		$coun_id=$_REQUEST['coun_id'];
		$sql="select * from country where coun_id=$coun_id";
		$res=mysqli_query($con,$sql);
		$row=mysqli_fetch_array($res);
	}
?>
<form action="index.php?view=addcountry.php" method="post">
	<input type="hidden" name="coun_id" value="<?=$row[0]?>">
	<table align="center" width="70%" height="50%" class="table">
		<th colspan=2 class="th">COUNTRY</th>
		<tr>
			<td>Country Name: </td>
			<td class="left"><input type="text" name="coun_name" value="<?=$row[1];?>"></td>
		</tr>
		<tr>
			<td>Country Description: </td>
			<td class="left"><textarea name="coun_des"><?=$row[2];?></textarea></td>
		</tr>
		<tr><td align="center" colspan="2">
			<?php if($_REQUEST['coun_id']) { ?>
						<input type="submit" name="edit" value="EDIT" class="button">
			<?php } else { ?>
						<input type="submit" name="save" value="SAVE" class="button">
			<?php } ?>
		</td></tr>
	</table>
</form>	