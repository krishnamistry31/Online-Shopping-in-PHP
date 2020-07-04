<head>
	<style>
		.table{
			background-color: darkblue;
		}
		.a:link, .a:visited {
			background-color: darkblue;
			color: white;
			font-size:20px;
			font-family:"Arial Black", Gadget, sans-serif;
			border: 1px solid darkblue;
			padding: 14px 25px;
			text-align: center;
			text-decoration: none;
			display: inline-block;
		}
		.a:hover, .a:active {
			background-color: rgb(255,245,240);
			color: darkblue;
			border: 1px solid darkblue;
			border-radius: 5px;
		}
	</style>
</head>
<?php
	session_start();
?>
<table width="100%" cellspacing="0px" cellpadding="0px" class="table">
	<tr>
		<td>
			<a href="index.php" class="a">HOME</a>
		</td>
		<td>
			<a href="index.php?view=aboutus.php" class="a">ABOUT US</a>
		</td>
		<td>
			<a href="index.php?view=category.php" class="a">CATEGORIES</a>
		</td>
		<td>
			<a href="index.php?view=product.php" class="a">PRODUCTS</a>
		</td>
		<?php  if($_SESSION['user']){  ?>
		<td>
			<a href="index.php?view=myacc.php" class="a">MY ACCOUNT</a>
		</td>
		<td>
			<a href="index.php?view=logout.php" class="a">LOGOUT</a>
		</td>
		<?php }else{  ?>
		<td>
			<a href="index.php?view=login.php" class="a">LOGIN</a>
		</td>
		<td>
			<a href="index.php?view=signup.php" class="a">SIGN UP</a>
		</td>
		<?php } ?>
	</tr>
</table>