<?php
	include('function-connect.php');
	session_start();

	include('function-checklogin.php');

	//Layout: topbar
	$pagetitle = "Add Product";
	include('layout-topbar.php');
?>

	<div class='center-container center' id='content'>
			<!--Input-->
			<div class='section'>
				<h1>Add Product</h1>
				<hr>

				<div id='producttable'>
						<div id='inner-producttable'>
							<table>
								<tr>
									<td>Barcode</td>
									<td>Product Name</td>
									<td>Warehouse QTY</td>
									<td>Cost</td>
									<td>Price</td>
								</tr>
<?php
	for($i = 0; $i < 100; $i++){ 
							echo"<tr>
									<td><input type='text' id='barcode".$i."'></td>
									<td><input type='text' id='productname".$i."' ></td>
									<td><input type='text' id='qty".$i."'></td>
									<td><input type='text' id='cost".$i."'></td>
									<td><input type='text' id='price".$i."'></td>

								</tr>";
	}
?>
							</table>
						</div>
				</div><!--producttable-->

				<div class='gap'></div>

				<input type='submit' id='finish' value='Finish' class='input-button' onclick='finishAddProduct();'>

			</div>
	</div>

<?php
	//layout: footer
	include('layout-footer.php');
?>