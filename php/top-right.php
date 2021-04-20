<?php
// Start the session
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>Top Right</title>
	<?php echo "<link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css'>"; ?>
	<?php echo "<link rel=\"stylesheet\" type=\"text/css\" href=\"../css/mystyle.css\" />"; ?>
	<?php echo "<link rel=\"stylesheet\" type=\"text/css\" href=\"../css/checkoutform.css\" />"; ?>
	<script>
	function validate_quantity(){
		var quantity = document.getElementById("quantity").value;
		// False
		if (quantity > 20) {
			alert("quantity should less than 20");
    		return false;			
		} 
		return true; mnjknjknjknjknjknjjnnjjnjnjjnjnbbb
	}
	</script>
</head>
<body>

<?php

	if (isset($_REQUEST['data'])) 
	{
		// If receive products ID then, retrive this ID in database
		$ID = $_REQUEST['data'];
	
		// Store current product ID in session;
		$_SESSION["currentID"] = $ID;
		
		//Procedural style
		$connection = mysqli_connect('aara0utiz7uxm9.crrpbnpgjaxt.us-east-1.rds.amazonaws.com:3306', 'uts', 'internet', 'assignment1') or die("Could not connect to Server!");
		$query_string = "select * from products where (product_id = $ID)";
		$result=mysqli_query($connection,$query_string);
		$num_rows=mysqli_num_rows($result);
	
		if ($num_rows > 0 ) {
			
			if ( $a_row = mysqli_fetch_array($result))
			{										
				// talbe 
				echo "<table id='customers'>";
				echo "<tr>\n";
				echo "<th>Product ID</th>";
				echo "<th>Product Name</th>";
				echo "<th>Unit Price</th>";
				echo "<th>Unit Quantity</th>";
				echo "<th>In Stock</th>";
				echo "</tr>";

				echo "<tr>\n";
				echo "<td>$a_row[product_id]</td>";
				echo "<td>$a_row[product_name]</td>";
				echo "<td>$a_row[unit_price]</td>";
				echo "<td>$a_row[unit_quantity]</td>";
				echo "<td>$a_row[in_stock]</td>";
				echo "</tr>";

				echo "</table>";

				$_SESSION["currentProduct"] = $a_row;
				
				echo "<br/>";
				
				echo '
				<div>
				<form action="bottom-right.php" method="get" target="bottom-right" onsubmit="return validate_quantity()">
					<b>
					Quantity (between 1 and 20):
					</b>
					&nbsp;
					<input type="number" id="quantity" name="quantity" min="1" value="1">
					<input type="submit" value="ADD">
				 </form>
				 </div>';
				 
			}
		}
		mysqli_close($link);
	} 
	
	if( $_REQUEST["showcheckoutForm"] == 1 && (count($_SESSION["itmes"]) > 0) )
	{
		require('checkoutform.php');
	}
?>


</body>
</html>

