function turnover(){
	//sale
	var sale = 0;
	for(i=0; i<100; i++){
		if(document.getElementById("subtotal"+i).value){
			sale = sale + parseFloat(document.getElementById("subtotal"+i).value);
		}
	}

	/*
	//dynamic
	var discount = 0;
	var labour = 0;
	var rent = 0;
	var dynamic = 0;

	if(document.getElementById("discount").value){
		var discount = parseFloat(document.getElementById("discount").value);
	}
	if(document.getElementById("labour").value){
		var labour = parseFloat(document.getElementById("labour").value);
	}
	if(document.getElementById("rent").value){
		var rent = parseFloat(document.getElementById("rent").value);
	}

	dynamic = discount + labour + rent;

	//extra
	var extra = 0;
	for(i=0; i<30; i++){
		if(document.getElementById("cost"+i).value){
			extra = extra + parseFloat(document.getElementById("cost"+i).value);
		}
	}
	*/

	//refund
	var refund = 0;
	for(i=0; i<50; i++){
		if(document.getElementById("refund-subtotal"+i).value){
			refund = refund + parseFloat(document.getElementById("refund-subtotal"+i).value);
		}
	}

	var turnover = sale - refund;
	//the way to solve float problem in js
	turnover = parseFloat(turnover.toPrecision(12));

	document.getElementById("turnoverlabel").value=turnover;
}

function checkTurnover(){
	var cash = 0;
	var card = 0;
	var total = 0;
	if(document.getElementById("cashlabel").value && document.getElementById("cardlabel").value){
		cash = parseFloat(document.getElementById("cashlabel").value);
		card = parseFloat(document.getElementById("cardlabel").value);
		total = cash + card;
	}

	console.log(total);

	var turnover = 0;
	if(document.getElementById("turnoverlabel").value){
		turnover = parseFloat(document.getElementById("turnoverlabel").value);
	}

	console.log(turnover);

	if(turnover == total){
		document.getElementById("check").value = "Match";
		document.getElementById("check").style.backgroundColor = "#6aad28";
		document.getElementById("check").style.color = "#f2eeee";
	} else {
		document.getElementById("check").value = "Not Match";
		document.getElementById("check").style.backgroundColor = "#c4533d";
		document.getElementById("check").style.color = "#f2eeee";
	}
}