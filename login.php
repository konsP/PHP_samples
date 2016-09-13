<?php

/*****************************************
 *** Author: Konstantina Panagiotopoulou *
 *** May 2013 							 *
 *****************************************							
 **/

//Login page
session_start();

       if($_GET["action"] == "submit")
       {
		//import the file checklogin.php to check the user's credentials
		require_once("checklogin.php");
		//call the constructor of the class checklogin
        $reg = new checklogin();
		//validation variable
		$wrong = false;
		if($reg->good == "1") //if everything is ok with the login
		{			
			header('Location: welcome.php'); //redirect to the welcome page
			
			// store session data
			echo $_SESSION['email'];
			echo $_SESSION['pass'];
		}	
		if($reg->bad == "2") //Login info do not match any entry in the database
		{
			$wrong = true;			
		} 
       }
?>
<!DOCTYPE html>
<html>
<head>
        <title>Login</title>
</head>
<body bgcolor = "#CED8F6">
<img src="bookstack.jpg" align="right" height="600" width="200">
	<table width="350" border="0" align="center" cellpadding="0" cellspacing="1" bgcolor="#CCCCCC">
	<tr>
		<form name="form1" method="post" action="login.php?action=submit">  
		<td>
		<table width="100%" border="0" cellpadding="3" cellspacing="1" bgcolor="#FFFFFF">
			<tr>
				<td colspan="3" align = "center"><strong style='color:blue;'><font face='Georgia, Arial, Garamond' size = '2'>Customer Login </font></strong></td>
			</tr>
			<tr>
				<td width="100"><font face='verdana' size='2'>Email address</font></td><td width="6">:</td><td width="294"><input name="mail" type="text" id="mail"></td>
			</tr>
			<tr>
				<td width="100"><font face='verdana' size='2'>Password</font></td><td>:</td><td><input name="pw" type="password" id="pw"></td>
			</tr>
			<tr>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td><div align="right"><input type="submit" name="Submit" value="Login"></div></td>
			</tr>
		</table>
		</td>
		</form>
	</tr>
	</table>
</body>
</html>

<?php
if ($wrong) 
{
?>
<script>// Alert message to the user
function checkCredentials()
{
alert("Wrong email address or password! \nPlease try again!"); 
}
</script>
<head>
</head>
<body onload ="checkCredentials()"> <!--Call the script on loading the HTML -->
</body>


<?php
}
?>
