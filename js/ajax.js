
//dailyinput.php
//show Product Name
function showProductName(str, id) {
  //make qty -> 0
  document.getElementById("qty"+id).value = 0;
  document.getElementById("subtotal"+id).value = 0;

  if (window.XMLHttpRequest) {
    // code for IE7+, Firefox, Chrome, Opera, Safari
    xmlhttp=new XMLHttpRequest();
  } else {  // code for IE6, IE5
    xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
  xmlhttp.onreadystatechange=function() {
    if (xmlhttp.readyState==4 && xmlhttp.status==200) {
      document.getElementById("productname"+id).value=xmlhttp.responseText;
    }
  }
  xmlhttp.open("GET","function-showproductname.php?barcode="+str,true);
  xmlhttp.send();
}

//show Refund Product Name
function showRefundProductName(str, id) {
  //make qty -> 0
  document.getElementById("refund-qty"+id).value = 0;
  document.getElementById("refund-subtotal"+id).value = 0;

  if (window.XMLHttpRequest) {
    // code for IE7+, Firefox, Chrome, Opera, Safari
    xmlhttp=new XMLHttpRequest();
  } else {  // code for IE6, IE5
    xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
  xmlhttp.onreadystatechange=function() {
    if (xmlhttp.readyState==4 && xmlhttp.status==200) {
      document.getElementById("refund-productname"+id).value=xmlhttp.responseText;
    }
  }
  xmlhttp.open("GET","function-showproductname.php?barcode="+str,true);
  xmlhttp.send();
}


//show Subtotal
function showSubtotal(str, id) {
  var qtyBarcode = document.getElementById("barcode"+id).value;

  if (window.XMLHttpRequest) {
    // code for IE7+, Firefox, Chrome, Opera, Safari
    xmlhttp=new XMLHttpRequest();
  } else {  // code for IE6, IE5
    xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
  xmlhttp.onreadystatechange=function() {
    if (xmlhttp.readyState==4 && xmlhttp.status==200) {
      document.getElementById("subtotal"+id).value=xmlhttp.responseText;
    }
  }
  xmlhttp.open("GET","function-showsubtotal.php?qty="+str+"&qtyBarcode="+qtyBarcode,true);
  xmlhttp.send();
}

//show Refund Subtotal
function showRefundSubtotal(str, id) {
  var qtyBarcode = document.getElementById("refund-barcode"+id).value;

  if (window.XMLHttpRequest) {
    // code for IE7+, Firefox, Chrome, Opera, Safari
    xmlhttp=new XMLHttpRequest();
  } else {  // code for IE6, IE5
    xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
  xmlhttp.onreadystatechange=function() {
    if (xmlhttp.readyState==4 && xmlhttp.status==200) {
      document.getElementById("refund-subtotal"+id).value=xmlhttp.responseText;
    }
  }
  xmlhttp.open("GET","function-showsubtotal.php?qty="+str+"&qtyBarcode="+qtyBarcode,true);
  xmlhttp.send();
}

//show shop name
function showShopName(str) {
  if (window.XMLHttpRequest) {
    // code for IE7+, Firefox, Chrome, Opera, Safari
    xmlhttp=new XMLHttpRequest();
  } else {  // code for IE6, IE5
    xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
  xmlhttp.onreadystatechange=function() {
    if (xmlhttp.readyState==4 && xmlhttp.status==200) {
      document.getElementById("shopnameinput").value=xmlhttp.responseText;
    }
  }
  xmlhttp.open("GET","function-showshopname.php?shopid="+str,true);
  xmlhttp.send();
}

//update shopstock
function updateShopStock(count){
  var shopid = document.getElementById("shopidinput").value;
  var shopstock = new Array();

  if(shopid){
    //refill
    for(i=1; i<count; i++){
      barcode = document.getElementById("barcode"+i).value;
      qty = document.getElementById("qty"+i).value;

      shopstock.push(barcode);
      shopstock.push(qty);
    }

    console.log(shopstock);

    if (window.XMLHttpRequest) {
      // code for IE7+, Firefox, Chrome, Opera, Safari
      xmlhttp=new XMLHttpRequest();
    } else {  // code for IE6, IE5
      xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
    }
    xmlhttp.onreadystatechange=function() {
      if (xmlhttp.readyState==4 && xmlhttp.status==200) {
        document.getElementById("content").innerHTML=xmlhttp.responseText;
      }
    }
    xmlhttp.open("GET","function-updateshopstock.php?shopstock="+shopstock+"&shopid="+shopid,true);
    xmlhttp.send();

  }

}


//refill
function refill(count){
  var date = document.getElementById("dateinput").value;
  var shopid = document.getElementById("shopidinput").value;
  var refillrecord = new Array();

  if(date && shopid){
    //refill
    for(i=1; i<count; i++){
      productname = document.getElementById("productname"+i).value;
      setstock = document.getElementById("setstock"+i).value;

      if(document.getElementById("refill"+i).value){
        refill = document.getElementById("refill"+i).value;
      } else {
        refill = 0;
      }

      refillrecord.push(productname);
      refillrecord.push(refill);
      refillrecord.push(setstock);
    }

    console.log(refillrecord);

    if (window.XMLHttpRequest) {
      // code for IE7+, Firefox, Chrome, Opera, Safari
      xmlhttp=new XMLHttpRequest();
    } else {  // code for IE6, IE5
      xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
    }
    xmlhttp.onreadystatechange=function() {
      if (xmlhttp.readyState==4 && xmlhttp.status==200) {
        document.getElementById("content").innerHTML=xmlhttp.responseText;
      }
    }
    xmlhttp.open("GET","function-refill.php?refillrecord="+refillrecord+"&shopid="+shopid+"&date="+date,true);
    xmlhttp.send();

  }

}

//finish dailyinput
function finishDailyInput(){
  //initailize
  var date = document.getElementById("dateinput").value;
  var shopid = document.getElementById("shopidinput").value;
  var soldrecord = new Array();
  var barcode = 0;
  var qty = 0;
  var discount = 0;
  var labour = 0;
  var rent = 0;
  var extrarecord = new Array();
  var item = "";
  var cost = 0;
  var note = "";

  var refundrecord = new Array();
  var refundbarcode = 0;
  var refundqty = 0;

  console.log("Date: " + date);
  console.log("ShopID: " + shopid);

  if(date && shopid){
    console.log("both");

    //sale
    for(i=0; i<100; i++){
      if(document.getElementById("subtotal"+i).value && document.getElementById("subtotal"+i).value != 0){
        barcode = parseInt(document.getElementById("barcode"+i).value);
        qty = parseInt(document.getElementById("qty"+i).value);
        soldrecord.push(barcode);
        soldrecord.push(qty);
      }
    }

    console.log("SoldRecord: " + soldrecord);
    
    //dynamic
    if(document.getElementById("discount").value){
      var discount = parseFloat(document.getElementById("discount").value);
    }
    if(document.getElementById("labour").value){
      var labour = parseFloat(document.getElementById("labour").value);
    }
    if(document.getElementById("rent").value){
      var rent = parseFloat(document.getElementById("rent").value);
    }

    console.log("Discount: " + discount);
    console.log("Labour: " + labour);
    console.log("Rent: " + rent);

    //extra
    for(i=0; i<30; i++){
      if(document.getElementById("cost"+i).value && document.getElementById("cost"+i).value != 0){
        item = document.getElementById("item"+i).value;
        cost = parseFloat(document.getElementById("cost"+i).value);
        note = document.getElementById("note"+i).value;
        extrarecord.push(item);
        extrarecord.push(cost);
        extrarecord.push(note);
      }
    }

    console.log("ExtraRecord: " + extrarecord);

    //refund
    for(i=0; i<50; i++){
      if(document.getElementById("refund-subtotal"+i).value && document.getElementById("refund-subtotal"+i).value != 0){
        refundbarcode = parseInt(document.getElementById("refund-barcode"+i).value);
        refundqty = parseInt(document.getElementById("refund-qty"+i).value);
        refundrecord.push(refundbarcode);
        refundrecord.push(refundqty);
      }
    }

    console.log("RefundRecord: " + refundrecord);

    if (window.XMLHttpRequest) {
      // code for IE7+, Firefox, Chrome, Opera, Safari
      xmlhttp=new XMLHttpRequest();
    } else {  // code for IE6, IE5
      xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
    }
    xmlhttp.onreadystatechange=function() {
      if (xmlhttp.readyState==4 && xmlhttp.status==200) {
        document.getElementById("content").innerHTML=xmlhttp.responseText;
      }
    }
    xmlhttp.open("GET","function-finishdailyinput.php?date="+date+"&shopid="+shopid+"&soldrecord="+soldrecord+"&discount="+discount+"&labour="+labour+"&rent="+rent+"&extrarecord="+extrarecord+"&refundrecord="+refundrecord,true);
    xmlhttp.send();
  }  
}

//finish addshop
function finishAddShop(){
  //initailize
  var shopname = document.getElementById("shopnameinput").value;
  var opendate = document.getElementById("opendateinput").value;
  var manager = document.getElementById("managerinput").value;
  var location = document.getElementById("locationinput").value;
  var initialstock = new Array();
  var barcode = 0;
  var qty = 0;

  if(shopname && opendate && manager && location){
    //initial shop stock
    for(i=0; i<100; i++){
      if(document.getElementById("subtotal"+i).value && document.getElementById("subtotal"+i).value != 0){
        barcode = parseInt(document.getElementById("barcode"+i).value);
        qty = parseInt(document.getElementById("qty"+i).value);
        initialstock.push(barcode);
        initialstock.push(qty);
      }
    }

    if (window.XMLHttpRequest) {
      // code for IE7+, Firefox, Chrome, Opera, Safari
      xmlhttp=new XMLHttpRequest();
    } else {  // code for IE6, IE5
      xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
    }
    xmlhttp.onreadystatechange=function() {
      if (xmlhttp.readyState==4 && xmlhttp.status==200) {
        document.getElementById("content").innerHTML=xmlhttp.responseText;
      }
    }
    xmlhttp.open("GET","function-finishaddshop.php?shopname="+shopname+"&opendate="+opendate+"&manager="+manager+"&location="+location+"&initialstock="+initialstock,true);
    xmlhttp.send();
  }
}

//finish addproduct
function finishAddProduct(){
  //initailize
  var barcode = 0;
  var qty = 0;
  var productname = "";
  var cost = 0;
  var price = 0;
  var productinfo= new Array();
  
  //initial shop stock
  for(i=0; i<100; i++){
    barcode = document.getElementById("barcode"+i).value;
    productname = document.getElementById("productname"+i).value;
    qty = document.getElementById("qty"+i).value;
    cost = document.getElementById("cost"+i).value;
    price = document.getElementById("price"+i).value;


    if(barcode && productname && qty && cost && price && qty!=0 && price!=0){
      productinfo.push(barcode);
      productinfo.push(productname);
      productinfo.push(qty);
      productinfo.push(cost);
      productinfo.push(price);
    }


  }

  if(productinfo.length > 0){
    if (window.XMLHttpRequest) {
      // code for IE7+, Firefox, Chrome, Opera, Safari
      xmlhttp=new XMLHttpRequest();
    } else {  // code for IE6, IE5
      xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
    }
    xmlhttp.onreadystatechange=function() {
      if (xmlhttp.readyState==4 && xmlhttp.status==200) {
        document.getElementById("content").innerHTML=xmlhttp.responseText;
      }
    }
    xmlhttp.open("GET","function-finishaddproduct.php?productinfo="+productinfo,true);
    xmlhttp.send();
  }
}

//show cost
function showCost(){
  //initialize
  var shopid = 0;
  var date = 0;

  if(document.getElementById("shopidinput").value && document.getElementById("dateinput").value){

    shopid = document.getElementById("shopidinput").value;
    date = document.getElementById("dateinput").value;

    console.log(shopid);
    console.log(date);


    if (window.XMLHttpRequest) {
      // code for IE7+, Firefox, Chrome, Opera, Safari
      xmlhttp=new XMLHttpRequest();
    } else {  // code for IE6, IE5
      xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
    }
    xmlhttp.onreadystatechange=function() {
      if (xmlhttp.readyState==4 && xmlhttp.status==200) {
        document.getElementById("table-content").innerHTML=xmlhttp.responseText;
      }
    }
    xmlhttp.open("GET","function-showcost.php?shopid="+shopid+"&date="+date,true);
    xmlhttp.send();
  }
}

//show sold
function showSold(){
  //initialize
  var shopid = 0;
  var date = 0;

  if(document.getElementById("shopidinput").value && document.getElementById("dateinput").value){

    shopid = document.getElementById("shopidinput").value;
    date = document.getElementById("dateinput").value;

    console.log(shopid);
    console.log(date);


    if (window.XMLHttpRequest) {
      // code for IE7+, Firefox, Chrome, Opera, Safari
      xmlhttp=new XMLHttpRequest();
    } else {  // code for IE6, IE5
      xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
    }
    xmlhttp.onreadystatechange=function() {
      if (xmlhttp.readyState==4 && xmlhttp.status==200) {
        document.getElementById("table-content").innerHTML=xmlhttp.responseText;
      }
    }
    xmlhttp.open("GET","function-showsold.php?shopid="+shopid+"&date="+date,true);
    xmlhttp.send();
  }
}

//show profit
function showProfit(){
  //initialize
  var shopid = 0;
  var date = 0;

  if(document.getElementById("shopidinput").value && document.getElementById("dateinput").value){

    shopid = document.getElementById("shopidinput").value;
    date = document.getElementById("dateinput").value;

    console.log(shopid);
    console.log(date);


    if (window.XMLHttpRequest) {
      // code for IE7+, Firefox, Chrome, Opera, Safari
      xmlhttp=new XMLHttpRequest();
    } else {  // code for IE6, IE5
      xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
    }
    xmlhttp.onreadystatechange=function() {
      if (xmlhttp.readyState==4 && xmlhttp.status==200) {
        document.getElementById("table-content").innerHTML=xmlhttp.responseText;
      }
    }
    xmlhttp.open("GET","function-showprofit.php?shopid="+shopid+"&date="+date,true);
    xmlhttp.send();
  }
}

//show expense
function showExpense(){
  //initialize
  var shopid = 0;
  var date = 0;

  if(document.getElementById("shopidinput").value && document.getElementById("dateinput").value){

    shopid = document.getElementById("shopidinput").value;
    date = document.getElementById("dateinput").value;

    console.log(shopid);
    console.log(date);


    if (window.XMLHttpRequest) {
      // code for IE7+, Firefox, Chrome, Opera, Safari
      xmlhttp=new XMLHttpRequest();
    } else {  // code for IE6, IE5
      xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
    }
    xmlhttp.onreadystatechange=function() {
      if (xmlhttp.readyState==4 && xmlhttp.status==200) {
        document.getElementById("table-content").innerHTML=xmlhttp.responseText;
      }
    }
    xmlhttp.open("GET","function-showexpense.php?shopid="+shopid+"&date="+date,true);
    xmlhttp.send();
  }
}

//show refill history
function showRefillHistory(){
  //initialize
  var shopid = 0;
  var date = 0;

  if(document.getElementById("shopidinput").value && document.getElementById("dateinput").value){

    shopid = document.getElementById("shopidinput").value;
    date = document.getElementById("dateinput").value;

    console.log(shopid);
    console.log(date);


    if (window.XMLHttpRequest) {
      // code for IE7+, Firefox, Chrome, Opera, Safari
      xmlhttp=new XMLHttpRequest();
    } else {  // code for IE6, IE5
      xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
    }
    xmlhttp.onreadystatechange=function() {
      if (xmlhttp.readyState==4 && xmlhttp.status==200) {
        document.getElementById("table-content").innerHTML=xmlhttp.responseText;
      }
    }
    xmlhttp.open("GET","function-showrefillhistory.php?shopid="+shopid+"&date="+date,true);
    xmlhttp.send();
  }
}

//show refill list
function showStocktake(){
  //initialize
  var shopid = 0;

  if(document.getElementById("shopidinput").value){

    shopid = document.getElementById("shopidinput").value;
    console.log(shopid);

    if (window.XMLHttpRequest) {
      // code for IE7+, Firefox, Chrome, Opera, Safari
      xmlhttp=new XMLHttpRequest();
    } else {  // code for IE6, IE5
      xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
    }
    xmlhttp.onreadystatechange=function() {
      if (xmlhttp.readyState==4 && xmlhttp.status==200) {
        document.getElementById("table-content").innerHTML=xmlhttp.responseText;
      }
    }
    xmlhttp.open("GET","function-showstocktake.php?shopid="+shopid,true);
    xmlhttp.send();
  }
}

//show refill
function showRefill(){
  //initialize
  var shopid = 0;

  if(document.getElementById("shopidinput").value && document.getElementById("dateinput").value){

    shopid = document.getElementById("shopidinput").value;
    console.log(shopid);

    if (window.XMLHttpRequest) {
      // code for IE7+, Firefox, Chrome, Opera, Safari
      xmlhttp=new XMLHttpRequest();
    } else {  // code for IE6, IE5
      xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
    }
    xmlhttp.onreadystatechange=function() {
      if (xmlhttp.readyState==4 && xmlhttp.status==200) {
        document.getElementById("table-content").innerHTML=xmlhttp.responseText;
      }
    }
    xmlhttp.open("GET","function-showrefill.php?shopid="+shopid,true);
    xmlhttp.send();
  }
}

//show refill list
function showRefillList(){
  //initialize
  var shopid = 0;

  if(document.getElementById("shopidinput").value){

    shopid = document.getElementById("shopidinput").value;
    console.log(shopid);

    if (window.XMLHttpRequest) {
      // code for IE7+, Firefox, Chrome, Opera, Safari
      xmlhttp=new XMLHttpRequest();
    } else {  // code for IE6, IE5
      xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
    }
    xmlhttp.onreadystatechange=function() {
      if (xmlhttp.readyState==4 && xmlhttp.status==200) {
        document.getElementById("table-content").innerHTML=xmlhttp.responseText;
      }
    }
    xmlhttp.open("GET","function-showrefilllist.php?shopid="+shopid,true);
    xmlhttp.send();
  }
}

//show shop summary
function showShopSummary(){
  //initialize
  var shopid = document.getElementById("shopidinput").value;
  var date_from = document.getElementById("dateinput_1").value;
  var date_to = document.getElementById("dateinput_2").value;

  if(shopid && date_from && date_to){

    if (window.XMLHttpRequest) {
      // code for IE7+, Firefox, Chrome, Opera, Safari
      xmlhttp=new XMLHttpRequest();
    } else {  // code for IE6, IE5
      xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
    }
    xmlhttp.onreadystatechange=function() {
      if (xmlhttp.readyState==4 && xmlhttp.status==200) {
        document.getElementById("table-content").innerHTML=xmlhttp.responseText;
      }
    }
    xmlhttp.open("GET","function-showshopsummary.php?shopid="+shopid+"&date_from="+date_from+"&date_to="+date_to,true);
    xmlhttp.send();
  }
}

//show Summary
function showSummary(){
  //initialize
  var date_from = document.getElementById("dateinput_1").value;
  var date_to = document.getElementById("dateinput_2").value;

  if(date_from && date_to){

    if (window.XMLHttpRequest) {
      // code for IE7+, Firefox, Chrome, Opera, Safari
      xmlhttp=new XMLHttpRequest();
    } else {  // code for IE6, IE5
      xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
    }
    xmlhttp.onreadystatechange=function() {
      if (xmlhttp.readyState==4 && xmlhttp.status==200) {
        document.getElementById("table-content").innerHTML=xmlhttp.responseText;
      }
    }
    xmlhttp.open("GET","function-showsummary.php?date_from="+date_from+"&date_to="+date_to,true);
    xmlhttp.send();
  }
}

//show shop report
function showShopReport(){
  //initialize
  var shopid = document.getElementById("shopidinput").value;

  if(shopid){

    if (window.XMLHttpRequest) {
      // code for IE7+, Firefox, Chrome, Opera, Safari
      xmlhttp=new XMLHttpRequest();
    } else {  // code for IE6, IE5
      xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
    }
    xmlhttp.onreadystatechange=function() {
      if (xmlhttp.readyState==4 && xmlhttp.status==200) {
        document.getElementById("table-content").innerHTML=xmlhttp.responseText;
      }
    }
    xmlhttp.open("GET","function-showshopreport.php?shopid="+shopid,true);
    xmlhttp.send();
  }
}

//show shop stock
function showShopStock(){
  //initialize
  var shopid = document.getElementById("shopidinput").value;

  if(shopid){

    if (window.XMLHttpRequest) {
      // code for IE7+, Firefox, Chrome, Opera, Safari
      xmlhttp=new XMLHttpRequest();
    } else {  // code for IE6, IE5
      xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
    }
    xmlhttp.onreadystatechange=function() {
      if (xmlhttp.readyState==4 && xmlhttp.status==200) {
        document.getElementById("table-content").innerHTML=xmlhttp.responseText;
      }
    }
    xmlhttp.open("GET","function-showshopstock.php?shopid="+shopid,true);
    xmlhttp.send();
  }
}
