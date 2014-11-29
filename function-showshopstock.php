<?php
	include('function-connect.php');


	$shopid = $_GET['shopid'];
	$count = 0;

	$query_product = "SELECT * FROM Product";
	$result_product = mysqli_query($dbconn, $query_product);

	echo "
		<div class='section'>
			<table>
				<tr>
					<td>Barcode</td>
					<td>Name</td>
					<td>QTY</td>
				</tr>
	";

	while($row = mysqli_fetch_array($result_product)){
		$count = $count + 1;

		$barcode = $row['Barcode'];

		echo "
				<tr>
					<td><input type='text' id='barcode".$count."' value='".$row['Barcode']."'></td>
					<td><input type='text' value='".$row['ProductName']."'></td>
		";

		$query_shopstock = "SELECT ShopQTY FROM ShopStock WHERE ShopID = '".$shopid."' AND Barcode = '".$barcode."' ";
		$result_shopstock = mysqli_query($dbconn, $query_shopstock);

		if(mysqli_num_rows($result_shopstock) == 0){
			echo "
					<td><input type='text' id='qty".$count."' value='0'></td>
				</tr>
			";
		} else {

			while($row = mysqli_fetch_array($result_shopstock)){
				echo "
					<td><input type='text' id='qty".$count."' value='".$row['ShopQTY']."'></td>
				</tr>
				";
			}

		}	
	}

	echo "
			</table>
		</div>
		<hr>
		<input type='submit' value='Update' class='input-button hover-button right' onclick=\"updateShopStock('".($count+1)."');\">
	";

?>
