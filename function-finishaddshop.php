<?php
	include('function-connect.php');

	//finishAddShop()
	$shopname = $_GET["shopname"];
	$opendate = $_GET["opendate"];
	$manager = $_GET["manager"];
	$location = $_GET["location"];
	$shopid = 0;
	$new_qty = 0;

	$initialstock = $_GET["initialstock"];
	$initialstockArray = explode(",", $initialstock);

	$query = "SELECT ShopID FROM Shop ORDER BY ShopID DESC LIMIT 1";
	$result = mysqli_query($dbconn,$query);

	if(mysqli_num_rows($result) == 0){
		$shopid = 1;
	} else {
		while($row = mysqli_fetch_array($result)){
			$shopid = $row['ShopID'] + 1;
		}
	}

	//add to table Shop
	$query_addshop= "INSERT INTO Shop (ShopID, ShopName, OpenDate, Location, Manager) VALUES ('".$shopid."', '".$shopname."', '".$opendate."', '".$location."', '".$manager."')";
	mysqli_query($dbconn, $query_addshop);


	//add to table ShopStock
	/*for($i=0; $i<count($initialstockArray); $i=$i+2){

		$barcode = $initialstockArray[$i];
		$qty = $initialstockArray[$i+1];
		$query_initialstock = "INSERT INTO ShopStock (ShopID, Barcode, ShopQTY, SetQTY) VALUES ('".$shopid."','".$barcode."', '".$qty."', '".$qty."')";
		mysqli_query($dbconn, $query_initialstock);

		//update table WarehouseStock
		$query_qty = "SELECT WarehouseQTY FROM WarehouseStock WHERE Barcode = '".$barcode."' ";
		$result_qty =  mysqli_query($dbconn,$query_qty);
		while($row = mysqli_fetch_array($result_qty)){
			$new_qty = $row['WarehouseQTY'] - $qty;
		}

		$query_updateqty = "UPDATE WarehouseStock SET WarehouseQTY = '".$new_qty."' WHERE Barcode = '".$barcode."' ";
		mysqli_query($dbconn, $query_updateqty);
	}*/

	
	echo "<h1>You have successfully added a new shop</h1><br>";
	echo "<a href='page-addshop.php'><input type='submit' value='Add another shop' class='input-button back-button'></a>";
	echo "<a href='index.php'><input type='submit' value='Back to Homepage' class='input-button back-button'></a>";
	
?>