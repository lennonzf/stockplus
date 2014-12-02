<?php
	include('function-connect.php');
	session_start();

	include('function-checklogin.php');

	//Layout: topbar
	$pagetitle = "Import Product";
	include('layout-topbar.php');
?>
	
	<div class='center-container center' id='content'>
		<!--Import-->
		<div class='section'>
			<h1>Import Product</h1>
			<hr>

			<form method="post" enctype="multipart/form-data">
				<input type='file' name='file' id='file' class='input-button basic-button'>
				<input type='submit' value='Upload .csv file' name='submit' class='input-button hover-button'>
			</form>

<?php
	if(isset($_POST["submit"])){
		//to deal with mac
		ini_set('auto_detect_line_endings',TRUE);


		//read file
		$filename = $_FILES['file']['tmp_name'];

		$row = 0;
		if (($handle = fopen($filename, "r")) !== FALSE) {
		    while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
		        $num = count($data);
		        $row++;
		        for ($c=0; $c < $num; $c = $c + 4) {
		        	if($row > 1){
			        	$barcode = $data[$c];
			        	$productname = $data[$c+1];
			        	$cost = $data[$c+2];
			        	$price = $data[$c+3];

			            $query_import = "INSERT INTO Product (Barcode, ProductName, Cost, Price) VALUES ('".$barcode."', '".$productname."', '".$cost."', '".$price."')";
			            mysqli_query($dbconn, $query_import);
		        	}
		        }
		    }
		    fclose($handle);

		    header('Location: index.php');
		} else {
			echo "<br>";
			echo "You did not upload the file properly, please do it again.";
		}

		

	}
?>

		</div>

	</div>

<?php
	//layout: footer
	include('layout-footer.php');
?>