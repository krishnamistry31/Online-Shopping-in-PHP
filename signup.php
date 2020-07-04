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
			print "<p >User Name is required</p>";
		elseif(empty($pass))
			print "<p >Password is required</p>";
		elseif(empty($fname))
			print "<p >First Name is required</p>";
		elseif(empty($lname))
			print "<p >Last Name is required</p>";
		elseif(empty($photo))
			print "<p >Photo is required</p>";
		elseif(empty($add))
			print "<p >Address is required</p>";
		elseif(empty($city))
			print "<p >City is required</p>";
		elseif(empty($email))
			print "<p >Email is required</p>";
		elseif(empty($phone))
			print "<p >Phone is required</p>";
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
				print "<p >Choose another User Name</p>";
			elseif(mysqli_num_rows($q2)>0)
				print "<p >Choose another Password</p>";
			elseif(mysqli_num_rows($q3)>0)
				print "<p >Choose another Photo</p>";
			elseif(mysqli_num_rows($q4)>0)
				print "<p >Choose another Email</p>";
			elseif(mysqli_num_rows($q5)>0)
				print "<p >Choose another Phone</p>";
			else
			{
				move_uploaded_file($_FILES['photo']['tmp_name'],"images/".$photo);
				$sql="insert into user (user,password,fname,lname,address,city,state,country,photo,gender,hobby,email,phone) values ('$uname','$pass','$fname','$lname','$add','$city','$state','$country','$photo','$gender','$hobby','$email',$phone)";
				$succ=mysqli_query($con,$sql);
				if($succ){
?>
					<script>
					window.location.href ="http://localhost/onlineshop/index.php?view=login.php";
					</script>
				<?php				
				}else{
					print mysqli_error();
				}
			}
		}
	}
?>
<form action="index.php?view=signup.php" method="post" enctype="multipart/form-data">
	<table align="center" width="70%" height="50%">
		<th colspan="2" > REGISTER </th>
		<tr> 
			<td> User Name: </td>
			<td > <input type="text" name="uname"> </td>
		</tr>
		<tr> 
			<td> Password: </td>
			<td > <input type="password" name="pass"> </td>
		</tr>
		<tr> 
			<td> First Name: </td>
			<td > <input type="text" name="fname"> </td>
		</tr>
		<tr> 
			<td> Last Name: </td>
			<td > <input type="text" name="lname"> </td>
		</tr>
		<tr> 
			<td> Address: </td>
			<td > <textarea name="add"></textarea> </td>
		</tr>
		<tr> 
			<td> City: </td>
			<td > <input type="text" name="city"> </td>
		</tr>
		<tr>
			<td> State: </td>
			<td > 
				<select name="state">
					<option>--Select--</option>
					<?php 
						$selsql = "select * from state ";
						$selres = mysqli_query($con,$selsql);
						while($selrow = mysqli_fetch_array($selres)) { 
					?>
					<option value="<?=$selrow[0]?>"><?=$selrow[1]?></option>
						<?php } ?>
				</select>
			</td>
		</tr>
		<tr>
			<td> Country: </td>
			<td > 
				<select name="country">
					<option>--Select--</option>
					<?php 
						$selsql = "select * from country ";
						$selres = mysqli_query($con,$selsql);
						while($selrow = mysqli_fetch_array($selres)) {
					?>
					<option value="<?=$selrow[0]?>"><?=$selrow[1]?></option>
						<?php } ?>
				</select>
			</td>
		</tr>
		<tr>
			<td> Photo: </td>
			<td > <input type="file" name="photo"> </td>
		</tr>
		<tr>
			<td> Gender: </td>
			<td >
				<input type="radio" name="gender" value="Female">Female 
				<input type="radio" name="gender" value="Male">Male
				<input type="radio" name="gender" value="Other">Other
			</td>
		</tr>
		<tr> 
			<td> Hobbies: </td>
			<td > <textarea name="hobby"></textarea> </td>
		</tr>
		<tr> 
			<td> Email id: </td>
			<td > <input type="email" name="email"> </td>
		</tr>
		<tr> 
			<td> Phone no.: </td>
			<td > <input type="text" name="phone"> </td>
		</tr>
		<tr>
			<td align="center" colspan="2">
				<input type="submit" name="save" value="SAVE" >
			</td>
		</tr>
	</table>
</form>