<?php
	include('function-connect.php');
	session_start();

	include('function-checklogin.php');

	//Layout: topbar
	$pagetitle = "Cost";
	include('layout-topbar.php');
?>

	<div class='center-container center' id='content'>
		<!--Input-->
		<div class='section'>
			<h1>Cost</h1>
			<hr>
			<input type='submit' id='date' value='Date' class='input-button'>
			<input type='text' class='date input-text' placeholder='yyyy-mm-dd' id='dateinput'>

			<input type='submit' id='shopname' value='Shop ID' class='input-button'>
			<input type='text' class='shopid input-text' placeholder='1' id='shopidinput' onkeyup='showShopName(this.value);'>
			<input type='text' class='shopname input-text' disabled id='shopnameinput'>

			<input type='submit' id='generate' value='Generate' class='input-button' onclick='showCost();'>
			<div class='gap'></div>
			<hr>
			
		</div>



		<div class='section' id='table-content'>
			
		</div>

<?php
	include('layout-print.php');
?>

	</div>



<?php
	//layout: footer
	include('layout-footer.php');
?>