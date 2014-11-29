<?php
	include('function-connect.php');
	session_start();

	include('function-checklogin.php');

	//Layout: topbar
	$pagetitle = "Report";
	include('layout-topbar.php');
?>

	<div class='center-container center' id='content'>
		<div class='section'>
			<h1>Report</h1>
			<hr>
			
		</div>


		<div class='section' id='table-content'>			
<?php
	$year = 0;
	$month = 0;
	$turnover = 0;
	$cost = 0;
	$grossprofit = 0;
	$netprofit = 0;

	$dynamic = 0;
	$extra = 0;
	$expense = 0;

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
	$query_sold = "SELECT year(Date) AS year, month(Date) AS month, Sum(SoldQTY*Cost) AS product_cost, Sum(SoldQTY*Price) AS product_sale, Sum(soldQTY*(Price-Cost)) AS product_profit FROM SoldRecord NATURAL JOIN Product GROUP BY month ORDER BY year, month DESC ";
	$result_sold = mysqli_query($dbconn,$query_sold);

	echo "
		<div class='section'>
	";

	if(mysqli_num_rows($result_sold) == 0){
			
		echo "There was no record";

	} else {

		echo "
			<table>
				<tr>
					<td>Year</td>
					<td>Month</td>
					<td>Turnover</td>
					<td>Cost</td>
					<td>Gross Profit</td>
					<td>Expense</td>
					<td>Net Profit</td>
				</tr>
		";

		while($row = mysqli_fetch_array($result_sold)){

			$year = $row['year'];
			$month = $row['month'];
			$productcost = $row['product_cost'];
			$productsale = $row['product_sale'];
			$productprofit = $row['product_profit'];

			//find refund record
			$query_refund = "SELECT Barcode, ProductName, Sum(Cost) AS refundcost, Sum(Price) AS refundsale FROM RefundRecord NATURAL JOIN Product WHERE year(Date) = '".$year."' AND month(Date) = '".$month."' ";
			$result_refund = mysqli_query($dbconn,$query_refund);

			if(mysqli_num_rows($result_refund) == 0){

			} else {
				while($row = mysqli_fetch_array($result_refund)){
					$refundcost = $row["refundcost"];
					$refundsale = $row["refundsale"];
					$refundprofit = $row["refundsale"] - $row["refundcost"];
				}
			}

			$totalcost = $productcost - $refundcost;
			$turnover = $productsale - $refundsale;
			$grossprofit = $productprofit - $refundprofit;

			//extra
			$query_extra = "SELECT Sum(cost) AS cost FROM ExtraExpense WHERE year(Date) = '".$year."' AND month(Date) = '".$month."' ";
			$result_extra = mysqli_query($dbconn,$query_extra);

			if(mysqli_num_rows($result_extra) == 0){

				$extra = 0;

			} else {
				
				while($row = mysqli_fetch_array($result_extra)){

					$extra = $row['cost'];
										
				}
			}

			//dynamic
			$query_dynamic = "SELECT Sum(Labour) AS labour, Sum(Rent) AS rent, Sum(Discount) AS discount FROM DynamicExpense WHERE year(Date) = '".$year."' AND month(Date) = '".$month."' "; 
			$result_dynamic = mysqli_query($dbconn,$query_dynamic);

			if(mysqli_num_rows($result_dynamic) == 0){

				$dynamic = 0;

			} else {

				while($row = mysqli_fetch_array($result_dynamic)){

					$dynamic = $row['labour'] + $row['rent'] + $row['discount'];

				}
			}

			$expense = $dynamic + $extra;

			$netprofit = $grossprofit - $expense;

			//year month turnover totalcost
			echo "
				<tr>
					<td><input type='text' disabled value='".$year."'></td>
					<td><input type='text' disabled value='".$month."'></td>
					<td><input type='text' disabled value='".$turnover."'></td>
					<td><input type='text' disabled value='".$totalcost."'></td>
					<td><input type='text' disabled value='".$grossprofit."'></td>
					<td><input type='text' disabled value='".$expense."'></td>
					<td><input type='text' disabled value='".$netprofit."'></td>
				</tr>
			";

		}

	}

	echo "
		</table>
	</div>
	";	

?>
		</div>
		
<?php
	include('layout-print.php');
?>

	</div>

<?php
	//layout: footer
	include('layout-footer.php');
?>