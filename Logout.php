<?php 

/*****************************************
 *** Author: Konstantina Panagiotopoulou *
 *** May 2013 							 *
 *****************************************							
 **/
 
session_start();
	
		unset($_SESSION['email']);
	
		unset($_SESSION['pass']);
	
		unset($_SESSION['cart']);
	
		unset($_SESSION['formSelect']);
	
		unset($_SESSION['phrase']);
	
		unset($_SESSION['bookid']);
session_destroy();
?>

	  
<!DOCTYPE html>
<html>
<head>
        <title>Logout</title>
</head>

<body bgcolor= "#CED8F6">
		<br><br>

	<script>
	function logout() 
	{ 
		$_SESSION = array();  
		session_destroy();  
     
		echo "    <script language='Javascript'>            <window.close();>    "//--> "
	</script>
	<img src="bookstack.jpg" align="right" height="590" width="200">
<strong> <font face='verdana' size='3' color='blue' ><div align='center'>BYE BYE! See you next time!</div></font></strong>

</body>
</html>
