<?php
	include('function-connect.php');

	//finishAddProduct()
	$productinfo = $_GET['productinfo'];
	$productinfoArray = explode(",", $productinfo);

	//add to table Product and WarehouseStock
	for($i=0; $i<count($productinfoArray); $i=$i+5){
		$barcode = $productinfoArray[$i];
		$productname = $productinfoArray[$i+1];
		$qty = $productinfoArray[$i+2];
		$cost = $productinfoArray[$i+3];
		$price = $productinfoArray[$i+4];

		//add to table Product
		$query_addproduct = "INSERT INTO Product (Barcode, ProductName, Cost, Price) VALUES ('".$barcode."', '".$productname."', '".$cost."', '".$price."' )";
		mysqli_query($dbconn, $query_addproduct);

		//add to table WarehouseStock
		$query_addwarehouse = "INSERT INTO WarehouseStock (Barcode, WarehouseQTY) VALUES ('".$barcode."', '".$qty."')";
		mysqli_query($dbconn, $query_addwarehouse);
	}

	echo "<h1>You have successfully added new products</h1><br>";
	echo "<a href='page-addproduct.php'><input type='submit' id='backdailyinput' value='Add more products' class='input-button'></a>";
	echo "<a href='index.php'><input type='submit' id='backhome' value='Back to Homepage' class='input-button'></a>";
?>