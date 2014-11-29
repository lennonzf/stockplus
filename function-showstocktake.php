<?php
	include('function-connect.php');

	//showStocktake()
	$shopid = $_GET['shopid'];
	$totalqty = 0;
	$total = 0;

	//Shop Stock
	$query_stock = "SELECT * FROM ShopStock WHERE ShopID = '".$shopid."' ";
	$result_stock = mysqli_query($dbconn,$query_stock);

	echo "
		<div id='dailyinputtable-fix'>
			<h2>Shop Stocktake</h2>
	";

	if(mysqli_num_rows($result_stock) == 0){
		echo "There is no product in this shop";
	} else {
		echo "
				<table>
					<tr>
					<td>Name</td>
					<td>Price</td>
					<td>QTY</td>
					<td>Subtotal</td>
					<td>Check</td>
					<td>Note</td>
				</tr>
		";

		while($row = mysqli_fetch_array($result_stock)){
			$barcode = $row['Barcode'];
			$qty = $row['ShopQTY'];

			$query_product = "SELECT ProductName, Price FROM Product WHERE Barcode = '".$row['Barcode']."' ";
			$result_product = mysqli_query($dbconn,$query_product);

			while($row = mysqli_fetch_array($result_product)){
				$productname = $row['ProductName'];
				$price = $row['Price'];
			}

			echo "
				<tr>
					<td><input type='text' disabled value='".$productname."'></td>
					<td><input type='text' disabled value='".$price."'></td>
					<td><input type='text' disabled value='".$qty."'></td>
					<td><input type='text' disabled value='".$price*$qty."'></td>
					<td><input type='text' value='' width=''></td>
					<td><input type='text' value=''></td>
				</tr>
			";

			$totalqty = $totalqty + $qty;
			$total = $total + $price*$qty;
		}

		echo "</table>";
	}

	echo "</div>";

	echo "
		<div class='section'>
			<hr>
			<input type='submit' value='Total QTY' class='input-button basic-button'>
			<input type='text' class='date input-text' value='".$totalqty."'>

			<input type='submit' value='Subtotal' class='input-button basic-button'>
			<input type='text' class='date input-text' value='".$total."'>

			<input type='submit' value='Sign' class='input-button basic-button'>
			<input type='text' class='date input-text' value=''>
		</div>
	";
?>