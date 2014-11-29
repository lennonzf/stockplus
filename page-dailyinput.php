<?php
	include('function-connect.php');
	session_start();

	include('function-checklogin.php');

	//Layout: topbar
	$pagetitle = "Daily Input";
	include('layout-topbar.php');
?>


		<div class='center-container center' id='content'>
			<!--Input-->
			<div class='section'>
				<h1>Daily Input</h1>
				<hr>
				<input type='submit' id='date' value='Date' class='input-button'>
				<input type='text' class='date input-text' placeholder='yyyy-mm-dd' id='dateinput'>
				<input type='submit' id='shopname' value='Shop ID' class='input-button'>
				<input type='text' class='shopid input-text' placeholder='1' id='shopidinput' onkeyup='showShopName(this.value);'>
				<input type='text' class='shopname input-text' disabled id='shopnameinput'>
				<div class='gap'></div>
				<hr>

				
				<div id='dailyinputtable'>
					<div id='inner-dailyinputtable'>
						<h2>Sale</h2>
						<table>
							<tr>
								<td>Barcode</td>
								<td>Product Name</td>
								<td>QTY</td>
								<td>Sale Subtotal</td>
							</tr>
<?php
	for($i = 0; $i < 100; $i++){ 
						echo"<tr>
								<td><input type='text' id='barcode".$i."' onkeyup='showProductName(this.value, ".$i.");'></td>
								<td><input type='text' id='productname".$i."' disabled></td>
								<td><input type='text' id='qty".$i."' onkeyup='showSubtotal(this.value, ".$i.");'></td>
								<td><input type='text' id='subtotal".$i."' disabled></td>
							</tr>";
	}
?>
						</table>
					</div>
				</div><!--dailyinputtable-->

				<div id='dailydynamictable'>
					<h2>Dynamic Expense</h2>
					<table>
						<tr>
							<td>Discount</td>
							<td>Labour</td>
							<td>Rent</td>
						</tr>
						<tr>
							<td><input type='text' id='discount'></td>
							<td><input type='text' id='labour'></td>
							<td><input type='text' id='rent'></td>
						</tr>
					</table>
				</div>

				<div id='dailyextratable'>
					<h2>Extra Expense</h2>
					<div id='inner-dailyextratable'>
						<table>
							<tr>
								<td>Item</td>
								<td>Cost</td>
								<td>Note</td>
							</tr>
<?php
	for($i = 0; $i < 30; $i++){ 
						echo" 
							<tr>
								<td><input type='text' id='item".$i."'></td>
								<td><input type='text' id='cost".$i."'></td>
								<td><input type='text' id='note".$i."'></td>
							</tr>";
	}
?>
						</table>
					</div>
				</div>


				<div id='dailyrefundtable'>
					<div id='inner-dailyrefundtable'>
						<h2>Refund</h2>
						<table>
							<tr>
								<td>Barcode</td>
								<td>Product Name</td>
								<td>QTY</td>
								<td>Subtotal</td>
							</tr>
<?php
	for($i = 0; $i < 50; $i++){ 
						echo"<tr>
								<td><input type='text' id='refund-barcode".$i."' onkeyup='showRefundProductName(this.value, ".$i.");'></td>
								<td><input type='text' id='refund-productname".$i."' disabled></td>
								<td><input type='text' id='refund-qty".$i."' onkeyup='showRefundSubtotal(this.value, ".$i.");'></td>
								<td><input type='text' id='refund-subtotal".$i."' disabled></td>
							</tr>";
	}
?>
						</table>
					</div>
				</div><!--dailyinputtable-->

				
			</div><!--section-->
			<br>
			<div class='section'>
				<hr>
				<input type='submit' id='turnover' value='Turnover' class='input-button' onclick='turnover();'>
				<input type='text' id='turnoverlabel'class='date input-text'>

				<div class='gap'></div>

				<input type='submit' id='cash' value='Cash' class='input-button'>
				<input type='text' id='cashlabel' class='date input-text'>
				<input type='submit' id='card' value='Card' class='input-button'>
				<input type='text' id='cardlabel' class='date input-text'>
				<input type='submit' id='check' value='Check' class='input-button' onclick='checkTurnover();'>

				<div class='gap'></div>

				<input type='submit' id='finish' value='Finish' class='input-button' onclick='finishDailyInput();'>

				<div class='gap'></div>

			</div>
		</div>

<?php
	//layout: footer
	include('layout-footer.php');
?>