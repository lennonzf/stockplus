<?php
	include('function-connect.php');

	//showCost()
	$shopid = $_GET['shopid'];
	$date = $_GET['date'];

	$product = 0;
	$dynamic = 0;
	$extra = 0;
	$total = 0;
	$grossprofit = 0;
	$netprofit = 0;
	$refund = 0;

	//soldrecord
	$query_soldrecord = "SELECT Barcode, SoldQTY FROM SoldRecord WHERE ShopID = '".$shopid."' and Date = '".$date."' ";
	$result_soldrecord = mysqli_query($dbconn,$query_soldrecord);

	echo "
		<div id='dailyinputtable'>
			<h2>Product Profit</h2>
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
					<td>Profit Subtotal</td>
				</tr>
		";

		while($row = mysqli_fetch_array($result_soldrecord)){
			$barcode = $row['Barcode'];
			$qty = $row['SoldQTY'];

			$query_product = "SELECT ProductName, Cost, Price FROM Product WHERE Barcode = '".$row['Barcode']."' ";
			$result_product = mysqli_query($dbconn,$query_product);
			while($row = mysqli_fetch_array($result_product)){
				$productname = $row['ProductName'];
				$profit = $row['Price'] - $row['Cost'];
			}


			echo "
				<tr>
					<td><input type='text' disabled value='".$barcode."'></td>
					<td><input type='text' disabled value='".$productname."'></td>
					<td><input type='text' disabled value='".$qty."'></td>
					<td><input type='text' disabled value='".$qty*$profit."'></td>
				</tr>
			";

			$product = $product + $qty*$profit;
		}

		echo "
				</table>
		";
	}
	
	echo"
		</div>
	";

	//dynamic
	$query_dynamic = "SELECT Labour, Rent, Discount FROM DynamicExpense WHERE ShopID = '".$shopid."' and date = '".$date."' ";
	$result_dynamic = mysqli_query($dbconn,$query_dynamic);
	echo "
		<div id='dailydynamictable'>
			<h2>Dynamic Expense</h2>
	";

	if(mysqli_num_rows($result_dynamic) == 0){
		echo "There was no record on this day";
	} else {
		while($row = mysqli_fetch_array($result_dynamic)){
			echo"
				<table>
					<tr>
						<td>Discount</td>
						<td>Labour</td>
						<td>Rent</td>
					</tr>
					<tr>
						<td><input type='text' id='discount' disabled value='".$row['Discount']."'></td>
						<td><input type='text' id='labour' disabled value='".$row['Labour']."'></td>
						<td><input type='text' id='rent' disabled value='".$row['Rent']."'></td>
					</tr>
				</table>
			";

			$dynamic = $row['Discount'] + $row['Labour'] + $row['Rent'] ;
		}
	}

	echo "
		</div>
	";

	//extra
	$query_extra = "SELECT Item, Cost, Note FROM ExtraExpense WHERE ShopID = '".$shopid."' and date = '".$date."' ";
	$result_extra = mysqli_query($dbconn,$query_extra);

	echo "
		<div id='dailyextratable'>
			<h2>Extra Expense</h2>
	";

	if(mysqli_num_rows($result_extra) == 0){
		echo "There was no record on this day";
	} else {
		echo "

				<table>
					<tr>
						<td>Item</td>
						<td>Cost</td>
						<td>Note</td>
					</tr>
		";

		while($row = mysqli_fetch_array($result_extra)){
			echo "
				<tr>
					<td><input type='text' value='".$row['Item']."' disabled></td>
					<td><input type='text' value='".$row['Cost']."' disabled></td>
					<td><input type='text' value='".$row['Note']."' disabled></td>
				</tr>
			";

			$extra = $extra + $row['Cost'];
		}

		echo "
				</table>

		";
	}

	echo "

		</div>
	";


	//refund
	$query_refund = "SELECT Barcode, ProductName, RefundQTY, Cost, Price FROM RefundRecord NATURAL JOIN Product WHERE ShopID = '".$shopid."' and Date = '".$date."' ";
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
					<td>Profit Subtotal</td>
				</tr>
		";

		while($row = mysqli_fetch_array($result_refund)){
			echo "
				<tr>
					<td><input type='text' disabled value='".$row["Barcode"]."'></td>
					<td><input type='text' disabled value='".$row["ProductName"]."'></td>
					<td><input type='text' disabled value='".$row["RefundQTY"]."'></td>
					<td><input type='text' disabled value='".$row["RefundQTY"]*($row['Price'] - $row["Cost"])."'></td>
				</tr>
			";

			$refund = $refund + $row["RefundQTY"]*($row['Price'] - $row["Cost"]);
		}

		echo "
				</table>
		";

	}

	echo"
		</div>
	";

	$grossprofit = $product - $refund;
	$netprofit = $grossprofit - ($dynamic + $extra);

	echo "
		<div class='section'>
			<hr>
			<input type='submit' value='Product Profit' class='input-button basic-button'>
			<input type='text' class='date input-text' value='".$product."'>

			<input type='submit' value='Refund' class='input-button basic-button'>
			<input type='text' class='date input-text' value='".$refund."'>

			<input type='submit' value='Gross Profit' class='input-button basic-button'>
			<input type='text' class='date input-text' value='".$grossprofit."'>

			<div class='gap'></div>

			
			<input type='submit' value='Dynamic Expense' class='input-button basic-button'>
			<input type='text' class='date input-text' value='".$dynamic."'>

			<input type='submit' value='Extra Expense' class='input-button basic-button'>
			<input type='text' class='date input-text' value='".$extra."'>

			<input type='submit' value='Net Profit' class='input-button basic-button'>
			<input type='text' class='date input-text' value='".$netprofit."'>

		</div>
	";
?>