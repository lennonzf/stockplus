<?php
	include('function-connect.php');
	
	
	//showProductName(str)
	$barcode = $_GET["barcode"];
	
	if($barcode){
		$query = "SELECT ProductName FROM Product WHERE Barcode = ".$barcode."";
		$result = mysqli_query($dbconn,$query);

		if(mysqli_num_rows($result) == 0){
			
			echo "Not Found";

		} else {

			while($row = mysqli_fetch_array($result)){
				echo $row['ProductName'];
			}
		}
	}


	

?>