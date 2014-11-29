<?php
	include('function-connect.php');
	
	//showSubtotal(str)
	$qty = $_GET["qty"];
	$qtyBarcode = $_GET["qtyBarcode"];

	if($qty && $qtyBarcode){
		$query_qty = "SELECT Price FROM Product WHERE Barcode = ".$qtyBarcode."";
		$result_qty = mysqli_query($dbconn,$query_qty);

		if(mysqli_num_rows($result_qty) == 0){
			
			echo "Not Found";

		} else {

			while($row = mysqli_fetch_array($result_qty)){
				echo $row['Price']*$qty;
			}
		}
	}
?>