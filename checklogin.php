<?php

/*****************************************
 *** Author: Konstantina Panagiotopoulou *
 *** May 2013 							 *
 *****************************************							
 **/
 
// Class that checks if the login information given by the user exist in the customers table in the database
session_start();
require_once("dbConnect.php");

class checklogin
{
	//Validation variables.
	public $good;
	public $bad;

	public function  __construct() 
	{
		$good = "";
		$bad = "";
		
		// Email and password posted from the form. 
		$eMail=$_POST['mail']; 
		$pw=$_POST['pw']; 
		
		// Connect to server.
		$conn = new dbConnect();
		print $conn->conerror;
		//Select table.
		$tbl_name="customers"; // Table name
		
		// Protect MySQL injection.
		$eMail = stripslashes($eMail);
		$pw = stripslashes($pw);
		$eMail = mysql_real_escape_string($eMail);
		$pw = mysql_real_escape_string($pw);
		
		//Encrypt password.		
		$salt = 'something random';
		$hash = md5($salt . $pw);
		
		//Query the database.
		$sql="SELECT * FROM $tbl_name WHERE C_EMAIL='$eMail' and C_PASS='$hash'";
		$result=mysql_query($sql);
		
		//Counting table rows returned from query.
		$count=mysql_num_rows($result);
		
		//If result matched email and password,  there must be 1 row
		if($count==1){
			
			$this ->good = "1";
			//Store session variables.
			$_SESSION['email'] = $eMail;
			$_SESSION['pass'] = $pw;
			
		}
		else //No results match the query
		{
			$this->bad = "2";	
			
		}
	}
}

?>
