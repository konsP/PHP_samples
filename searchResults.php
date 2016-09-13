<?php

/*****************************************
 *** Author: Konstantina Panagiotopoulou *
 *** May 2013 							 *
 *****************************************							
 **/

//Implements the search in the database for books matching the search criteria.
session_start();
require_once("dbConnect.php"); //Imports dbConnect.php


if (isset($_SESSION['email']) && isset($_SESSION['pass'] )) //Checks if the session is registered
{


		//Search criteria posted from the form.
		$select =$_POST['formSelect'];
		$phrase = $_POST['phrase'];
		// Checks if the search phrase is a valid set of characters using a regular expression.
		if(preg_match("/^[  a-z| A-Z |0-9]+/", $phrase)){ 
		
			//Connect  to the database.
			$conn = new dbConnect();
			echo $conn->conerror;
		
		
			if ($select == 'I_A_ID') //If the search criterion is the author's last name.
			{
			
				//Protect MySQL injection.
				$phrase = stripslashes($phrase);
				$phrase = mysql_real_escape_string($phrase);
				
				//Query  the database.
				$sql="SELECT  * FROM author WHERE A_LNAME LIKE '%" . $phrase .  "%'"; 
				$result=mysql_query($sql);
				//Error in database
				if (false === $result) 
				{
					echo mysql_error();
				}
				else //Valid result
				{
					while($row=mysql_fetch_array($result))
					{ 
			
						$auth=$row['A_ID']; //The returned value is the author's id.
					}
					//Protect MySQL injection 
					$auth = stripslashes($auth);
					$auth = mysql_real_escape_string($auth);
					
					//Query  the database items table using the author's id.
					$sql="SELECT  * FROM items WHERE I_A_ID LIKE '%" . $auth .  "%'"; 
				}
		 
			}
			else //If the search criterion is either a title or a topic.
			{
				//Protect MySQL injection.
				$phrase = stripslashes($phrase);
				$phrase = mysql_real_escape_string($phrase);
				
				//Query  the database.
				$sql="SELECT  * FROM items WHERE $select LIKE '%" . $phrase .  "%'"; 
			}
	  
			$result=mysql_query($sql); 
		
			//Logout button
			?>
			<!--Display customers email -->
			<!-- On pressing logout displays alert message-->
			<strong> <font face='verdana' size='1' color='blue' ><div align='right'> <u>user: <?php echo $_SESSION['email'] ?></u><input  type="button" value="Logout" onclick="if (confirm('Are you sure you want to Logout?')) window.location.href='Logout.php';" ></div></font></strong>
	
			<?php
			//Error in connection
			if (false === $result) 
			{
				echo mysql_error();
			
			}
			else //Valid result.
			{
	  
				if (!$row=mysql_fetch_assoc($result))//The query returns nothing.
				{
					print"<strong><font face='verdana' size='3' ><div align='center'> There where no results matching you search...</div></font></strong>";
				}
				else //The query returns matching items.
				{
					print"<strong> <font face='verdana' size='3'><div align='center'> The following results match you search...</div></font></strong><br><br>";
					// prints the first result
					$title  =$row['I_TITLE']; 
					$id=$row['I_ID']; 
				 
					//Display the 1st result of the query. (book id & title)
					print "<table width='800' border='0' cellpadding='3' cellspacing='1' bgcolor='#CED8F6' align='center'>";
					print "<td><strong style='color:red;'>Book ID: </strong> "    .$id . "</td>";
					print "<td><strong style='color:red;'>Title: </strong> "  .$title . "</td>";
					//Display a button to redirect to the details of the item.
					print "<td><input  type='button' value='See details' onclick= 'window.location.href=\"productDetails.php?id=$id\"' ></td>";
				
		
					//Display the following results of the query. (book id & title)
					while($row=mysql_fetch_array($result))
					{ 
						$title  =$row['I_TITLE']; 
						$id=$row['I_ID']; 
					
					
						print "<tr>";
						print " <td><strong style='color:red;'> Book ID: </strong> "    .$id . "</td>";
						print "<td><strong style='color:red;'>Title: </strong> "  .$title . "</td>";

						//Display a button to redirect to the details of the item and passes the value of the book id to the next page.
						print "<td><input  type='button' value='See details' onclick= 'window.location.href=\"productDetails.php?id=$id\"' ></td>";
						print "</tr>";
	  
					} 
					print "</table>";
				}
			}
		}
		else
		{
			print"<strong><font face='verdana' size='3' ><div align='center'> There where no results matching you search...</div></font></strong>";
		}


?>
<!DOCTYPE html>
<html>
<head>
        <title>Search results</title>
</head>
<body bgcolor= "#CED8F6">

<br><br><br><br><br><br>
<div align = "center"><input  type="button" value="Search again"  onclick= "window.location.href='searchRequest.php';" ></div>

</body>
</html>

<?php
}
?>
