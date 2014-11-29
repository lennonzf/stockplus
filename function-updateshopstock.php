<?php
	include('function-connect.php');

	//updateShopStock()
	$shopid = $_GET['shopid'];
	$shopstock = $_GET['shopstock'];
	$shopstockArray = explode(",", $shopstock);

	for($i=0; $i<count($shopstockArray); $i=$i+2){
		$barcode = $shopstockArray[$i];
		$qty = $shopstockArray[$i+1];

		$query_find = "SELECT * FROM ShopStock WHERE ShopID = '".$shopid."' AND Barcode = '".$barcode."' ";
		$result_find =  mysqli_query($dbconn, $query_find);

		if(mysqli_num_rows($result_find) == 0){
			//no such product in the shop
			//and if $qty!=0 -> add record
			if($qty != 0){
				$query_insert = "INSERT INTO ShopStock (ShopID, Barcode, ShopQTY, SetQTY) VALUES ('".$shopid."', '".$barcode."', '".$qty."', '".$qty."') ";
				mysqli_query($dbconn, $query_insert);
			}
		} else {
			while($row = mysqli_fetch_array($result_find)){
				if($qty == 0){
					$query_delete = "DELETE FROM ShopStock WHERE ShopID = '".$shopid."' AND Barcode = '".$barcode."' ";
					mysqli_query($dbconn, $query_delete);
				} else {

					//if qty != 0 -> update the product
					$query_update = "UPDATE ShopStock SET ShopQTY = '".$qty."' WHERE  ShopID = '".$shopid."' AND Barcode = '".$barcode."' ";
					mysqli_query($dbconn, $query_update);

				}
			}
		}
		

	}

	echo "<h1>You have successfully updated the shop stock</h1><br>";
	echo "<a href='page-shopstock.php'><input type='submit' id='backdailyinput' value='Update another shop' class='input-button'></a>";
	echo "<a href='index.php'><input type='submit' id='backhome' value='Back to Homepage' class='input-button'></a>";

?>