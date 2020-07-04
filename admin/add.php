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
	<option>--ADD--</option>
	<option value="index.php?view=addcategory.php">ADD CATEGORY </option>
	<option value="index.php?view=addsubcategory.php">ADD SUBCATEGORY </option>		
	<option value="index.php?view=addbrand.php">ADD BRAND </option>
	<option value="index.php?view=addproduct.php">ADD PRODUCT </option>		
	<option value="index.php?view=adduser.php">ADD USER </option>		
	<option value="index.php?view=addcountry.php">ADD COUNTRY </option>
	<option value="index.php?view=addstate.php">ADD STATE </option>		
</select>