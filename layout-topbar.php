<?php
	echo"

	<!DOCTYPE HTML5>

	<html>
		<head>
			<title>StockPlus - ".$pagetitle."</title>
			<link rel='stylesheet' type='text/css' href='css/main.css'>
			<script type='text/javascript' src='js/ajax.js'></script>
			<script type='text/javascript' src='js/javascript.js'></script>
			<meta charset='utf-8'>
		</head>

		<body>
		<div id='top-bar'>
			<div class='center-container center'>
				<a href='index.php'><p id='logo'>StockPlus</p></a>
				<form method='POST'>
					<input type='submit' id='logout' name='logout' value='Logout' class='button'>
				</form>
				<input type='submit' id='user' value='welcome ".$_SESSION['username']."' class='button'>
			</div>
		</div>";
?>