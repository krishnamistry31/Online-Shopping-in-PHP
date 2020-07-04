<head>
	<style>
		body{
			background-color:rgba(255,245,240,0.4);
		}
		h1{
			color: white;
			font-size:60px;
			font-family:"Arial Black", Gadget, sans-serif;
			text-shadow: 1px 1px 2px black, 0 0 25px blue, 0 0 50px darkblue;
		}
	</style>
</head>
<?php
	ini_set("display_errors","OFF");
?>
<table align="center" height="100%" width="100%" cellspacing="0px" cellpadding="0px">
	<tr height="15%" align="center">
		<td width="85%" align="right">
			<h1>SHOPPY</h1>
		</td>
		<td width="15%">
			<?php include("header.php"); ?>
		</td>
	</tr>
	<tr height="5%">
		<td colspan=2>
			<?php include("menu.php"); ?>
		</td>
	</tr>
	<tr>
		<td colspan=2>
			<?php 
				if($_REQUEST['view']=="")
					include("main.php");
				else
					include($_REQUEST['view']);
			?>			
		</td>
	</tr>
	<tr height="4%">
		<td colspan=2 align="center" style="color:white;background-color:darkblue"> 
			copyrights @2018 all rights reserved
		</td>
	</tr>
</table>