<?php
	include('function-connect.php');

	//showRefillHistory()
	$shopid = $_GET['shopid'];
	$date = $_GET['date'];

	$qty = 0;
	$total = 0;

	//refillrecord
	$query_refillrecord = "SELECT Barcode, RefillQTY, ProductName, Price FROM RefillRecord NATURAL JOIN Product WHERE ShopID = '".$shopid."' and Date = '".$date."' ";
	$result_refillrecord = mysqli_query($dbconn,$query_refillrecord);

	echo "
		<div id='dailyinputtable-fix'>
	";

	if(mysqli_num_rows($result_refillrecord) == 0){
			
		echo "There was no record on this day";

	} else {

		echo "
				<table>
					<tr>
					<td>Barcode</td>
					<td>Product Name</td>
					<td>Price</td>
					<td>Refill QTY</td>
					<td>Subtotal</td>
				</tr>
		";

		while($row = mysqli_fetch_array($result_refillrecord)){


			echo "
				<tr>
					<td><input type='text' disabled value='".$row['Barcode']."'></td>
					<td><input type='text' disabled value='".$row['ProductName']."'></td>
					<td><input type='text' disabled value='".$row['Price']."'></td>
					<td><input type='text' disabled value='".$row['RefillQTY']."'></td>
					<td><input type='text' disabled value='".$row['RefillQTY']*$row['Price']."'></td>
				</tr>
			";

			$qty = $qty + $row['RefillQTY'];
			$total = $total + ($row['RefillQTY']*$row['Price']);

		}

		echo "
				</table>
		";
	}
	
	echo"
		</div>
	";



	echo "
		<div class='section'>
			<hr>
			<input type='submit' value='Total QTY' class='input-button basic-button'>
			<input type='text' class='date input-text' value='".$qty."'>

			<input type='submit' value='Subtotal' class='input-button basic-button'>
			<input type='text' class='date input-text' value='".$total."'>

		</div>
	";
?>