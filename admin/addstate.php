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
		$state_name=$_REQUEST['state_name'];
		$state_desc=$_REQUEST['state_desc'];
		$coun_id=$_REQUEST['country'];
		if(empty($state_name))
			print "<p class='color'>Name is required</p>";
		elseif(empty($state_desc))
			print "<p class='color'>Description is required</p>";
		else
		{
			$check1="select * from state where state_name='$state_name' and coun_id='$coun_id'";
			$check2="select * from state where state_desc='$state_desc'";
			$q1=mysqli_query($con,$check1);
			$q2=mysqli_query($con,$check2);
			if(mysqli_num_rows($q1)>0)
				print "<p class='color'>Choose another name</p>";
			elseif(mysqli_num_rows($q2)>0)
				print "<p class='color'>Choose another description</p>";
			else
			{
				$sql="insert into state (state_name,state_desc,coun_id) values ('$state_name','$state_desc','$coun_id')";
				$succ=mysqli_query($con,$sql);
				if($succ){
				?>
					<script>
					window.location.href ="http://localhost/onlineshop/admin/index.php?view=liststate.php";
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
		$state_id=$_REQUEST['state_id'];
		$state_name=$_REQUEST['state_name'];
		$state_desc=$_REQUEST['state_desc'];
		$coun_id=$_REQUEST['country'];
		$sql="update state set state_name='$state_name',state_desc='$state_desc',coun_id='$coun_id' where state_id='".$state_id."'";
		$succ=mysqli_query($con,$sql);
		if($succ){
			?>
					<script>
					window.location.href ="http://localhost/onlineshop/admin/index.php?view=liststate.php";
					</script>
		<?php
		}else{
			print mysqli_error();
		}
	}
	
	if($_REQUEST['state_id'])
	{
		$state_id=$_REQUEST['state_id'];
		$sql="select * from state where state_id=$state_id";
		$res=mysqli_query($con,$sql);
		$row=mysqli_fetch_array($res);  
	}
?>
<form action="index.php?view=addstate.php" method="post">
	<input type="hidden" name="state_id" value="<?=$row[0]?>">
	<table align="center" width="70%" height="50%" class="table">
		<th colspan="2" class="th"> STATE </th>
		<tr> 
			<td> State Name: </td>
			<td class="left"> <input type = "text" name="state_name" value="<?=$row[1]?>"></td>
		</tr>
		<tr>
			<td> State Description: </td>
			<td class="left"><textarea name="state_desc"><?=$row[2];?></textarea></td>
		</tr>
		<tr>
			<td> Country </td>
			<td class="left"> 
				<select name="country">
					<option>--Select--</option>
					<?php 
						$selsql = "select * from country ";
						$selres = mysqli_query($con,$selsql);
						while($selrow = mysqli_fetch_array($selres)) {
							if($row[3] == $selrow[0]) {
					?>
					<option value="<?=$selrow[0]?>" selected><?=$selrow[1]?></option>
							<?php } else { ?>
					<option value="<?=$selrow[0]?>"><?=$selrow[1]?></option>
						<?php } }?>
				</select>
			</td>
		</tr>
		<tr><td align="center" colspan=2> 
			<?php if($_REQUEST['state_id']) { ?>
					<input type="submit" name="edit" value="EDIT"class="button"> 
			<?php } else { ?>
					<input type="submit" name="save" value="SAVE" class="button">
			<?php } ?>
		</td></tr>	
	</table>
</form>	