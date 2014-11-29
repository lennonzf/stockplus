<?php
	include('function-connect.php');

	//finishDailyInput()
	$date = $_GET["date"];
	$shopid = $_GET["shopid"];

	$soldrecord = $_GET["soldrecord"];
	$soldrecordArray = explode(",", $soldrecord);
	$updateQTY = 0;

	$discount = $_GET["discount"];
	$labour = $_GET["labour"];
	$rent = $_GET["rent"];
	$extrarecord = $_GET["extrarecord"];
	$extrarecordArray = explode(",", $extrarecord);

	$refundrecord = $_GET["refundrecord"];
	$refundrecordArray = explode(",", $refundrecord);

	//console
	/*echo "Date: ".$date."<br>";
	echo "ShopID: ".$shopid."<br>";
	echo "SoldRecord: ".$soldrecord."<br>";
	echo "Discount: ".$discount."<br>";
	echo "Labour: ".$labour."<br>";
	echo "Rent: ".$rent."<br>";
	echo "ExtraRecord: ".$extrarecord."<br>";*/

	if(count($extrarecordArray)>=2){
		for($i=0; $i<count($soldrecordArray); $i=$i+2){

			//add to table SoldRecord
			$barcode = $soldrecordArray[$i];
			$qty = $soldrecordArray[$i+1];
			$query_soldrecord = "INSERT INTO SoldRecord (Barcode, ShopID, Date, SoldQTY) VALUES ('".$barcode."', '".$shopid."', '".$date."', '".$qty."')";
			mysqli_query($dbconn, $query_soldrecord);

			//update table ShopStock
			$query_shopstock = "SELECT * FROM ShopStock WHERE ShopID = '".$shopid."' AND Barcode = '".$barcode."' ";
			$result_shopstock =  mysqli_query($dbconn,$query_shopstock);

			while($row = mysqli_fetch_array($result_shopstock)){
				$updateQTY = $row['ShopQTY'] - $qty;

				$query_updateshopstock = "UPDATE ShopStock SET ShopQTY = '".$updateQTY."' WHERE  ShopID = '".$shopid."' AND Barcode = '".$barcode."'";
				mysqli_query($dbconn, $query_updateshopstock);
			}

		}
	}

	
	//add to table DynamicExpense
	$query_dynamic = "INSERT INTO DynamicExpense (ShopID, Date, Labour, Rent, Discount) VALUES ('".$shopid."', '".$date."', '".$labour."', '".$rent."', '".$discount."')";
	mysqli_query($dbconn, $query_dynamic);
	
	if(count($extrarecordArray)>=3){
		//add to table ExtraExpense
		for($i=0; $i<count($extrarecordArray); $i=$i+3){
			$item = $extrarecordArray[$i];
			$cost = $extrarecordArray[$i+1];
			$note = $extrarecordArray[$i+2];
			$query_extra = "INSERT INTO ExtraExpense (Date, ShopID, Item, Cost, Note) VALUES ('".$date."', '".$shopid."', '".$item."', '".$cost."', '".$note."')";
			mysqli_query($dbconn, $query_extra);
		}
	}

	if(count($refundrecordArray)>=2){
		for($i=0; $i<count($refundrecordArray); $i=$i+2){
			$refundbarcode = $refundrecordArray[$i];
			$refundqty = $refundrecordArray[$i+1];

			//add to table RefundRecord
			$query_refund = "INSERT INTO RefundRecord (ShopID, Barcode, Date, RefundQTY) VALUES ('".$shopid."', '".$refundbarcode."', '".$date."', '".$refundqty."')";
			mysqli_query($dbconn, $query_refund);

			//update ShopStock
			$query_find = "SELECT ShopQTY FROM ShopStock WHERE ShopID = '".$shopid."' AND Barcode = '".$refundbarcode."' ";
			$result_find = mysqli_query($dbconn, $query_find);

			while($row = mysqli_fetch_array($result_find)){
				$shopqty = $row['ShopQTY'];
				$newshopqty = $shopqty + $refundqty;

				$query_updaterefund = "UPDATE ShopStock SET ShopQTY = '".$newshopqty."' WHERE ShopID = '".$shopid."' AND Barcode = '".$refundbarcode."' ";
				mysqli_query($dbconn, $query_updaterefund);

			}

		}
	}
	
	echo "<h1>You have successfully made an input</h1><br>";
	echo "<a href='page-dailyinput.php'><input type='submit' id='backdailyinput' value='Start a new input' class='input-button'></a>";
	echo "<a href='index.php'><input type='submit' id='backhome' value='Back to Homepage' class='input-button'></a>";
?>