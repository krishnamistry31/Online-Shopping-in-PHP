<?php
 session_start();
	ini_set("display_errors","OFF");
	$con=mysqli_connect("localhost","root","","shop");
	
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
			$sql="update user set user='$uname',password='$pass',fname='$fname',lname='$lname',address='$add',city='$city',state='$state',country='$country',gender='$gender',hobby='$hobby',email='$email',phone=$phone where user='".$_SESSION['user']."'";		}
		else
		{
			move_uploaded_file($_FILES['photo']['tmp_name'],"images/".$photo);
			$sql="update user set user='$uname',password='$pass',fname='$fname',lname='$lname',address='$add',city='$city',state='$state',country='$country',photo='$photo',gender='$gender',hobby='$hobby',email='$email',phone=$phone where user='".$_SESSION['user']."'";
		}
		$succ=mysqli_query($con,$sql);
		if($succ){
?>
					<script>
					window.location.href ="http://localhost/onlineshop/index.php";
					</script>
		<?php		}else{
			print mysqli_error();
		}
	}
	
	if($_SESSION['user'])
	{
		$sql = "select * from user where user='".$_SESSION['user']."'";
		$res=mysqli_query($con,$sql);
		$row=mysqli_fetch_array($res);
	}
?>
<form action="index.php?view=myacc.php" method="post" enctype="multipart/form-data">
	<input type="hidden" name="user_id" value="<?=$row[0]?>">
	<table align="center" width="70%" height="50%">
		<th colspan="2"> REGISTER </th>
		<tr> 
			<td> User Name: </td>
			<td > <input type="text" name="uname" value="<?=$row[1]?>"> </td>
		</tr>
		<tr> 
			<td> Password: </td>
			<td > <input type="password" name="pass" value="<?=$row[2]?>"> </td>
		</tr>
		<tr> 
			<td> First Name: </td>
			<td > <input type="text" name="fname" value="<?=$row[3]?>"> </td>
		</tr>
		<tr> 
			<td> Last Name: </td>
			<td > <input type="text" name="lname" value="<?=$row[4]?>"> </td>
		</tr>
		<tr> 
			<td> Address: </td>
			<td > <textarea name="add"><?=$row[5]?></textarea> </td>
		</tr>
		<tr> 
			<td> City: </td>
			<td > <input type="text" name="city" value="<?=$row[6]?>"> </td>
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
			<td > 
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
			<td > <input type="file" name="photo"> <img src="images/<?=$row[9];?>" alt="No file Choosen" height="70" width="90"/><br> </td>
		</tr>
		<tr>
			<td> Gender: </td>
			<td >
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
			<td > <textarea name="hobby"><?=$row[11]?></textarea> </td>
		</tr>
		<tr> 
			<td> Email id: </td>
			<td > <input type="email" name="email" value="<?=$row[12]?>"> </td>
		</tr>
		<tr> 
			<td> Phone no.: </td>
			<td > <input type="text" name="phone" value="<?=$row[13]?>"> </td>
		</tr>
		<tr>
			<td align="center" colspan="2">
				<input type="submit" name="edit" value="EDIT">
			</td>
		</tr>
	</table>
</form>