<?php
	session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>Top Right</title>
	<?php echo "<link rel=\"stylesheet\" type=\"text/css\" href=\"/topPage.css\" />"; ?>
	<?php echo "<link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css'>"; ?>
	<?php echo "<link rel=\"stylesheet\" type=\"text/css\" href=\"/Index.css\" />"; ?>
	<script>
	function checkQuantity(){
		var number = document.getElementById("number").value;
		if (number > 20) {
			alert("The number of selected products should less than or equal to 20");
    		return false;			
		} 
		return true;
	}
	</script>
</head>

<body>
	<?php
		if (isset($_REQUEST['product'])) 
		{
			$ID = $_REQUEST['product'];
			$_SESSION["currentID"] = $ID;
			
			$servername = "aag8ec57u4pyur.crrpbnpgjaxt.us-east-1.rds.amazonaws.com";
			$username ="uts";
			$password = "internet";
			$dbname = "assignment1";
			
			$conn = new mysqli($servername, $username, $password, $dbname);
			if ($conn->connect_error) {
				die("Could not connect to Server!" . $conn->connect_error);
			}
			
			$sql = "SELECT * FROM products WHERE (product_id = $ID)";
			$result = mysqli_query($conn, $sql);
			$num_rows = mysqli_num_rows($result);
		
			if ($num_rows > 0 ) {
				
				echo "<table id='customers'>";
				echo "<tr>\n";
				echo "<th>Product ID</th>";
				echo "<th>Product Name</th>";
				echo "<th>Unit Price</th>";
				echo "<th>Unit Quantity</th>";
				echo "<th>In Stock</th>";
				echo "</tr>";
			
			if ( $newRow = mysqli_fetch_array($result))
			{	
				echo "<tr>\n";
				echo "<td>$newRow[product_id]</td>";
				echo "<td>$newRow[product_name]</td>";
				echo "<td>$newRow[unit_price]</td>";
				echo "<td>$newRow[unit_quantity]</td>";
				echo "<td>$newRow[in_stock]</td>";
				echo "</tr>";

				echo "</table>";
	
				$_SESSION["currentProduct"] = $newRow;
				
				echo "<br/>";
				
				echo '
				<div>
				<form action="/bottomPage.php" method="POST" target="bottomPage" onsubmit="return checkQuantity()">
					<b>
					The number of products selected should be between 1 and 20:
					</b>
					&nbsp;
					<input type="number" id="number" name="number" min="1" value="1">
					<input type="submit" value="Add to Cart" class="button">
				</form>
				</div>';
				}
			}
			mysqli_close($conn);
		} 
	
		if( $_REQUEST["showcheckoutForm"] == 1 && (count($_SESSION["goods"]) > 0) )
		{
			require('contactForm.php');
		}
	?>

</body>
</html>