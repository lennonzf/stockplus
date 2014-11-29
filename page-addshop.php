<?php
	include('function-connect.php');
	session_start();

	include('function-checklogin.php');

	//Layout: topbar
	$pagetitle = "Add Shop";
	include('layout-topbar.php');
?>
	
		<div class='center-container center' id='content'>
			<!--Input-->
			<div class='section'>
				<h1>Add Shop</h1>
				<hr>

				<input type='submit' value='Shop Name' class='input-button basic-button'>
				<input type='text' class='input-text shopname' id='shopnameinput'>

				<input type='submit' value='Open Date' class='input-button basic-button'>
				<input type='text' class='input-text date' placeholder='yyyy-mm-dd' id='opendateinput'>

				<input type='submit' value='Manager' class='input-button basic-button'>
				<input type='text' class='input-text shopname' id='managerinput'>

				<div class='gap'></div>

				<input type='submit' value='Location' class='input-button basic-button'>
				<input type='text' class='input-text location' id='locationinput'>

				<div class='gap'></div>

				<hr>

				<!--<div id='initialshopstocktable'>
					<h2>Initial Shop Stock</h2>
						<div id='inner-initialshopstocktable'>
							<table>
								<tr>
									<td>Barcode</td>
									<td>Product Name</td>
									<td>QTY</td>
									<td>Subtotal</td>
								</tr>
<?php
	/*
	for($i = 0; $i < 100; $i++){ 
							echo"<tr>
									<td><input type='text' id='barcode".$i."' onkeyup='showProductName(this.value, ".$i.");'></td>
									<td><input type='text' id='productname".$i."' disabled></td>
									<td><input type='text' id='qty".$i."' onkeyup='showSubtotal(this.value, ".$i.");'></td>
									<td><input type='text' id='subtotal".$i."' disabled></td>
								</tr>";
	}
	*/
?>
							</table>
						</div>
				</div>--><!--initialshopstocktable-->


				<input type='submit' id='finish' value='Finish' class='input-button' onclick='finishAddShop();'>
			</div>


		</div>




<?php
	//layout: footer
	include('layout-footer.php');
?>