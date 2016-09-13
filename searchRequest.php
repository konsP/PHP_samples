<?php

/*****************************************
 *** Author: Konstantina Panagiotopoulou *
 *** May 2013 							 *
 *****************************************							
 **/
 
session_start();//Continue the session.
if (isset($_SESSION['email']) && isset( $_SESSION['pass'])) //Check if the session is registered.
{
      
?>
<!DOCTYPE  HTML > 
	<html> 
	  <head> 
	    <meta  http-equiv="Content-Type" content="text/html;  charset=iso-8859-1"> 
	    <title>Search  </title> 
	  </head> 
	  <p><body bgcolor = "#CED8F6"> 
	  <!--Display customers email -->
	  <!-- On pressing logout displays alert message-->
		<strong> <font face='verdana' size='1' color='blue' ><div align='right'> <u>user: <?php echo $_SESSION['email'] ?></u><input  type="button" value="Logout" onclick="if (confirm('Are you sure you want to Logout?')) window.location.href='Logout.php';" ></div></font></strong>
		
		
	    <h3 align="center" color='blue'>Search  a book</h3> 
	    <p> <div align="center">You  may search either by title, author or topic</p> 
		<form  method="post" action="searchResults.php"  OnSubmit="return CheckForm()"> 
		
			<p>What are you looking for?
			<select name="formSelect" size="1"><br><br/>
			<option value="BLANC">Select by...</option>
			<option value="I_TITLE">Title</option>
			<option value="I_A_ID">Author</option>
			<option value="I_SUBJECT">Topic</option>
			</select>	
			</p>
			
			<br><?php echo $var->errorMessage1;?><br>		  
			<input  type="text" name="phrase"> <br></br>
			<input  type="submit" name="submit" value="Search"> 
			</div>
			
			<script language=javascript type="text/javascript">

			<!-- Script that checks if the search form is properly filled out -->
			function CheckForm()
			{ 
				if ( document.forms[0].formSelect.options[document.forms[0].formSelect.selectedIndex].value=='BLANC')<!-- Select form is empty-->
				{ 
					alert("Please enter a search criterion.");
					document.forms[0].formSelect.focus(); 
					return false;
				}
				if (document.forms[0].phrase.value == '')<!-- Search value is empty-->
				{ 
					alert("Please enter a search phrase.");
					document.forms[0].phrase.focus();
					return false;
				}				
				return true;
			}

			</script>
			

	    </form> 
	  </body> 
	</html> 
	</p> 
	
<?php
	}
?>
