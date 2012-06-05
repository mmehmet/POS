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
	<title>Hard Disk Cafe</title>
	<link href="favicon.ico" rel="icon" type="image/x-icon" />
	<link rel="stylesheet" type="text/css" href="main.css" />
	<style type="text/css">
	#sanity {visibility:hidden}
	</style>
	<script language="JavaScript" type="text/javascript">
	function toggle(area) {
		var visSetting = document.getElementById(area).style.visibility;
		if (visSetting == 'visible') {document.getElementById(area).style.visibility = 'hidden';}
		else {document.getElementById(area).style.visibility = 'visible';}
	}
	function fixit()	{
		var sell=eval(document.item.prc.value);
		res = new String(sell);
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
	}
	</script>
</head>
<body onLoad="document.item.bcode.focus();">
<form name="item" enctype="multipart/form-data" action="update.php" method="post">
<input type="hidden" name="dfdo" value="edt" />
<div class="ctl">
	<input type='button' onclick="javascript:window.location.href='inventory.php';" value='<' class='btn' />
	<input type='button' onclick="javascript:window.location.href='pos.php';" value='POS' class='btn' title="switch to Point Of Sale screen" />
	<input type='button' onclick="javascript:window.location.href='logout.php';" value='LOGOUT' class='btn' style="float:right" />
	<span class="login"><em>Currently logged in as <?php echo $staffname;?></em></span>
</div>
<p>OK let's update this puppy</p>
<span id="invform" style="margin-top:45px;text-align:left;">
<div class='hed' style='font-size:1.6em'>EDIT ITEM<input type="button" style="float:right" onclick="javascript:window.location.href='inventory.php';" value="X" title="go back to the inventory list" /></div>
<?php
$target = $_GET['fnam'];
$item = getcwd()."/inventory/".$target;
$frh = fopen($item,'r');
$xmldata = fread($frh,filesize($item));
fclose($frh);
include 'details.php';
print "<div style='padding:5px;font-weight:bold;margin-top:5px;'><label>BARCODE:</label> ";
if ($bcd=="")	{ print "<input type='text' name='bcode' />"; }
else			{ print "<input type='text' name='bcode' value=$bcd />"; }
print "<div style='float:right;padding:5px;margin-top:-5px;margin-right:-5px;'><label>Count:</label> <input type='text' name='count' size='4' maxlength='4' value=$cnt /></div>";
print "<div style='float:right;padding:5px;margin-top:-5px;margin-right:5px;'><label>PO:</label> ";
if ($po=="")	{ print "<input type='text' name='po' />"; }
else			{ print "<input type='text' name='po' value=$po />"; }
print "</div><div style='padding:5px;font-weight:bold;'><label>Product Description:</label> <input type='text' name='dsc' size='80' value='".$desc."' /></div>";
print "<div style='padding:5px;font-weight:bold;'><label>Cost Price (ea):</label> $<input type='text' name='cst' value=$cost onblur='fixup()' />";
print "<div style='float:right;padding:5px;margin-top:-5px;margin-right:35px;'><label>Sell Price (ea):</label> $<input type='text' name='prc' value=$price onblur='fixit()' />";
print "<input type='hidden' name='staff' value='$staffname' />";
print "<input type='hidden' name='nocode' value='$target' />";
?>
<div style='float:right;padding:5px;margin-top:-5px;'><input type="button" onclick="javascript:toggle('sanity');" value="DO IT" class="sbm" /></div></div></div>
<input type="hidden" name="stid" value="<?php echo $stfid;?>" />
</span>
<span id="sanity" style="margin-top:35px"><div class="hed">ARE YOU SURE?</div>
	<input type="submit" value="YES" class="yo" />
	<input type="button" onclick="javascript:toggle('sanity');" value="NO" class="nup" />
</span>
</form>
</body>
</html>
