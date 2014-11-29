<?php
	include('function-connect.php');

	//showShopSummary()
	$date_from = $_GET['date_from'];
	$date_to = $_GET['date_to'];

	$dynamic = 0;
	$grossprofit = 0;
	$extra = 0;
	$netprofit = 0;

	$productcost = 0;
	$productsale = 0;
	$productprofit = 0;

	$refundcost = 0;
	$refundsale = 0;
	$refundprofit = 0;

	$date = 0;

	$totalcost = 0;
	$turnover = 0;

	//Sold Record
	$query_sold = "SELECT Sum(SoldQTY*Cost) AS product_cost, Sum(SoldQTY*Price) AS product_sale, Sum(soldQTY*(Price-Cost)) AS product_profit, Date FROM SoldRecord NATURAL JOIN Product WHERE Date <= '".$date_to."' AND Date >= '".$date_from."' ";
	$result_sold = mysqli_query($dbconn,$query_sold);

	echo "
		<div class='section'>
			<h2>Summary</h2>
	";

	if(mysqli_num_rows($result_sold) == 0){

		echo "There was no sold record between the dates";

	} else {

		while($row = mysqli_fetch_array($result_sold)){
			$date = $row['Date'];
			$productcost = $row['product_cost'];
			$productsale = $row['product_sale'];
			$productprofit = $row['product_profit'];

			//find refund record
			$query_refund = "SELECT Barcode, ProductName, Cost, Price FROM RefundRecord NATURAL JOIN Product WHERE Date = '".$date."' ";
			$result_refund = mysqli_query($dbconn,$query_refund);

			if(mysqli_num_rows($result_refund) == 0){

			} else {
				while($row = mysqli_fetch_array($result_refund)){
					$refundcost = $refundcost + $row["Cost"];
					$refundsale = $refundsale + $row["Price"];
					$refundprofit = $refundprofit + ($row["Price"] - $row["Cost"]);
				}
			}

			$totalcost = $productcost - $refundcost;
			$turnover = $productsale - $refundsale;
			$grossprofit = $productprofit - $refundprofit;

			echo "
				<input type='submit' value='Cost' class='input-button basic-button'>
				<input type='text' class='date input-text' value='".$totalcost."'>

				<input type='submit' value='Turnover' class='input-button basic-button'>
				<input type='text' class='date input-text' value='".$turnover."'>

				<input type='submit' value='Gross Profit' class='input-button basic-button'>
				<input type='text' class='date input-text' value='".$grossprofit."'>
				<div class='gap'></div>
			";

			$grossprofit = $row['gross_profit'];
		}
	}

	//Dynamic
	$query_dynamic = "SELECT Sum(Labour) AS totallabour, Sum(Rent) AS totalrent, Sum(discount) AS totaldiscount FROM DynamicExpense WHERE Date <= '".$date_to."' AND Date >= '".$date_from."' ";
	$result_dynamic = mysqli_query($dbconn,$query_dynamic);

	if(mysqli_num_rows($result_dynamic) == 0){

		echo "There was no dynamic expense record between the dates";

	} else {

		while($row = mysqli_fetch_array($result_dynamic)){
			$dynamic = $row['totallabour'] + $row['totalrent'] + $row['totaldiscount'];
			echo"
				<!--<input type='submit' value='Labour' class='input-button basic-button'>
				<input type='text' class='date input-text' value='".$row['totallabour']."'>

				<input type='submit' value='Rent' class='input-button basic-button'>
				<input type='text' class='date input-text' value='".$row['totalrent']."'>

				<input type='submit' value='Discount' class='input-button basic-button'>
				<input type='text' class='date input-text' value='".$row['totaldiscount']."'>-->

				<input type='submit' value='Dynamic Expense' class='input-button basic-button'>
				<input type='text' class='date input-text' value='".$dynamic."'>

			";
		}
	}

	//Extra
	$query_extra = "SELECT Sum(Cost) AS totalextra FROM ExtraExpense WHERE Date <= '".$date_to."' AND Date >= '".$date_from."' ";
	$result_extra = mysqli_query($dbconn,$query_extra);

	if(mysqli_num_rows($result_extra) == 0){

		echo "There was no extra expense record between the dates";

	} else {

		while($row = mysqli_fetch_array($result_extra)){

			echo "
				<input type='submit' value='Extra Expense' class='input-button basic-button'>
				<input type='text' class='date input-text' value='".$row['totalextra']."'>
			";

			$extra = $row['totalextra'];
		}
	}

		$netprofit = $grossprofit - $dynamic - $extra;

	echo "
			<input type='submit' value='Net Profit' class='input-button basic-button'>
			<input type='text' class='date input-text' value='".$netprofit."'>
		</div>
	";


?>