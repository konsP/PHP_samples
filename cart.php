<?php
/*****************************************
 *** Author: Konstantina Panagiotopoulou *
 *** May 2013 							 *
 *****************************************							
 **/

//Class that implements the Cart and its methods.
session_start();
if (isset($_SESSION['email']) && isset( $_SESSION['pass']))
{

	//Interface for a general collection
	interface MyCollection 
	{
		function add_item($artnr, $num, $flag);
		function remove_item($artnr, $num);
		function show ();
	}

	class Cart implements MyCollection 
	{
	
		
		var $items;
		var $debug = false;
		var $verbose = true;
		var $replace = false;
		//Static properties and a tailored constructor method
		static $nr = 1; 
		public $id;
			

		//Constructor for this class
		function __construct()
		{
		
			$this->id = self::$nr;
			self::$nr++;
		}

		//Method that adds an item to the cart's array.
		//If the items id already exists, then increases its quantity by a given value.
		//If the boolean value is true, then it first deletes the books entri in the array and adds it with the new value.
		function add_item($artnr, $num, $add_flag) 
		{
			if($add_flag == 1)
			{
				//Deletes the entry from the array.
				unset($this->items[$artnr]);
			}
   
			$this->items[$artnr] += $num;
		}
		//Method that removes an item from the cart's array.
		function remove_item($artnr, $num) 
		{
   
			if (!array_key_exists($artnr, $this->items)) 
			{
				if ($this->debug) 
				{
					echo "<P>Warning: Trying to remove non existing item $artnr<br>\n";
				}
				return false;
			}
			if ($this->items[$artnr] > $num) 
			{
				$this->items[$artnr] -= $num;
				return true;
			} 
			else if ($this->items[$artnr] == $num)
			{
				unset($this->items[$artnr]); // remove key from the array
				return true;
			} else 
			{
				return false;
			}
		}
		//Method that removes an item from the cart
		function unset_item($artnr) 
		{
			unset($this->items[$artnr]);// remove key from the array
		}

		//Function that displays the contents of the array.
		function show () {

		?>

		<table width='250' border='0' cellpadding='3' cellspacing='1' bgcolor='#CED8F6' align='center'>
			<th><strong> <font face='verdana' size='2' color='blue' >Item ID</font></strong></th><th><strong><font face='verdana' size='2' color='blue'>Quantity</font></strong></th><th>  </th><tr>
	
			<?php foreach ($this->items as $key => $value) : ?>
			
			<td> <?php print"<strong><div align ='center'><font face='verdana' size='2'>". $key ."</font></div></strong>" ?> </td> <td> <?php print "<div align ='center'><font face='verdana' size='2'>" .$value ."</font></div>"?></td>
			<td>
			<!-- Displays a "Remove" button and submits the form to removeFromCart.php-->
			<form   method="post" action="removeFromCart.php?book=<?php echo $key?>" >		
			<input  type="submit" value="Remove" name= "Remove">
			</form>
			</td> <tr>
		
		<?php endforeach; ?>

		</table>
	<?php

  }
}
?>



</body>
</html> 
<?php


}
?>
