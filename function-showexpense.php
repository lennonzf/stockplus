<?php
	include('function-connect.php');

	//showExpense()
	$shopid = $_GET['shopid'];
	$date = $_GET['date'];

	$dynamic = 0;
	$extra = 0;
	$total = 0;

	//dynamic
	$query_dynamic = "SELECT Labour, Rent, Discount FROM DynamicExpense WHERE ShopID = '".$shopid."' and date = '".$date."' ";
	$result_dynamic = mysqli_query($dbconn,$query_dynamic);
	echo "
		<div id='dailydynamictable-fix'>
			<h2>Dynamic Expense</h2>
	";

	if(mysqli_num_rows($result_dynamic) == 0){
		echo "There was no record on this day";
	} else {
		while($row = mysqli_fetch_array($result_dynamic)){
			echo"
				<table>
					<tr>
						<td>Discount</td>
						<td>Labour</td>
						<td>Rent</td>
					</tr>
					<tr>
						<td><input type='text' id='discount' disabled value='".$row['Discount']."'></td>
						<td><input type='text' id='labour' disabled value='".$row['Labour']."'></td>
						<td><input type='text' id='rent' disabled value='".$row['Rent']."'></td>
					</tr>
				</table>
			";

			$dynamic = $row['Discount'] + $row['Labour'] + $row['Rent'] ;
		}
	}

	echo "
		</div>
		<div class='gap'></div>
	";

	//extra
	$query_extra = "SELECT Item, Cost, Note FROM ExtraExpense WHERE ShopID = '".$shopid."' and date = '".$date."' ";
	$result_extra = mysqli_query($dbconn,$query_extra);

	echo "
		<div id='dailyextratable-fix'>
			<h2>Extra Expense</h2>
	";

	if(mysqli_num_rows($result_extra) == 0){
		echo "There was no record on this day";
	} else {
		echo "

				<table>
					<tr>
						<td>Item</td>
						<td>Cost</td>
						<td>Note</td>
					</tr>
		";

		while($row = mysqli_fetch_array($result_extra)){
			echo "
				<tr>
					<td><input type='text' value='".$row['Item']."' disabled></td>
					<td><input type='text' value='".$row['Cost']."' disabled></td>
					<td><input type='text' value='".$row['Note']."' disabled></td>
				</tr>
			";

			$extra = $extra + $row['Cost'];
		}

		echo "
				</table>

		";
	}

	echo "

		</div>

	";

	$total = $dynamic + $extra;

	echo "
		<div class='section'>
			<hr>

			<input type='submit' value='Dynamic Expense' class='input-button basic-button'>
			<input type='text' class='date input-text' value='".$dynamic."'>

			<input type='submit' value='Extra Expense' class='input-button basic-button'>
			<input type='text' class='date input-text' value='".$extra."'>

			<div class='gap'></div>

			<input type='submit' value='Total Expense' class='input-button basic-button'>
			<input type='text' class='date input-text' value='".$total."'>

		</div>
	";
?>

