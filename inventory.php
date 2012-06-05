<?php
//include 'auth.php';
//$staffname = $_SESSION['SESS_FIRST_NAME']." ".$_SESSION['SESS_LAST_NAME'];
//$stfid = $_SESSION['SESS_STAFF_ID'];
$staffname="Test Case";
$stfid=999;
?>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en-AU" lang="en-AU">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<meta http-equiv="Pragma" content="no-cache">
	<meta http-equiv="Expires" content="-1">
	<title>Hard Disk Cafe Inventory</title>
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
	function fixit()	{
		var price=eval(document.item.prc.value);
		res = new String(price);
		if(res.indexOf('.') < 0) { res += '.00'; }
		if(res.indexOf('.') == (res.length - 2)) { res += '0'; }
		res = '' + res;
		document.item.prc.value = res;
	}
	function fixup()	{
		var cost=eval(document.item.cst.value);
		cpr = new String(cost);
		if(cpr.indexOf('.') < 0) { cpr += '.00'; }
		if(cpr.indexOf('.') == (cpr.length - 2)) { cpr += '0'; }
		cpr = '' + cpr;
		document.item.cst.value = cpr;
		if(document.item.prc.value == '0.00')	{
			aupr = new String(cpr*2);
			if(aupr.indexOf('.') < 0) { aupr += '.00'; }
			if(aupr.indexOf('.') == (aupr.length - 2)) { aupr += '0'; }
			aupr = '' + aupr;
			document.item.prc.value = aupr;
		}
	}
	function validateForm()	{
		var ct=eval(document.item.count.value);
		if(ct<1)
		{
			document.item.count.focus();
			alert("Please enter the ACTUAL count");
			return false;
		}
		var ds=document.item.dsc.value;
		if(ds==""||ds==null)
		{
			document.item.dsc.focus();
			alert("Please enter a description");
			return false;
		}
		var cs=eval(document.item.cst.value);
		if(cs==0)
		{
			document.item.cst.focus();
			alert("Please enter the Cost Price");
			return false;
		}
		var pr=eval(document.item.prc.value);
		if(pr==0)
		{
			document.item.prc.focus();
			alert("Please enter the Sell Price");
			return false;
		}
	}
	</script>
</head>
<body onLoad="document.item.additem.focus();">
<form name="item" enctype="multipart/form-data" action="update.php" method="post" onsubmit="return validateForm()">
<input type="hidden" name="dfdo" value="add" />
<div class="ctl">
	<input type="button" name="additem" onclick="javascript:toggle('invform');document.item.bcode.focus();" value="NEW ITEM" class="btn" title="add a new item to the inventory" />
	<input type='button' onclick="javascript:window.location.href='pos.php';" value='POS' class='btn' title="switch to Point Of Sale screen" />
	<input type='button' onclick="javascript:window.location.href='logout.php';" value='LOGOUT' class='btn' style="float:right" />
	<span class="login"><em>Currently logged in as <?php echo $staffname;?></em></span>
</div>
<p>Here is the inventory as it currently stands...</p>
<span id="invform" style="text-align:left;margin-top:45px;">
	<div class="hed" style="font-size: 1.6em;">NEW ITEM<div id="clz"><input type="button" onclick="javascript:toggle('invform');" value="X" /></div></div>
	<div style="padding:5px;font-weight:bold;margin-top:5px;"><label>BARCODE:</label> <input type="text" name="bcode" />
	<div style='float:right;padding:5px;margin-top:-5px;margin-right:-5px;'><label>Count:</label> <input type="text" name="count" size="4" maxlength="4" value="0" /></div>
	<div style='float:right;padding:5px;margin-top:-5px;margin-right:5px;'><label>PO (optional):</label> <input type="text" name="po" /></div></div>
	<div style="padding:5px;font-weight:bold;margin-top:5px;"><label>Product Description:</label> <input type="text" name="dsc" size="80" /></div>
	<div style="padding:5px;font-weight:bold;margin-top:5px;"><label>Cost Price (ea):</label> $<input type="text" name="cst" value="0.00" onblur="fixup()" />
		<div style='float:right;padding:5px;margin-top:-5px;margin-right:35px;'><label>Sell Price (ea):</label> $<input type="text" name="prc" value="0.00" onblur="fixit()" />
		<div style='float:right;padding:5px;font-weight:bold;margin-top:-30px;'><input type="button" onclick="javascript:toggle('sanity');" value="DONE" class="sbm" /></div></div></div>
<input type="hidden" name="staff" value="<?php echo $staffname;?>" />
<input type="hidden" name="stid" value="<?php echo $stfid;?>" />
</span>
<span id="sanity" style="margin-top:35px"><div class="hed">ARE YOU SURE?</div>
	<input type="submit" value="YES" class="yo" />
	<input type="button" onclick="javascript:toggle('sanity');" value="NO" class="nup" />
</span>
</form>
<div id="thelist"><?php include 'list.php';?></div>
<p>Click on an item to view it</p>
</body>
</html>
