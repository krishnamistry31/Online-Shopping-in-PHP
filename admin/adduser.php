<head>
	<style>
		.table{
				background-color: rgba(240, 240, 240, 0.8);
				border: 2px solid black;
				padding:5px 5px;
				border-radius: 5px 50px;
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
		input[type=text],input[type=password],input[type=email] {
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
		$uname = $_REQUEST['uname'];
		$pass = $_REQUEST['pass'];
		$fname = $_REQUEST['fname'];
		$lname = $_REQUEST['lname'];
		$add = $_REQUEST['add'];
		$city = $_REQUEST['city'];
		$state = $_REQUEST['state'];
		$country = $_REQUEST['country'];
		$photo=$_FILES['photo']['name'];
		$gender = $_REQUEST['gender'];
		$hobby = $_REQUEST['hobby'];
		$email = $_REQUEST['email'];
		$phone = $_REQUEST['phone'];
		
		if(empty($uname))
			print "<p class='color'>User Name is required</p>";
		elseif(empty($pass))
			print "<p class='color'>Password is required</p>";
		elseif(empty($fname))
			print "<p class='color'>First Name is required</p>";
		elseif(empty($lname))
			print "<p class='color'>Last Name is required</p>";
		elseif(empty($photo))
			print "<p class='color'>Photo is required</p>";
		elseif(empty($add))
			print "<p class='color'>Address is required</p>";
		elseif(empty($city))
			print "<p class='color'>City is required</p>";
		elseif(empty($email))
			print "<p class='color'>Email is required</p>";
		elseif(empty($phone))
			print "<p class='color'>Phone is required</p>";
		else
		{
			$check1="select * from user where user='$uname'";
			$check2="select * from user where password='$pass'";
			$check3="select * from user where photo='$photo'";
			$check4="select * from user where email='$email'";
			$check5="select * from user where phone='$phone'";
			$q1=mysqli_query($con,$check1);
			$q2=mysqli_query($con,$check2);
			$q3=mysqli_query($con,$check3);
			$q4=mysqli_query($con,$check4);
			$q5=mysqli_query($con,$check5);
			if(mysqli_num_rows($q1)>0)
				print "<p class='color'>Choose another User Name</p>";
			elseif(mysqli_num_rows($q2)>0)
				print "<p class='color'>Choose another Password</p>";
			elseif(mysqli_num_rows($q3)>0)
				print "<p class='color'>Choose another Photo</p>";
			elseif(mysqli_num_rows($q4)>0)
				print "<p class='color'>Choose another Email</p>";
			elseif(mysqli_num_rows($q5)>0)
				print "<p class='color'>Choose another Phone</p>";
			else
			{
				move_uploaded_file($_FILES['photo']['tmp_name'],"images/".$photo);
				$sql="insert into user (user,password,fname,lname,address,city,state,country,photo,gender,hobby,email,phone) values ('$uname','$pass','$fname','$lname','$add','$city','$state','$country','$photo','$gender','$hobby','$email',$phone)";
				$succ=mysqli_query($con,$sql);
				if($succ){
?>
					<script>
					window.location.href ="http://localhost/onlineshop/admin/index.php?view=listuser.php";
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
		$id = $_REQUEST['user_id'];
		$uname = $_REQUEST['uname'];
		$pass = $_REQUEST['pass'];
		$fname = $_REQUEST['fname'];
		$lname = $_REQUEST['lname'];
		$add = $_REQUEST['add'];
		$city = $_REQUEST['city'];
		$state = $_REQUEST['state'];
		$country = $_REQUEST['country'];
		$photo=$_FILES['photo']['name'];
		$gender = $_REQUEST['gender'];
		$hobby = $_REQUEST['hobby'];
		$email = $_REQUEST['email'];
		$phone = $_REQUEST['phone'];
		if($photo == "")
		{
			$sql="update user set user='$uname',password='$pass',fname='$fname',lname='$lname',address='$add',city='$city',state='$state',country='$country',gender='$gender',hobby='$hobby',email='$email',phone=$phone where user_id=".$id;		}
		else
		{
			move_uploaded_file($_FILES['photo']['tmp_name'],"images/".$photo);
			$sql="update user set user='$uname',password='$pass',fname='$fname',lname='$lname',address='$add',city='$city',state='$state',country='$country',photo='$photo',gender='$gender',hobby='$hobby',email='$email',phone=$phone where user_id=".$id;
		}
		$succ=mysqli_query($con,$sql);
		if($succ){
?>
					<script>
					window.location.href ="http://localhost/onlineshop/admin/index.php?view=listuser.php";
					</script>
		<?php		}else{
			print mysqli_error();
		}
	}
	
	if(isset($_REQUEST['user_id']))
	{
		$sql = "select * from user where user_id=".$_REQUEST['user_id'];
		$res=mysqli_query($con,$sql);
		$row=mysqli_fetch_array($res);
	}
?>
<form action="index.php?view=adduser.php" method="post" enctype="multipart/form-data">
	<input type="hidden" name="user_id" value="<?=$row[0]?>">
	<table align="center" width="70%" height="50%" class="table">
		<th colspan="2" class="th" > REGISTER </th>
		<tr> 
			<td> User Name: </td>
			<td class="left"> <input type="text" name="uname" value="<?=$row[1]?>"> </td>
		</tr>
		<tr> 
			<td> Password: </td>
			<td class="left"> <input type="password" name="pass" value="<?=$row[2]?>"> </td>
		</tr>
		<tr> 
			<td> First Name: </td>
			<td class="left"> <input type="text" name="fname" value="<?=$row[3]?>"> </td>
		</tr>
		<tr> 
			<td> Last Name: </td>
			<td class="left"> <input type="text" name="lname" value="<?=$row[4]?>"> </td>
		</tr>
		<tr> 
			<td> Address: </td>
			<td class="left"> <textarea name="add"><?=$row[5]?></textarea> </td>
		</tr>
		<tr> 
			<td> City: </td>
			<td class="left"> <input type="text" name="city" value="<?=$row[6]?>"> </td>
		</tr>
		<tr>
			<td> State: </td>
			<td class="left"> 
				<select name="state">
					<option>--Select--</option>
					<?php 
						$selsql = "select * from state ";
						$selres = mysqli_query($con,$selsql);
						while($selrow = mysqli_fetch_array($selres)) { 
							if($row[7] == $selrow[0]) {
					?>
					<option value="<?=$selrow[0]?>" selected><?=$selrow[1]?></option>
						<?php } else { ?>
					<option value="<?=$selrow[0]?>"><?=$selrow[1]?></option>
						<?php } }?>
				</select>
			</td>
		</tr>
		<tr>
			<td> Country: </td>
			<td class="left"> 
				<select name="country">
					<option>--Select--</option>
					<?php 
						$selsql = "select * from country ";
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
			<td> Photo: </td>
			<td class="left"> <input type="file" name="photo"> <img src="images/<?=$row[9];?>" alt="No file Choosen" height="70" width="90"/><br> </td>
		</tr>
		<tr>
			<td> Gender: </td>
			<td class="left">
				<?php if($row[10] == "Female") {?> 
				<input type="radio" name="gender" value="Female" checked>Female 
				<input type="radio" name="gender" value="Male">Male
				<input type="radio" name="gender" value="Other">Other
				<?php }elseif($row[10] == "Male") { ?>
				<input type="radio" name="gender" value="Female">Female 
				<input type="radio" name="gender" value="Male" checked>Male
				<input type="radio" name="gender" value="Other">Other
				<?php } else { ?>
				<input type="radio" name="gender" value="Female">Female 
				<input type="radio" name="gender" value="Male">Male
				<input type="radio" name="gender" value="Other" checked>Other
				<?php } ?>
			</td>
		</tr>
		<tr> 
			<td> Hobbies: </td>
			<td class="left"> <textarea name="hobby"><?=$row[11]?></textarea> </td>
		</tr>
		<tr> 
			<td> Email id: </td>
			<td class="left"> <input type="email" name="email" value="<?=$row[12]?>"> </td>
		</tr>
		<tr> 
			<td> Phone no.: </td>
			<td class="left"> <input type="text" name="phone" value="<?=$row[13]?>"> </td>
		</tr>
		<tr><td align="center" colspan="2">
				<?php if($_REQUEST['user_id']) { ?>
							<input type="submit" name="edit" value="EDIT" class="button">
				<?php } else { ?>
							<input type="submit" name="save" value="SAVE" class="button">
				<?php } ?>
		</td></tr>
	</table>
</form>