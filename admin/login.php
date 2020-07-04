<head>
	<style>
		body{
			background-image: url("images/login.jpg");
			background-size: cover;
		}
		table{
			background-color: rgba(240, 240, 240, 0.4);
			border-radius: 20px;
			padding:40px 5px;
		}
		th{
			font-family:"Arial Black", Gadget, sans-serif;
			font-size:40px;
			color:#000066;
		    font-style: italic;
		}
		td{
			font-family:"Comic Sans MS", cursive, sans-serif;
			font-size:25px;
			color:#000066;
			text-align:center;
		}
		input[type=text],input[type=password] {
			padding: 12px 20px;
			margin: 8px 0;
			width:80%;
			font-size:20px;
			box-sizing: border-box;
			border: none;
			border-radius:10px;
			background-color: rgba(240,240,240,0.7);
			color:#000066 ;
		}
		.color{
			color:white;
		}
		.button {
			background-color: #000080;
			border: none;
			border-radius:5px;
			color: white;
			padding: 15px 32px;
			text-align: center;
			text-decoration: none;
			display: inline-block;
			font-size: 20px;
			margin: 4px 2px;
			cursor: pointer;
		}
	</style>
</head>
<?php
	session_start();
	ini_set("display_errors","OFF");
	$con=mysqli_connect("localhost","root","","shop");
	
	if(isset($_REQUEST['login']))
	{
		$name=$_REQUEST['name'];
		$pass=$_REQUEST['pass'];
		$sql="select * from admin where user='$name' and password='$pass'";
		$res=mysqli_query($con,$sql);
		$count=mysqli_num_rows($res);
		if($count > 0)
		{
			$_SESSION['admuser']=$name;
			print "logged in";
			header("location:index.php");
		}
		else
			print "<center><h2><p class='color'>Invalid login details</p></h2></center>";
	}
?>
<body>
<form action="" method="post">
	<table align="center" width="35%" height="85%" >
		<th><img src="images/logo.png" width="100px" height="100px"></th>
		<th align="left">LOGIN</th>
		<tr>
			<td colspan=2> User Name: </td>
		</tr>
		<tr>
			<td colspan=2> <input type="text" name="name" ></td>
		</tr>
		<tr>
			<td colspan=2> Password: </td>
		</tr>
		<tr>
			<td colspan=2> <input type="password" name="pass" ></td>
		</tr>
		<tr>
			<td colspan=2> 
				<input type="submit" name="login" value="LOGIN" class="button">
			</td>
		</tr>
	</table>
</form>
</body>