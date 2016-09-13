<?php

/*****************************************
 *** Author: Konstantina Panagiotopoulou *
 *** May 2013 							 *
 *****************************************							
 **/

//Registration page.
//Provides the interface for a new user to give details.

session_start();

	if($_GET["action"] == "submit")
    {	
		//Imports the file Registration.php
        require_once("Registration.php");
		
		//Calls the constructor of the class Registration.
        $reg = new Registration();
		
		//Validation variable.
		$welcome = false;
		
		if($reg->ok == "true")
		{
			$welcome = true;	
		}  
			
    }
	

?>
<!DOCTYPE html>
<html>
<head>
        <title>New customer</title>

</head>
	<body bgcolor= "#CED8F6">
	<img src="bookstack.jpg" align="right" height="600" width="200">
		<table width="400" border="0" align="center" cellpadding="0" cellspacing="1" bgcolor="#FFFFFF">
		<tr>
			<form action="register.php?action=submit" method="POST" OnSubmit="return CheckFields()"> 
			<td>
				<table width="100%" border="0" cellpadding="3" cellspacing="1" bgcolor="#FFFFFF" align="center">
				<tr>
					<td colspan="3" align="center"><strong style='color:blue;'><font face='Georgia, Arial, Garamond' size = '2'>Customer Registration </font></strong></td>
				</tr>
				<tr>
					<label><td width="100" ><font face='verdana' size='2'>E-mail address </font></td></label><td width="294"><input type="text" name="mail"/></td><br/>
				</tr>
				<tr>
					<label><td width="100"><font face='verdana' size='2'>First name</font></td></label><td width="294"><input type="text" name="fName"/></td><br/>
				</tr>
				<tr>
					<label><td width="100"><font face='verdana' size='2'>Last name</font></td></label><td width="294"><input type="text" name="lName"/></td> <br/>
				</tr>
				<tr>
					<label><td width="100"><font face='verdana' size='2'>Address</font></td></label><td width="294"><textarea name="address"></textarea></td><br/>
				</tr>
				<tr>
					<label><td width="100"><font face='verdana' size='2'>Password</font></td></label><td width="294"><input type="password" name="pw"/></td><br/>
				</tr>
				<tr>
					<label><td width="100"><font face='verdana' size='2'>Repeat Password</font></td></label><td width="294"><input type="password" name="pwrepeat"></td><br/>
				</tr>
				<tr>
					<td>&nbsp;</td>
					<td>
					<div align="right"><input type="submit" value="Register"/></div><br/>
					</td>
				</tr>
				</table>
				
				
				<script language=javascript type="text/javascript">

			<!--Script that checks that all the fields are correctly filled out -->
			function CheckFields()
			{ 
				
				if (document.forms[0].mail.value == '')<!--Email field is empty -->
				{ 
					alert("Please enter an e-mail address.");
					document.forms[0].mail.focus();
					return false;
				}
				if (document.forms[0].fName.value == '')<!--First name field is empty -->
				{ 
					alert("Please enter your first name.");
					document.forms[0].fName.focus();
					return false;
				}
				if (document.forms[0].lName.value == '')<!--Last name field is empty -->
				{ 
					alert("Please enter your last name.");
					document.forms[0].lName.focus();
					return false;
				}
				if (document.forms[0].address.value == '')<!--Address field is empty -->
				{ 
					alert("Please enter a postal address.");
					document.forms[0].address.focus();
					return false;
				}
				if (document.forms[0].pw.value == '')<!--Password field is empty -->
				{ 
					alert("Please enter a password.");
					document.forms[0].pw.focus();
					return false;
				}
				if (document.forms[0].pwrepeat.value == '')<!--Password repeat field is empty -->
				{ 
					alert("Please re-enter your password.");
					document.forms[0].pwrepeat.focus();
					return false;
				}
				if (document.forms[0].pwrepeat.value != document.forms[0].pw.value)<!--Passwords do not match -->
				{ 
					alert("Passwords don't match.");
					document.forms[0].pw.focus();
					return false;
				}
				if(!ValidateEmail(document.forms[0].mail.value))<!-- The email does not have the right format-->
				{
				return false;
				}
				return true;
				
			}
			function ValidateEmail(mail) <!--Uses a reqular expression to check the given email address -->
			{
				if (/^([0-9a-zA-Z]([-\.\w]*[0-9a-zA-Z])*@([0-9a-zA-Z][-\w]*[0-9a-zA-Z]\.)+[a-zA-Z]{2,9})$/.test(document.forms[0].mail.value))
				{
					return true;
				}
				else
				{
				alert("Please enter a valid email address.")
					return (false)
				}
			
			}

			</script>
			</form>
		</tr>
		</table>
	</body>
</html>
<?php

		
if($welcome)
{	
	print "<div align = 'left'><strong style='color:red;'>You have successfully signed up!!</strong></div>";
	print "<br><br>";
	print "<input  type='button' value='Search a book' align='right' onclick= 'window.location.href=\"searchRequest.php\"' ></td>";
}
?>


