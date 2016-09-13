<?php

/*****************************************
 *** Author: Konstantina Panagiotopoulou *
 *** May 2013 							 *
 *****************************************							
 **/

//Removes the product from the user's shopping cart and returns a confirmation messsage.

require_once("cart.php");//Import cart.php
session_start();

if (isset($_SESSION['email']) && isset( $_SESSION['pass'])) //Checks if the session is registered.
{
?>
<!--Display customers email -->
<!-- On pressing logout displays alert message-->
<strong> <font face='verdana' size='1' color='blue' ><div align='right'> <u>user: <?php print $_SESSION['email'] ?></u><input  type="button" value="Logout" onclick="if (confirm('Are you sure you want to Logout?')) window.location.href='Logout.php';" ></div></font></strong>
<!--Display button to the shopping cart -->	
<div align = "right"><input  type="button" value="Shopping cart" onclick= "window.location.href='ShoppingCart.php';" ></div>

<?php

		
	//Retrives the carts information from the session variable.
	$s =  serialize($_SESSION['cart']); 
	$cart = unserialize($s);
	
	
	//Gets the book id posted from the form.
	$b =$_GET['book'];
	//Calls unset_item method of the cart.
	$cart->unset_item($b); 
	
	
	
	//Displays a confirmation message.
	print"<strong> <font face='verdana' size='3' color='blue' ><div align='center'>Item: ".$b." was removed from your shopping cart!</div></font></strong><br><br>";  

	// Prints updated cart confirmation message.

	print"<strong> <font face='verdana' size='3' color='blue' ><div align='center'>Your shopping cart was successfully updated!</div></font></strong><br><br>";  
	
	//Stores the updated cart.	
	$_SESSION['cart'] = $cart;



?>

<!DOCTYPE html>
<html>
 <head> 
 <title> Item Removed </title>
 </head>
<body bgcolor = "#CED8F6"> 
	<!-- Button to the search page.-->
	<div align="center"><input  type="button" value="Search again" onclick= "window.location.href='searchRequest.php';" ></div>
	
	
</body>
</html>

<?php
}
?>
