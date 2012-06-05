<?php
include 'auth.php';
$staffnam = $_SESSION['SESS_FIRST_NAME']." ".$_SESSION['SESS_LAST_NAME'];
$stfid = $_SESSION['SESS_STAFF_ID'];
?>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en-AU" lang="en-AU">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<meta http-equiv="Pragma" content="no-cache">
	<meta http-equiv="Expires" content="-1">
	<title>Repo Guys Footscray POS</title>
	<link href="favicon.ico" rel="icon" type="image/x-icon" />
	<link rel="stylesheet" type="text/css" href="main.css" />
	<style type="text/css">
	#sanity {visibility:hidden}
	#invform {visibility:hidden}
	</style>
	<script language="JavaScript" type="text/javascript">
	function toggle(area) {
		var visSetting = document.getElementById(area).style.visibility;
		if (visSetting == 'visible') {document.getElementById(area).style.visibility = 'hidden';}
		else {document.getElementById(area).style.visibility = 'visible';}
	}
	function adit() {
		var pr1=eval(document.transaction.price1.value);
		var pr2=eval(document.transaction.price2.value);
		var pr3=eval(document.transaction.price3.value);
		var pr4=eval(document.transaction.price4.value);
		var pr5=eval(document.transaction.price5.value);
		var pr6=eval(document.transaction.price6.value);
		var q1=eval(document.transaction.qty1.value);
		var q2=eval(document.transaction.qty2.value);
		var q3=eval(document.transaction.qty3.value);
		var q4=eval(document.transaction.qty4.value);
		var q5=eval(document.transaction.qty5.value);
		var q6=eval(document.transaction.qty6.value);
		var result = (pr1*q1) + (pr2*q2) + (pr3*q3) + (pr4*q4) + (pr5*q5) + (pr6*q6);

		res = new String(result);
		if(res.indexOf('.') < 0) { res += '.00'; }
		if(res.indexOf('.') == (res.length - 2)) { res += '0'; }
		res = '' + res;
		document.transaction.total.value = res;

		if(pr1.indexOf('.') < 0) { pr1 += '.00'; }
		if(pr1.indexOf('.') == (pr1.length - 2)) { pr1 += '0'; }
		pr1 = '' + pr1;
		document.transaction.price1.value = pr1;
		if(pr2.indexOf('.') < 0) { pr2 += '.00'; }
		if(pr2.indexOf('.') == (pr2.length - 2)) { pr2 += '0'; }
		pr2 = '' + pr2;
		document.transaction.price2.value = pr2;
		if(pr3.indexOf('.') < 0) { pr3 += '.00'; }
		if(pr3.indexOf('.') == (pr3.length - 2)) { pr3 += '0'; }
		pr3 = '' + pr3;
		document.transaction.price3.value = pr3;
		if(pr4.indexOf('.') < 0) { pr4 += '.00'; }
		if(pr4.indexOf('.') == (pr4.length - 2)) { pr4 += '0'; }
		pr4 = '' + pr4;
		document.transaction.price4.value = pr4;
		if(pr5.indexOf('.') < 0) { pr5 += '.00'; }
		if(pr5.indexOf('.') == (pr5.length - 2)) { pr5 += '0'; }
		pr5 = '' + pr5;
		document.transaction.price5.value = pr5;
		if(pr6.indexOf('.') < 0) { pr6 += '.00'; }
		if(pr6.indexOf('.') == (pr6.length - 2)) { pr6 += '0'; }
		pr6 = '' + pr6;
		document.transaction.price6.value = pr6;
	}
	function dsc()	{
		document.transaction.discount.value = '1';
		adit();
	}
	function lookitup()	{
		adit();
	}
	</script>
</head>
<body onLoad="document.transaction.sale.focus();">
<form name="transaction" enctype="multipart/form-data" action="record.php" method="post">
<input type="hidden" name="discount" value="0">
<div class="ctl">
	<input type="button" name="sale" onclick="javascript:toggle('invform');" value="NEW SALE" class="btn" title="new transaction" />
	<input type='button' onclick="javascript:window.location.href='inventory.php';" value='INVENTORY' class='btn' title="switch to inventory management" />
	<input type='button' onclick="javascript:window.location.href='logout.php';" value='LOGOUT' class='btn' style="float:right" />
	<span class="login"><em>Currently logged in as <?php echo $staffnam;?></em></span>
