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
	$con=mysqli_connect("localhost","root","","shop");
	if(isset($_REQUEST['search']))
	{
		$name=$_REQUEST['item'];
		if(empty($name))
			header("location:index.php?view=listuser.php");
		$sql = "select * from user where fname like '$name%' or lname like '$name%' or user like '$name%'";
		$res=mysqli_query($con,$sql);
	}
	else
	{		
		$sql = "select * from user";
		$res=mysqli_query($con,$sql);
	}
	
	if(isset($_REQUEST['Delete']))
	{
		$del = $_REQUEST['del'];
		
		$d = implode(",",$del);
		
		$delsql = "delete from user where user_id in (".$d.") ";
		mysqli_query($con,$delsql);
		
		?>
					<script>
					window.location.href ="http://localhost/onlineshop/admin/index.php?view=listuser.php";
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

<form method="post" action="index.php?view=listuser.php">
<input type="text" name="item" value="<?=$_REQUEST['item'];?>"><input type="submit" name="search" value="Search" class="button">
<table width="90%" align="center" height="50%" class="table">
	<th colspan=16 class="th">LIST OF USERS </th>
	<tr>
		<td class="tr">ID</td>
		<td class="tr">Username</td>
		<td class="tr">Password</td>
		<td class="tr">First Name</td>
		<td class="tr">Last Name</td>
		<td class="tr">Address</td>
		<td class="tr">City</td>
		<td class="tr">State</td>
		<td class="tr">Country</td>
		<td class="tr">Photo</td>
		<td class="tr">Gender</td>
		<td class="tr">Hobby</td>
		<td class="tr">Email</td>
		<td class="tr">Phone</td>
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
		<td><?=$row[5];?></td>
		<td><?=$row[6];?></td>
		<td>
			<?php 
				$state_id=$row[7];
				list($state)=mysqli_fetch_array(mysqli_query($con,"select state_name from state where state_id=".$state_id)); 
				print $state;
			?>
		</td>
		<td>
			<?php 
				$coun_id=$row[8];
				list($coun)=mysqli_fetch_array(mysqli_query($con,"select coun_name from country where coun_id=".$coun_id)); 
				print $coun;
			?>
		</td>
		<td><img src="images/<?=$row[9];?>" height="70" width="90"  /></td>
		<td><?=$row[10];?></td>
		<td><?=$row[11];?></td>
		<td><?=$row[12];?></td>
		<td><?=$row[13];?></td>
		<td><a style="width:40%" href="index.php?view=adduser.php&user_id=<?=$row[0];?>">Edit</a></td>
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