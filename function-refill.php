<?php
	include('function-connect.php');

	//refill()
	$shopid = $_GET["shopid"];
	$date = $_GET["date"];
	$refillrecord = $_GET["refillrecord"];
	$refillrecordArray = explode(",", $refillrecord);

	for($i=0; $i<count($refillrecordArray); $i=$i+3){
		$productname = $refillrecordArray[$i];
		$refill = $refillrecordArray[$i+1];
		$setstock = $refillrecordArray[$i+2];

		//find barcode
		$query_barcode = "SELECT Barcode FROM Product WHERE ProductName = '".$productname."' ";
		$result_barcode = mysqli_query($dbconn,$query_barcode);

		while($row = mysqli_fetch_array($result_barcode)){
			$barcode = $row['Barcode'];
		}

		//find WarehouseQTY
		$query_warehouseqty = "SELECT WarehouseQTY FROM WarehouseStock WHERE Barcode = '".$barcode."' ";
		$result_warehouseqty = mysqli_query($dbconn,$query_warehouseqty);

		while($row = mysqli_fetch_array($result_warehouseqty)){
			$warehouseQTY = $row['WarehouseQTY'];
		}

		//update table WarehouseStock
		$query_warehousestock = "UPDATE WarehouseStock SET WarehouseQTY='".($warehouseQTY - $refill)."' WHERE Barcode = '".$barcode."' ";
		mysqli_query($dbconn,$query_warehousestock);


		//find shopQTY
		$query_shopqty = "SELECT ShopQTY FROM ShopStock WHERE ShopID = '".$shopid."' AND Barcode = '".$barcode."' ";
		$result_shopqty = mysqli_query($dbconn,$query_shopqty);

		while($row = mysqli_fetch_array($result_shopqty)){
			$shopQTY = $row['ShopQTY'];
		}

		//update table ShopStock
		$newshopQTY = $shopQTY + $refill;

		$query_shopstock = "UPDATE ShopStock SET ShopQTY = '".$newshopQTY."', SetQTY = '".$setstock."' WHERE ShopID = '".$shopid."' AND Barcode = '".$barcode."'  ";
		mysqli_query($dbconn,$query_shopstock);

		if($refill >= 0){
			//insert table RefillRecord
			$query_refillrecord = "INSERT INTO RefillRecord (Barcode, ShopID, Date, RefillQTY) VALUES ('".$barcode."', '".$shopid."', '".$date."', '".$refill."' ) ";
			mysqli_query($dbconn,$query_refillrecord);
		}

	}

	echo "<h1>You have successfully refilled product</h1><br>";
	echo "<a href='page-refill.php'><input type='submit' id='backdailyinput' value='Start a new refill' class='input-button'></a>";
	echo "<a href='index.php'><input type='submit' id='backhome' value='Back to Homepage' class='input-button'></a>";

?>