<div>
<p>Record of sales to date:</p>
<span id="invform"><div class="hed" style="font-size: 1.6em;">NEW SALE<div id="clz"><input type="button" onclick="javascript:toggle('invform');" value="X" /></div></div>
	<div style="text-align:left"><label>Code:</label> <input type="text" name="scan1" onchange="lookitup();" />
		<label>QTY:</label> <input type="text" name="qty1" size="3" maxlength="3" value="0" onchange="adit();" />
		<div style="float:right"><label>Price (ea):</label> <input type="text" name="price1" size="9" maxlength="9" value="0" onblur="dsc();" /></div></div>
	<div><label>Product:</label> <input disabled name="desc1" size="80" /></div>
	<div style="text-align:left"><label>Code:</label> <input type="text" name="scan2" onchange="lookitup();" />
		<label>QTY:</label> <input type="text" name="qty2" size="3" maxlength="3" value="0" onchange="adit();" />
		<div style="float:right"><label>Price (ea):</label> <input type="text" name="price2" size="9" maxlength="9" value="0" onblur="dsc();" /></div></div>
	<div><label>Product:</label> <input disabled name="desc2" size="80" /></div>
	<div style="text-align:left"><label>Code:</label> <input type="text" name="scan3" onchange="lookitup();" />
		<label>QTY:</label> <input type="text" name="qty3" size="3" maxlength="3" value="0" onchange="adit();" />
		<div style="float:right"><label>Price (ea):</label> <input type="text" name="price3" size="9" maxlength="9" value="0" onblur="dsc();" /></div></div>
	<div><label>Product:</label> <input disabled name="desc3" size="80" /></div>
	<div style="text-align:left"><label>Code:</label> <input type="text" name="scan4" onchange="lookitup();" />
		<label>QTY:</label> <input type="text" name="qty4" size="3" maxlength="3" value="0" onchange="adit();" />
		<div style="float:right"><label>Price (ea):</label> <input type="text" name="price4" size="9" maxlength="9" value="0" onblur="dsc();" /></div></div>
	<div><label>Product:</label> <input disabled name="desc4" size="80" /></div>
	<div style="text-align:left"><label>Code:</label> <input type="text" name="scan5" onchange="lookitup();" />
		<label>QTY:</label> <input type="text" name="qty5" size="3" maxlength="3" value="0" onchange="adit();" />
		<div style="float:right"><label>Price (ea):</label> <input type="text" name="price5" size="9" maxlength="9" value="0" onblur="dsc();" /></div></div>
	<div><label>Product:</label> <input disabled name="desc5" size="80" /></div>
	<div style="text-align:left"><label>Code:</label> <input type="text" name="scan6" onchange="lookitup();" />
		<label>QTY:</label> <input type="text" name="qty6" size="3" maxlength="3" value="0" onchange="adit();" />
		<div style="float:right"><label>Price (ea):</label> <input type="text" name="price6" size="9" maxlength="9" value="0" onblur="dsc();" /></div></div>
	<div><label>Product:</label> <input disabled name="desc6" size="80" /></div>
	<div><label>Total:</label> <input readonly name="total" /> <input type="checkbox" checked name="cash" onClick="document.transaction.eft.checked=false;"> Cash <input type="checkbox" name="eft" onClick="document.transaction.csh.checked=false;"> Card
		<input type="button" onclick="javascript:toggle('sanity');" value="KACHING!" class="sbm" /></div>
<input type="hidden" name="staff" value="<?php echo $staffname;?>" />
<input type="hidden" name="stid" value="<?php echo $stfid;?>" />
</span>
<span id="sanity"><div class="hed">ARE YOU SURE?</div>
	<input type="submit" value="YES" class="yo" />
	<input type="button" onclick="javascript:toggle('sanity');" value="NO" class="nup" />
</span>
</form>
<div id="thelist"><?php include 'trec.php';?></div>
</body>
</html>
