<?php

/*****************************************
 *** Author: Konstantina Panagiotopoulou *
 *** May 2013 							 *
 *****************************************							
 **/

//The user's shopping cart.
require_once("cart.php"); //Import cart.php
require_once("dbConnect.php");
session_start();

if (isset($_SESSION['email']) && isset( $_SESSION['pass']))//Checks if session is registered.
{
//Buttons to shopping cart and logout.
?>
<div align = "right"><input  type="button" value="Logout" onclick="if (confirm('Are you sure you want to Logout?')) window.location.href='Logout.php';" ></div>

<?php

	//Retrieves the cart's information.
	$s =  serialize($_SESSION['cart']); 
	$cart = unserialize($s);
	
?>
<!DOCTYPE html>

<html>
 <head>
	<title>Your Shopping Cart </title>
 </head>

<body bgcolor= "#CED8F6">

<p>
</body>
</html>

<?php
if ($cart->items != null) 
	{
	//Calls the show method of the cart class to display the cart's contents.
		$cart->show();
		
		//check stock
		$conn = new dbConnect();
		print $conn->conerror;
		
		$tbl_name="items";
		foreach ($cart->items as $key => $value) 
		{
			// To protect MySQL injection 
			$key = stripslashes($key);
			$key = mysql_real_escape_string($key);
			$sql="SELECT  * FROM $tbl_name WHERE I_ID =' $key '"; 
			//SELECT Company, Country FROM Customers WHERE Country <> 'USA'
			$result=mysql_query($sql); 
			if (false === $result) 
			{
				echo mysql_error();
			}
			else
			{
				while($row=mysql_fetch_array($result))
				{ 
					$stock=$row['I_STOCK']; //epistrefei ari8mo
				}
				if ($stock < $value)
				{
					print  "<div align= 'center'><strong style='color:red;'>Warning: </strong>item :". $key. " exceeds the current stock. You can choose up to " .$stock. " copies. Please change your order!</div><br>";
					
				}
			}
			
			
		}
	}
	else
	{
		//Displays a message to the user to inform that the cart is empty.
		print "<strong><font face='verdana' size='3' color='blue' ><div align='center'>Your shopping cart is empty at the moment.</div></font></strong> ";
	}


?>

<br><br><br><br><br>
<!--Button to the search page -->
<div align="center"><input  type="button" value="Search again" onclick= "window.location.href='searchRequest.php';"></div>

<?php
}
?>
