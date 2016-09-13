<?php

/*****************************************
 *** Author: Konstantina Panagiotopoulou *
 *** May 2013 							 *
 *****************************************							
 **/
 
session_start();
require_once("dbConnect.php");
class Registration
{
	//Validation variable
	public $ok;
	
    public function  __construct() //Constructor of the class Registration
	{
		//Variables posted from the form
		$fName = $_POST["fName"];
		$lName = $_POST["lName"];
		$eMail = $_POST["mail"];
		$addrr = $_POST["address"];
		$pw = $_POST["pw"];
		$pw2 = $_POST["pwrepeat"];
		
		//error checking
		$error = false;
		$ok = "";

			
		// Connect to the database.
		$conn = new dbConnect();
		print $conn->conerror;
		
		$tbl_name="customers";// Table name 
			
		//Encrypt password
		$salt = 'something random';
		$hash = md5($salt . $pw);
			
		//Insert to the customers table.
		$sql="INSERT INTO $tbl_name (C_FNAME, C_LNAME, C_EMAIL, C_PASS, C_ADD)
			VALUES( '$fName' ,'$lName', '$eMail', '$hash', '$addrr' )";
		//Error to the connection
		
		$result=mysql_query($sql); 
		if (false === $result) 
		{
			echo mysql_error();
		}
		else
		{
		
			$this->ok = "true";
			//Store session data.
			$_SESSION['email'] = $eMail;
			$_SESSION['pass'] = $pw;
		
		}
		
	}
}

?>
	
