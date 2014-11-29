<?php
	include('function-connect.php');

	//showRefillList()
	$shopid = $_GET['shopid'];
	$totalqty = 0;
	$total = 0;
	$rownumber = 0;
	$count = 0;

	//Shop Stock
	$query_stock = "SELECT * FROM ShopStock WHERE (SetQTY - ShopQTY) > 0 AND ShopID = '".$shopid."' ";
	$result_stock = mysqli_query($dbconn,$query_stock);

	echo "
		<div id='dailyinputtable-fix'>
			<h2>To be Refilled</h2>
	";

	if(mysqli_num_rows($result_stock) == 0){
		echo "There was no product need to be refilled";
	} else {
		echo "
				<table>
					<tr>
						<td>Name</td>
						<td>Price</td>
						<td>Remain Stock</td>
						<td>To be Refilled</td>
						<td>Refill</td>
						<td>Set Stock</td>
					</tr>
		";

		while($row = mysqli_fetch_array($result_stock)){

			$count = $count + 1;
			
			$rownumber = mysqli_num_rows($result_stock);

			$barcode = $row['Barcode'];
			$remainQTY = $row['ShopQTY'];
			$setQTY = $row['SetQTY'];
			$refillQTY = $row['SetQTY'] - $row['ShopQTY'];

			$query_product = "SELECT ProductName, Price FROM Product WHERE Barcode = '".$row['Barcode']."' ";
			$result_product = mysqli_query($dbconn,$query_product);

			while($row = mysqli_fetch_array($result_product)){
				$productname = $row['ProductName'];
				$price = $row['Price'];
			}

			echo "
				<tr>
					<td><input type='text' value='".$productname."' id='productname".$count."'></td>
					<td><input type='text' disabled value='".$price."'></td>
					<td><input type='text' disabled value='".$remainQTY."'></td>
					<td><input type='text' disabled value='".$refillQTY."'></td>
					<td><input type='text' value='' width='' id='refill".$count."'></td>
					<td><input type='text' value='".$setQTY."' id='setstock".$count."'></td>
				</tr>
			";

			$totalqty = $totalqty + $refillQTY;
			$total = $total + $price*$refillQTY;
		}

		echo "</table>";
	}

	echo "</div>";

	echo "
		<div class='section'>
			<hr>
			<input type='submit' value='Refill' class='input-button hover-button right' onclick=\"refill('".($count+1)."');\">
		</div>
	";
?>