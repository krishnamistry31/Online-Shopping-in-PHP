<head>
	<style>	
		.select {
			width: 80%;
			border: none;
			border-radius: 4px;
			background-color: rgba(10,0,10,0);
			color:#000066 ;
		}
	</style>
</head>
<select class="select" onChange="window.location.href=this.value">
	<option>--VIEW--</option>
	<option value="index.php?view=listcategory.php">VIEW CATEGORY </option>		
	<option value="index.php?view=listsubcategory.php">VIEW SUBCATEGORY </option>	
	<option value="index.php?view=listbrand.php">VIEW BRAND </option>		
	<option value="index.php?view=listproduct.php">VIEW PRODUCT </option>		
	<option value="index.php?view=listuser.php">VIEW USER </option>		
	<option value="index.php?view=listcountry.php">VIEW COUNTRY </option>
	<option value="index.php?view=liststate.php">VIEW STATE </option>		
</select>