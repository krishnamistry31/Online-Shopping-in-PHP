<?php 
	session_start();
	ini_set("display_errors","OFF");
	$con = mysqli_connect("localhost","root","","shop");
	
	if(isset($_REQUEST['login']))
	{
		$name = $_REQUEST['name'];
		$pass = $_REQUEST['pass'];
		$loginsql = "select * from user where user='" . $name . "' and password= '" .$pass . "'";
		$res = mysqli_query($con,$loginsql);
		
		if(mysqli_num_rows($res) > 0)
		{
			$_SESSION['user']=$name;
			header("location:index.php");	
		}else
			print "Invalid login details";
	}
?>
<form action="index.php?view=login.php" method="post">
	<table align="center" width="50%">
		<th colspan=2>Login</th>
		<tr>
			<td> Username:</td>
			<td>
				<input type="text" name="name" value="<?=$_REQUEST['name'];?>">
			</td>
		</tr>
		<tr>
			<td> Password:</td>
			<td>
				<input type="password" name="pass" value="<?=$_REQUEST['pass'];?>">
			</td>
		</tr>
		<tr>
			<td colspan=2>
				<input type="submit" name="login" value="LOGIN">
			</td>
		</tr>
	</table>
</form>