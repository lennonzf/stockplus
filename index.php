<?php
	include('function-connect.php');
	session_start();

	include('function-checklogin.php');

	//Layout: topbar
	$pagetitle = "Admin";
	include('layout-topbar.php');
?>

		<div class='center-container center'>
			<!--Input-->
			<div class='section'>
				<h1>Input</h1>
				<hr>
				<!--Initial-->
				<input type='submit' value='Initial' class='input-button basic-button' >
				<a href='page-addproduct.php'><input type='submit' value='Add Product' class='input-button hover-button'></a>
				<a href='page-addshop.php'><input type='submit' value='Add Shop' class='input-button hover-button'></a>
				<div class='gap'></div>
				<!--Shop-->
				<input type='submit' value='Shop' class='input-button basic-button' >
				<a href='page-shopstock.php'><input type='submit' value='Shop Stock' class='input-button hover-button'></a>
				<div class='gap'></div>
				<!--Daily-->
				<input type='submit' value='Daily' class='input-button basic-button'>
				<a href='page-dailyinput.php'><input type='submit' value='Daily Input' class='input-button hover-button'></a>
				<div class='gap'></div>
				<!--Stock-->
				<input type='submit' value='Stock' class='input-button basic-button'>
				<a href='page-refill.php'><input type='submit' value='Refill' class='input-button hover-button'></a>
			</div>

			<div class='gap'></div>
			<!--Output-->
			<div class='section'>
				<h1>Output</h1>
				<hr>
				<!--Stock-->
				<input type='submit' value='Stock' class='input-button basic-button'>
				<a href='page-stocktake.php'><input type='submit' value='Stocktake' class='input-button hover-button'></a>
				<a href='page-refilllist.php'><input type='submit' value='Refill List' class='input-button hover-button'></a>
				<div class='gap'></div>
				<!--Basic-->
				<input type='submit' value='Basic' class='input-button basic-button'>
				<a href='page-cost.php'><input type='submit' value='Cost' class='input-button hover-button'></a>
				<a href='page-sold.php'><input type='submit' value='Sale' class='input-button hover-button'></a>
				<a href='page-profit.php'><input type='submit' value='Profit' class='input-button hover-button'></a>
				<a href='page-expense.php'><input type='submit' value='Expense' class='input-button hover-button'></a>
				<a href='page-refillhistory.php'><input type='submit' value='Refill History' class='input-button hover-button'></a>
				<div class='gap'></div>
				<!--Summary-->
				<input type='submit' value='Summary' class='input-button basic-button'>
				<a href='page-shopsummary.php'><input type='submit' value='Shop Summary' class='input-button hover-button'></a>
				<a href='page-summary.php'><input type='submit' value='Summary' class='input-button hover-button'></a>
				<div class='gap'></div>
				<!--Report-->
				<input type='submit' value='Report' class='input-button basic-button'>
				<a href='page-shopreport.php'><input type='submit' value='Shop Report' class='input-button hover-button'></a>
				<a href='page-report.php'><input type='submit'value='Report' class='input-button hover-button'></a>
			</div>
		</div>

<?php
	//layout: footer
	include('layout-footer.php');
?>