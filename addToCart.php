<?php

/*****************************************
 *** Author: Konstantina Panagiotopoulou *
 *** May 2013 							 *
 *****************************************							
 **/

//Adds the product to the user's shopping cart and returns a confirmation messsage.

require_once("cart.php");//Import cart.php
session_start();
if (isset($_SESSION['email']) && isset( $_SESSION['pass'])) //Checks if the session is registered.
{
//Shopping cart and Logout buttons.
?>
<!--Display customers email -->
<!-- On pressing logout displays alert message-->
<strong> <font face='verdana' size='1' color='blue' ><div align='right'> <u>user: <?php print $_SESSION['email'] ?></u><input  type="button" value="Logout" onclick="if (confirm('Are you sure you want to Logout?')) window.location.href='Logout.php';" ></div></font></strong>
<!--Display button to shopping cart -->	
<div align = "right"><input  type="button" value="Shopping cart" onclick= "window.location.href='ShoppingCart.php';" ></div>

<?php


	if (!isset($_SESSION['cart'])) //Checks if a cart is associated to the user's session.
	{ 
		$cart = new Cart(); //If no cart exists, calls the constructor of the cart class to create one.
	}
	else
	{	
		//Retrieves the cart's information from the session variable.
		$s =  serialize($_SESSION['cart']); 
		$cart = unserialize($s);
	}
	
	//Quantity value posted from the form in the previous page.
	$q=$_POST['quant'];
	
	//Check value posted from the form in the previous page.
	$check = $_POST['replace'];
	
	//Checks if the "replace" variable is ON
	if($check =="ON")
	{
		$replace = 1;
	}
	else
	{
		$replace = 0;
	}
	//Calls the add_item method of the cart class, to add the item with the given id and given quantity to the shopping cart.
	$cart->add_item($_SESSION['bookid'], $q, $replace);
	
	
	
	//Displays a confirmation message.
	if ($cart != null) 
	{
		if($check =="ON") //Checkbox is checked.
		{
		// Prints updated cart confirmation message.
		print"<strong> <font face='verdana' size='3' color='blue' ><div align='center'>Your shopping cart was successfully updated!</div></font></strong><br><br>";  
		}
	else
	{
		if ($q == 1)
		{
			//Prints item added message for one item.
			print"<strong> <font face='verdana' size='3' color='blue' ><div align='center'>". $q . " copy of the item with ID " . $_SESSION['bookid']." was successfully added to your shopping cart!</div></font></strong><br><br>";  

		}
		else
		{
			//Prints item added message for more than one item.
			print"<strong> <font face='verdana' size='3' color='blue' ><div align='center'>". $q . " copies of the item with ID " . $_SESSION['bookid']." were successfully added to your shopping cart!</div></font></strong><br><br>";  
		}
	}
	}
	
	//Stores the updated cart.	
	$_SESSION['cart'] = $cart;
	


?>

<!DOCTYPE html>
<html>
 <head> 
 <title> Item added </title>
 </head>
<body bgcolor = "#CED8F6"> 
	<!-- Button to the search page.-->
	<div align="center"><input  type="button" value="Search again" onclick= "window.location.href='searchRequest.php';" ></div>
</body>
</html>

<?php
}
?>
