<head>
	<style>
		body{
			background-image: url("images/login.jpg");
			background-size: cover;
		}
		h1{
			color: white;
			font-size:60px;
			text-shadow: 1px 1px 2px black, 0 0 25px blue, 0 0 5px darkblue;
		}
		td{
			font-family:"Comic Sans MS", cursive, sans-serif;
			font-size:15px;
			color:#000066;
			text-align:center;
		}
		a:link, a:visited {
			background-color: rgba(100,100,255,0.5);
			color: white;
			width:80%;
			padding: 14px 25px;
			text-align: center;
			text-decoration: none;
			display: inline-block;
		}
		a:hover, a:active {
			background-color: rgba(100,100,255,0.9);
			color: #00004d;
		}
	</style>
</head>
<?php
	session_start();
	ini_set("display_errors","OFF");
	if($_SESSION['admuser']=="")
		header("location:login.php");
?>
<table align="center" width="100%" height="100%" cellspacing="0px" cellpadding="0px">
	<tr height="15%">
		<td width="10%">
			<?php include("header.php");?>
		</td>
		<td align="center" colspan=3>
			<h1>Admin</h1>
		</td>
	</tr>
	<tr height="5%" style="background-color:rgba(240,240,240,0.7)">
		<td width="10%">
			<?php include("homepage.php");?>
		</td>
		<td width="40%">
			<?php include("add.php");?>
		</td>
		<td width="40%">
			<?php include("view.php");?>
		</td>
		<td width="10%">
			<?php include("lg.php");?>
		</td>
	</tr>
	<tr>
		<td colspan=4>
			<?php
				if($_REQUEST['view']=="")
					include("home.php");
				else
					include($_REQUEST['view']);
			?>
		</td>
	</tr>
	<tr height="5%">
		<td colspan=4 align="center">
			<?php include("footer.php");?>
		</td>
	</tr>
</table>