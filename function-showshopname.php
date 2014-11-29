<?php
	include('function-connect.php');
	
	//showSubtotal(str)
	$shopid = $_GET["shopid"];

	if($shopid){
		$query_shopid= "SELECT ShopName FROM Shop WHERE ShopID = ".$shopid."";
		$result_shopid = mysqli_query($dbconn,$query_shopid);

		if(mysqli_num_rows($result_shopid) == 0){
			
			echo "Not Found";

		} else {

			while($row = mysqli_fetch_array($result_shopid)){
				echo $row['ShopName'];
			}
		}
	}
?>