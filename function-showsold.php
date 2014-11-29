<?php
	include('function-connect.php');

	//showSold()
	$shopid = $_GET['shopid'];
	$date = $_GET['date'];

	$product = 0;
	$refund = 0;
	$turnover = 0;

	//soldrecord
	$query_soldrecord = "SELECT Barcode, SoldQTY FROM SoldRecord WHERE ShopID = '".$shopid."' and Date = '".$date."' ";
	$result_soldrecord = mysqli_query($dbconn,$query_soldrecord);

	echo "
		<div id='dailyinputtable-fix'>
			<h2>Product Sale</h2>
	";

	if(mysqli_num_rows($result_soldrecord) == 0){
			
		echo "There was no record on this day";

	} else {

		echo "
				<table>
					<tr>
					<td>Barcode</td>
					<td>Product Name</td>
					<td>QTY</td>
					<td>Subtotal</td>
				</tr>
		";

		while($row = mysqli_fetch_array($result_soldrecord)){
			$barcode = $row['Barcode'];
			$qty = $row['SoldQTY'];

			$query_product = "SELECT ProductName, Price FROM Product WHERE Barcode = '".$row['Barcode']."' ";
			$result_product = mysqli_query($dbconn,$query_product);
			while($row = mysqli_fetch_array($result_product)){
				$productname = $row['ProductName'];
				$price = $row['Price'];
			}


			echo "
				<tr>
					<td><input type='text' disabled value='".$barcode."'></td>
					<td><input type='text' disabled value='".$productname."'></td>
					<td><input type='text' disabled value='".$qty."'></td>
					<td><input type='text' disabled value='".$qty*$price."'></td>
				</tr>
			";

			$product = $product + $qty*$price;
		}

		echo "
				</table>
		";
	}
	
	echo"
		</div>
		<div class='gap'></div>
	";

	//refund
	$query_refund = "SELECT Barcode, ProductName, RefundQTY, Price FROM RefundRecord NATURAL JOIN Product WHERE ShopID = '".$shopid."' and Date = '".$date."' ";
	$result_refund = mysqli_query($dbconn,$query_refund);

	echo "
		<div id='dailyinputtable-fix'>
			<h2>Refund</h2>
	";
	
	if(mysqli_num_rows($result_refund) == 0){

		echo "There was no refund record on this day";

	} else {
		echo "
				<table>
					<tr>
					<td>Barcode</td>
					<td>Product Name</td>
					<td>QTY</td>
					<td>Subtotal</td>
				</tr>
		";

		while($row = mysqli_fetch_array($result_refund)){
			echo "
				<tr>
					<td><input type='text' disabled value='".$row["Barcode"]."'></td>
					<td><input type='text' disabled value='".$row["ProductName"]."'></td>
					<td><input type='text' disabled value='".$row["RefundQTY"]."'></td>
					<td><input type='text' disabled value='".$row["RefundQTY"]*$row["Price"]."'></td>
				</tr>
			";

			$refund = $refund + $row["RefundQTY"]*$row["Price"];
		}

		echo "
				</table>
		";

	}

	echo"
		</div>
	";

	$turnover = $product - $refund;

	echo "
		<div class='section'>
			<hr>
			<input type='submit' value='Turnover' class='input-button basic-button'>
			<input type='text' class='date input-text' value='".$turnover."'>
		</div>
	";

?>