<?php
	ini_set("display_errors","OFF");
	$con=mysqli_connect("localhost","root","","shop");
	$FinalEditID = $_REQUEST['brand_id'];
	if(isset($_REQUEST['save']))
	{
		
		$b_name=$_REQUEST['b_name'];
		$b_desc=$_REQUEST['b_desc'];
		if(empty($b_name))
			print "<p class='color'>Name is required</p>";
		elseif(empty($b_desc))
			print "<p class='color'>Description is required</p>";
		else
		{
			$check1="select * from brand where brand_name='$b_name'";
			$check2="select * from brand where brand_desc='$b_desc'";
			$q1=mysqli_query($con,$check1);
			$q2=mysqli_query($con,$check2);
			if(mysqli_num_rows($q1)>0)
				print "<p class='color'>Choose another name</p>";
			elseif(mysqli_num_rows($q2)>0)
				print "<p class='color'>Choose another description</p>";
			else
			{
				$sql="insert into brand (brand_name,brand_desc) values ('$b_name','$b_desc')";
				$succ=mysqli_query($con,$sql);
				if($succ){
				?>
					<script>
					window.location.href ="http://localhost/onlineshop/admin/index.php?view=listbrand.php";
					</script><?php		
				}else{
					print mysqli_error();
				}	
			}
		}
	}

	if(isset($_REQUEST['edit']))
	{
		$b_name=$_REQUEST['b_name'];
		$b_desc=$_REQUEST['b_desc'];
		
		
		$SqlDataUpdate="update brand set brand_name='$b_name',brand_desc='$b_desc' where brand_id='".$FinalEditID."' ";
		
		$SucessDataQuery=mysqli_query($con,$SqlDataUpdate);
		if($SucessDataQuery){
		?>
					<script>
					window.location.href ="http://localhost/onlineshop/admin/index.php?view=listbrand.php";
					</script>
		<?php		 
		}else{
		
			print mysqli_error();
		}
	}

	if($_REQUEST['brand_id'])
	{
		$brand_id=$_REQUEST['brand_id'];
		$sql="select * from brand where brand_id=$brand_id";
		$res=mysqli_query($con,$sql);
		$row=mysqli_fetch_array($res);
	}
?>
<html>
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
<body>
<form action="index.php?view=addbrand.php" method="post">
	<input type="hidden" name="brand_id" value="<?=$row[0]?>">
	<table align="center" width="70%" height="50%" class="table">
		<th colspan=2 class="th">BRAND</th>
		<tr>
			<td>Brand Name: </td>
			<td class="left"><input type="text" name="b_name" value="<?=$row[1];?>"></td>
		</tr>
		<tr>
			<td>Brand Description: </td>
			<td class="left"><textarea name="b_desc"><?=$row[2];?></textarea></td>
		</tr>
		<tr><td align="center" colspan="2">
			<?php if($_REQUEST['brand_id']) { ?>
						<input type="submit" name="edit" value="EDIT" class="button">
			<?php } else { ?>
						<input type="submit" name="save" value="SAVE" class="button">
			<?php } ?>
		</td></tr>
	</table>
</form>
</body>
</html>