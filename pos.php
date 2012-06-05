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
	<title>Hard Disk Cafe Point-Of-Sale System</title>
	<link href="favicon.ico" rel="icon" type="image/x-icon" />
	<link rel="stylesheet" type="text/css" href="main.css" />
	<style type="text/css">
	#sanity {visibility:hidden}
	#docket {visibility:hidden}
	<?php for ($itm=1; $itm<=5; $itm++)	{print"#item$itm {visibility:hidden}";} ?>
	</style>
	<script language="JavaScript" type="text/javascript" src="newsale.js"></script>
</head>
<body onLoad="document.transaction.sale.focus();">
<form name="transaction" enctype="multipart/form-data" action="record.php" method="post">
<input type="hidden" name="discount" value="0">
<div class="ctl">
	<input type="button" name="sale" onclick="toggle('docket');" value="NEW SALE" class="btn" title="new transaction" />
	<input type='button' onclick="javascript:window.location.href='inventory.php';" value='INVENTORY' class='btn' title="switch to inventory management" />
	<input type='button' onclick="javascript:window.location.href='logout.php';" value='LOGOUT' class='btn' style="float:right" />
	<span class="login"><em>Currently logged in as <?php echo $staffname;?></em></span>
<div>
<p>Record of sales to date:</p>
<div id="docket"><?php include 'docket.php';?></div>
<span id="sanity"><div class="hed">ARE YOU SURE?</div>
	<input type="submit" value="YES" class="yo" />
	<input type="button" onclick="javascript:toggle('sanity');" value="NO" class="nup" />
</span>
</form>
<div id="thelist"><?php include 'trec.php';?></div>
</body>
</html>
