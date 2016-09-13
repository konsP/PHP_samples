<?php

/*****************************************
 *** Author: Konstantina Panagiotopoulou *
 *** May 2013 							 *
 *****************************************							
 **/

//Displays the details of the selected item.
session_start();
require_once("dbConnect.php");

if (isset($_SESSION['email'])&& isset($_SESSION['pass']))//Checks if the session is registered.
{

// Buttons to the search page and to logout.
?>
<!--Display customers email -->
			<!-- On pressing logout displays alert message-->
			<strong> <font face='verdana' size='1' color='blue' ><div align='right'> <u>user: <?php print $_SESSION['email'] ?></u><input  type="button" value="Logout" onclick="if (confirm('Are you sure you want to Logout?')) window.location.href='Logout.php';" ></div></font></strong>
	
<div align = "right"><input  type="button" value="Shopping cart" onclick= "window.location.href='ShoppingCart.php';" ></div>

<?php
		//The id passed by the previous page.
		$search=$_GET["id"];
		//Session data.
		$_SESSION['bookid'] = $search;
		
		//Connect  to the database.		
		$conn = new dbConnect();
		print $conn->conerror;
		
		//Protect MySQL injection 
		$search = stripslashes($search);
		$search = mysql_real_escape_string($search);
		
		//Query the database usind the book's id.	
		$sql="SELECT  * FROM items WHERE I_ID LIKE '%" .$search."%'   "; 
	
		$result=mysql_query($sql); 
		
		//No result is returned
		if (false === $result) 
		{
			echo mysql_error();
			
		}
		else{
		while ($row=mysql_fetch_assoc($result))
		{
			//Read back the results.
			$title  =$row['I_TITLE']; 
			$id=$row['I_ID']; 
	        $authorID=$row['I_A_ID']; 
			$publisher=$row['I_PUBLISHER']; 
			$subject = $row['I_SUBJECT']; 
			$cost=$row['I_COST']; 
			$stock=$row['I_STOCK']; 
			$pic = $row['I_IMAGE'];
			
			//Search for the authors name
			
			//Protect MySQL injection 
			$authorID = stripslashes($authorID);
			$authorID = mysql_real_escape_string($authorID);
		
			//Query the database usind the book's id.	
			$sql="SELECT  * FROM author WHERE A_ID =$authorID "; 
	
			$result=mysql_query($sql); 
		
			//No result is returned
			if (false === $result) 
			{
				echo mysql_error();
			
			}
			else{
			while ($row=mysql_fetch_assoc($result))
			{
				$afname =$row['A_FNAME'];	//Author's first name
				$alname = $row['A_LNAME']; //Author's last name
			}
			}
			  
			//Display the results of the query for the specified item.
			
			print "<table width='600' border='0' cellpadding='3' cellspacing='1' bgcolor='#CED8F6' align='center'>";
			print '<td><div ><img src="data:image/jpeg;base64 ,' . base64_encode( $pic ) . '" width="90" /></div></td>';
			print "<td> <strong> <font face='verdana' size='2' color='red' > Book ID: </font></strong><font face='verdana' size='2'> "    .$id . "</font><br>";
			print "<strong> <font face='verdana' size='2' color='red' >Title: </font></strong><font face='verdana' size='2'> "  .$title . "</font><br>";
			print "<strong> <font face='verdana' size='2' color='red' >Author: </font></strong><font face='verdana' size='2'> "   .$afname . "  " . $alname. "</font><br>";
			print "<strong> <font face='verdana' size='2' color='red' >Publisher: </font></strong><font face='verdana' size='2'> "   .$publisher . "</font><br>";
			print " <strong> <font face='verdana' size='2' color='red' >Topic: </font></strong><font face='verdana' size='2'> "   .$subject . "</font><br>";
			print "<strong> <font face='verdana' size='2' color='red' >Price (£): </font></strong><font face='verdana' size='2'> "   .$cost . "</font><br>";
			print "<strong> <font face='verdana' size='2' color='red' >No in stock: </font></strong><font face='verdana' size='2'>"   .$stock  . "</font></td>\n";
			print"<td> ";
			
			//Adds a form containing a quantity numeric type, a checkbox and a button for adding to the shopping cart.
			?>
			<form  method="post" action="addToCart.php?action=submit" onSubmit= "return CheckQuantity()">
			<p><font face="verdana" size="2"> Select quantity</font></p>
			<p><input  type="text" name="quant" value="1" maxlength="3" size="3"> </p>
			<input type="checkbox" name="replace" value="ON">Replace<br>
			<input  type="submit" value="Add to cart" name= "Add to cart">
			</form>
			<?php
			print"</td>";			
			print"</table>";
			
		}
	}

?>
	  
<!DOCTYPE html>
<html>
<head>
        <title>Book details</title>
</head>

<body bgcolor= "#CED8F6">
<br><br>
<!--Button to the search page-->
<div align = "center"><input  type="button" value="Search again" onclick= "window.location.href='searchRequest.php';" ></div> 

<script language=javascript type="text/javascript">

<!--Script that checks that all the fields are correctly filled out -->
			function CheckQuantity()
			{ 
				
				if (isNaN(document.forms[0].quant.value))<!--Quantity value -->
				{ 
					alert("Please enter valid quantity");
					document.forms[0].quant.focus();
					return false;
				}
				return true;
			}
			</script>
</body>
</html>
<?php
}
?>

