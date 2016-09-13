<?php

/*****************************************
 *** Author: Konstantina Panagiotopoulou *
 *** May 2013 							 *
 *****************************************							
 **/
 
//Class that implements the connection to the server and the database.
class dbConnect
{
	public $conerror;

	public function  __construct()
	{
		$host=""; // add your host's name 
		$username=""; // add your Mysql username 
		$password=""; // add your Mysql password 
		$db_name=""; // add your database's name 
		
		
		// Connect to server and select databse.
		$con = mysql_connect("$host", "$username", "$password"); 
		if (!$con)
		{
			die("Could not connect:" . mysql_error());
			$this -> conerror = 'Could not connect:' . mysql_error();
		}
		mysql_select_db("$db_name", $con)or die("cannot select DB");

	}
	
}	
?>
