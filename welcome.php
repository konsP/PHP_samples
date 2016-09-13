<?php

/*****************************************
 *** Author: Konstantina Panagiotopoulou *
 *** May 2013 							 *
 *****************************************							
 **/
 
session_start();
require_once("dbConnect.php");

if (isset($_SESSION['email'])&& isset($_SESSION['pass']))
{

		// username  sent from form 
		$eMail=$_SESSION['email']; 
		
		//Print the customer's email
		print "<strong> <font face='verdana' size='1' color='blue' ><div align='right'> <u>user: " .$_SESSION['email'] ."</u></div></font></strong>";
		
		// Connect to the database.
		$conn = new dbConnect();
		print $conn->conerror;
		
		
		
		$tbl_name="customers"; // Table name 
		
		//Protect MySQL injection 
		$eMail = stripslashes($eMail);
		$eMail = mysql_real_escape_string($eMail);
		
		
		
		//Make the query to the customers table.
		$sql="SELECT * FROM $tbl_name WHERE C_EMAIL='$eMail'";
		$result=mysql_query($sql);
		
		//No result is returned.
		if (false === $result) 
		{
			echo mysql_error();
			
		}
		else{ //Valid result is returned.
		while ($row=mysql_fetch_assoc($result))
		{//Retrieve the fields of the entry (customer details)
			$id  =$row['C_ID']; 
			$fname=$row['C_FNAME']; 
	        $lname=$row['C_LNAME']; 
			$email=$row['C_EMAIL']; 
			$pass = $row['C_PASS']; 
			$addr=$row['C_ADD']; 
			//Print the customer details
			print "<strong> <font face='verdana' size='3' color='red' ><div align='center'>Welcome, " .$fname .". Nice to see you again!</div></font></strong><br><br><br>";
			print "<strong><font face='verdana' size='2'><div align='center'>These are your customer details!!</div></font></strong><br><br>";
			print "<table width='300' border='0' cellpadding='3' cellspacing='1' bgcolor='#CED8F6' align='center' >";
			print "<td> <font face='verdana' size='2'> <strong>Customer ID: </strong>  "    .$id . "</font><br>";
			print "<font face='verdana' size='2'><strong>First Name: </strong>  "  .$fname . "</font><br>";
			print "<font face='verdana' size='2'><strong>Last Name: </strong>  "   .$lname . "</font><br>";
			print "<font face='verdana' size='2'><strong>Email Address: </strong>  "   .$email . "</font><br>";
			print "<font face='verdana' size='2'><strong>Postal Address: </strong>  "   .$addr. "</font>";	
			print "</td>";
			print "</table><br><br><br><br>";
		}
		}
		

?>



<!DOCTYPE html>
<html>
<head>
        <title>Customer Details</title>
</head>
<body bgcolor="#CED8F6">
<!-- Button to the search page. -->
<div align="center"><input  type="button" value="Search a book" onclick= "window.location.href='searchRequest.php';" ></div>
</body>
</html>

<?php
}


?>
