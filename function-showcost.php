<?php
	include('function-connect.php');

	//showCost()
	$shopid = $_GET['shopid'];
	$date = $_GET['date'];

	$product = 0;
	$dynamic = 0;
	$extra = 0;
	$refund = 0;
	$total = 0;

	//soldrecord
	$query_soldrecord = "SELECT Barcode, SoldQTY FROM SoldRecord WHERE ShopID = '".$shopid."' and Date = '".$date."' ";
	$result_soldrecord = mysqli_query($dbconn,$query_soldrecord);

	echo "
		<div id='dailyinputtable-fix'>
			<h2>Product Cost</h2>
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
					<td>Cost Subtotal</td>
				</tr>
		";

		while($row = mysqli_fetch_array($result_soldrecord)){
			$barcode = $row['Barcode'];
			$qty = $row['SoldQTY'];

			$query_product = "SELECT ProductName, Cost FROM Product WHERE Barcode = '".$row['Barcode']."' ";
			$result_product = mysqli_query($dbconn,$query_product);
			while($row = mysqli_fetch_array($result_product)){
				$productname = $row['ProductName'];
				$cost = $row['Cost'];
			}


			echo "
				<tr>
					<td><input type='text' disabled value='".$barcode."'></td>
					<td><input type='text' disabled value='".$productname."'></td>
					<td><input type='text' disabled value='".$qty."'></td>
					<td><input type='text' disabled value='".$qty*$cost."'></td>
				</tr>
			";

			$product = $product + $qty*$cost;
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
	$query_refund = "SELECT Barcode, ProductName, RefundQTY, Cost FROM RefundRecord NATURAL JOIN Product WHERE ShopID = '".$shopid."' and Date = '".$date."' ";
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
					<td>Cost Subtotal</td>
				</tr>
		";

		while($row = mysqli_fetch_array($result_refund)){
			echo "
				<tr>
					<td><input type='text' disabled value='".$row["Barcode"]."'></td>
					<td><input type='text' disabled value='".$row["ProductName"]."'></td>
					<td><input type='text' disabled value='".$row["RefundQTY"]."'></td>
					<td><input type='text' disabled value='".$row["RefundQTY"]*$row["Cost"]."'></td>
				</tr>
			";

			$refund = $refund + $row["RefundQTY"]*$row["Cost"];
		}

		echo "
				</table>
		";

	}

	echo"
		</div>
	";

	


	$total = $product - $refund;

	echo "
		<div class='section'>
			<hr>
			<input type='submit' value='Product Cost' class='input-button basic-button'>
			<input type='text' class='date input-text' value='".$product."'>

			<input type='submit' value='Refund' class='input-button basic-button'>
			<input type='text' class='date input-text' value='".$refund."'>

			<div class='gap'></div>

			<input type='submit' value='Total Cost' class='input-button basic-button'>
			<input type='text' class='date input-text' value='".$total."'>

		</div>
	";
?>