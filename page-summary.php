<?php
	include('function-connect.php');
	session_start();

	include('function-checklogin.php');

	//Layout: topbar
	$pagetitle = "Summary";
	include('layout-topbar.php');
?>

	<div class='center-container center' id='content'>
		<!--Input-->
		<div class='section'>
			<h1>Summary</h1>
			<hr>

			<input type='submit' id='date' value='Date' class='input-button'>
			<input type='text' class='date input-text' placeholder='yyyy-mm-dd' id='dateinput_1'>
			<input type='submit' id='date' value='To' class='input-button'>
			<input type='text' class='date input-text' placeholder='yyyy-mm-dd' id='dateinput_2'>

			<input type='submit' id='generate' value='Generate' class='input-button' onclick='showSummary();'>
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